<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\PaymentDetail;
use App\Models\Product;
use Razorpay\Api\Api;
use Exception;
use stdClass; 
use App\Models\Categories;


class CartController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        $userId = Auth::id();
        $user = User::find($userId);
        $cartItems = Cart::with('product:id,title,image,price')->where('user_id', $userId)->get();
        return view('cart.index', compact('user', 'cartItems', 'categories'));
        // return view('userorder', compact('orders', 'categories'));

    }
  
    public function addItem(Request $request)
    {
        if (!Auth::check()) {
            return back()->with('error', 'You are not registered, please log in to add items to your cart');
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        $user_id = Auth::id();

        $existingCartItem = Cart::where('user_id', $user_id)
                                ->where('product_id', $product_id)
                                ->first();

        if ($existingCartItem) {
            $existingCartItem->quantity += $quantity;
            $existingCartItem->save();
        } else {
            $cartItem = new Cart();
            $cartItem->user_id = $user_id;
            $cartItem->product_id = $product_id;
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }

        return back()->with('success', 'Product added to cart successfully!');
    }

    public function destroy($cartItemId)
    {
        $userId = Auth::id();
        $cartItem = Cart::where('id', $cartItemId)
                        ->where('user_id', $userId)
                        ->first();

        if ($cartItem) {
            $cartItem->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
        } else {
            return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
        }
    }
    public function purchase(Request $request)
{
    $userId = Auth::id();
    $cartItems = Cart::where('user_id', $userId)->get();
    $shipment = Shipment::where('user_id', $userId)->latest()->first();

    // Initialize Razorpay API
    $api = new Api(config('razorpay.key'), config('razorpay.secret'));

    try {
        // Fetch the payment details
        $payment = $api->payment->fetch($request->razorpay_payment_id);

        // Initialize $paymentToken as an empty object
        $paymentToken = new stdClass();

        // Assign the value to the 'payment_token' property
        $paymentToken->payment_token = $request->_token ?? '';

        // Store payment details
        PaymentDetail::create([
            'razorpay_payment_id' => $payment->id,
            'payment_token' => $paymentToken->payment_token, // Use the assigned value
            'amount' => $payment->amount,
        ]);

        // Store order details
        foreach ($cartItems as $cartItem) {
            Order::create([
                'user_id' => $userId,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'address_id' => $shipment->id,
            ]);

            // Clear cart item
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Purchase completed successfully');
    } catch (Exception $e) {
        \Log::error('Payment failed: ' . $e->getMessage());
        return redirect()->route('cart.index')->with('error', 'Payment failed: ' . $e->getMessage());
    }
}
}