<?php
namespace App\Http\Controllers\Gateways;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\PaymentDetail;

class RazorpayController extends Controller
{
    public function payment(Request $request)
    {   
        $api = new Api(config('razorpay.key'), config('razorpay.secret'));

        if ($request->filled('razorpay_payment_id')) {
            try {
                $paymentId = $request->razorpay_payment_id;

                // Fetch payment details from Razorpay API
                $payment = $api->payment->fetch($paymentId);

                if ($payment) {
                    // Capture the payment
                    $response = $api->payment->fetch($paymentId)
                        ->capture(['amount' => $payment['amount']]);

                    if ($response['status'] == 'captured') {
                        // Payment captured successfully, store payment details
                        $paymentDetail = new PaymentDetail();
                        $paymentDetail->razorpay_payment_id = $paymentId;
                        $paymentDetail->payment_token = $request->_token ?? '';
                        $paymentDetail->amount = $response['amount'];
                        // Add more fields as needed
                        $paymentDetail->save();

                        return 'Payment Success!';
                    } else {
                        return 'Payment capture failed!';
                    }
                } else {
                    return 'Payment not found!';
                }

            } catch (\Exception $e) {
                return $e->getMessage();
            }
        } else {
            return 'Invalid payment ID!';
        }
    }

    public function storePayment(Request $request)
    {
        return $this->payment($request);
    }
}