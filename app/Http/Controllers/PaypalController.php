<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;


class PaypalController extends Controller
{
    public function createOrder(){
          
          $request = new OrdersCreateRequest();
          $request->prefer('return=representation');
          $request->body = [    //body is array have details about the payment
                     "intent" => "CAPTURE",
                     "purchase_units" => [[     //details about order
                         "reference_id" => "test_ref_id1",
                         "amount" => [
                             "value" => "100.00",
                             "currency_code" => "USD"
                         ]
                     ]],
                     "application_context" => [   // 2 route after create order (ok - cancel)
                          "cancel_url" => URL::route('paypal.cancel'),
                          "return_url" => URL::route('paypal.return')
                     ] 
                 ];

        try {
            // Call API with your client and get a response for your call
            $client = $this->getPaypalClient();
            $response = $client->execute($request);
            session()->put('paypal_order_id',$response->result->id);
            if($response->statusCode == 201){
                foreach($response->result->links as $link){
                    if($link == 'approve'){
                        return redirect()->away($link->href);
                    }
                }
            }
    
            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            print_r($response);
        }catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
           }
           }

           protected function getPaypalClient(){
            // Creating an environment
            $paypalData =config('services.paypal');
            $clientId = $paypalData['client_id'];
            $clientSecret = $paypalData['secret'];
            
            $environment = new SandboxEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);
            return $client ;
         }
                                  
         
        
        
         //capture request
        public function paypalReturn(){  
        // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
        // $response->result->id gives the orderId of the order created above
        $request = new OrdersCaptureRequest(session()->get('paypal_order_id'));
        $request->prefer('return=representation');

         try {
        // Call API with your client and get a response for your call
        $client = $this->getPaypalClient();
        $response = $client->execute($request);
        session()->forget('paypal_order_id');
        // If call returns body in response, you can get the deserialized version from the result attribute of the response
        if($response->result->status =='completed'){

        }
        print_r($response);
        }catch (HttpException $ex) {
        echo $ex->statusCode;
        print_r($ex->getMessage());
        }
        }

        public function paypalCancel(){

        }

}
