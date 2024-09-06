<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class PaymentController extends Controller
{
    /* Getting a client secret key from stripe-end */
    public function ajaxintent(Request $request)
    {
        if($request->ajax()){
            $userdata=Auth::user();            
            $requestData = $request->all();
            return response()->json(['status'=>'success','intent_id'=>$userdata->createSetupIntent()->client_secret]);
        }
        return response()->json(['status'=>'error','msg'=>'Invalid request.']);
    }


    /* Payment process for stripe */
    public function purchase(Request $request){
        if($request->isMethod('post')){ 
            /* Getting a current logged user details */
            $userdata= Auth::user();

            /* Getting a stripe payment related request form checkout page */
            $paymentMethod = $request->payment_method;
            $productInfo = $request->productInfo;

            
            /* Checking a product is valid or not */
            try {
                $productData = Product::find($productInfo); 
                
            } catch (DecryptException $e) {
                return redirect()->route('home')->with('error','Product is invalid.');
            }
            
            /* Processing a stripe payment */
            try {
                /* Checking a user is available in stripe otherwise creating a new user into stripe */
                if (is_null($userdata->stripe_id)) {
                    $createUserOptions = [
                        'name' => $userdata->name
                    ];
                    $userdata->createOrGetStripeCustomer($createUserOptions);
                }

                /* Updating a default payment method in stripe for logged user */
                $userdata->updateDefaultPaymentMethod($paymentMethod);

                /*Charging a amout through a credit card */
                $orderNumber= strtotime("now");
                $payment=$userdata->charge($productData->price * 100, $paymentMethod,['description'=>$productData->description,"metadata" => ["orderNumber" => $orderNumber]]);    
                /* if payment is success to redirect a success page otherwise displaying a error in the checkout page */
                if($payment->status=='succeeded'){   
                    return redirect()->route('success')->with('success','Your payment done successfully.');  
                }
                return back()->with('error','Somgthing went wrong in the payment process. Please try again later or contact to SM team.');
            } catch (\Exception $exception) {
                return back()->with('error', $exception->getMessage());
            }
        }
        return back()->with('error','Invalid request.');
    }



}
