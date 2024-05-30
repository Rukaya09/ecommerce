<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Categories;

use App\Models\OrderUpdate;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        $user = Auth::user();
        $orders = Order::with(['product', 'shipment', 'orderupdates'])->where('user_id', $user->id)->get();
        // return view('userorder', compact('orders'));
        return view('userorder', compact('orders', 'categories'));

    }
    
    public function showOrders()
    {
        $orders = Order::with('user', 'product')->get();
        return view('admin.orderupdate', compact('orders'));
    }

    public function update(Request $request, $id)
    {
        // Find the order by its ID
        $order = Order::findOrFail($id);
        
        // Check if an order update already exists for this order
        $orderUpdate = OrderUpdate::where('order_id', $order->id)->first();

        if ($orderUpdate) {
            // Update the existing order update record
            $orderUpdate->status = $request->input('status');
        } else {
            // Create a new order update record
            $orderUpdate = new OrderUpdate();
            $orderUpdate->order_id = $order->id;
            $orderUpdate->status = $request->input('status');
        }

        $orderUpdate->save();

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
    
}