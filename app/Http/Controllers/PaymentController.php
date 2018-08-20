<?php
namespace App\Http\Controllers;
use Omnipay\Omnipay as Omnipay;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\UserRepository;


use Mail;
use App\User;
use Illuminate\Http\Request;


use Session;

class PaymentController extends Controller
{
    private $data;
	protected $user_gestion;
	
	public function __construct(
		UserRepository $user_gestion)
	{
		$this->user_gestion = $user_gestion;

	}		
	
    public function getIndex()
    {
         //redirect to payment form
        //return view('users.paypal.form');
    
     }
    public function postPayment($id) 
    {	

	    $plan = $this->user_gestion->getPlanDetails($id);	

		$params = array( 
                    'cancelUrl'     => 'http://allalgos.com/prodconx/public/cancelUrl',
                    'returnUrl'     => 'http://allalgos.com/prodconx/public/returnUrl', 
                    'name'          => $plan->title,
                    'description'   => $plan->description, 
                    'amount'        => $plan->price,
                    'currency'      => "USD",
					'plan_id'      => $id,
					'duration'      => $plan->duration
        );

        session()->put('params', $params); // here you save the params to the session so you can use them later.
        session()->save();


		//echo'<pre>';print_r($params);die;	
		
        $gateway = Omnipay::create('PayPal_Express'); 
        $gateway->setUsername('manoj.allalgos-facilitator_api1.gmail.com');
        $gateway->setPassword('Y95WUBMH6GMPBM6S');
        $gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31A5SPiB.b21oAeZ9D4ywebMkMSF-X');
        $gateway->setTestMode(true); // set it to true when you develop and when you go to production to false
        $response = $gateway->purchase($params)->send(); // here you send details to PayPal
        
        if ($response->isRedirect()) { 
            // redirect to offsite payment gateway 
            $response->redirect(); 
			//return redirect()->url($response->getRedirectUrl());
			//return redirect('returnUrl');
         } 
         else { 
            // payment failed: display message to customer 
            echo $response->getMessage();
        } 
    }
    
    public function getSuccessPayment()
    {
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername('manoj.allalgos-facilitator_api1.gmail.com');
        $gateway->setPassword('Y95WUBMH6GMPBM6S');
        $gateway->setSignature('AFcWxV21C7fd0v3bYYYRCpSSRl31A5SPiB.b21oAeZ9D4ywebMkMSF-X');
        $gateway->setTestMode(true);
        		
		$params = Session::get('params');
		
		//echo'<pre>';print_r($params);

		
		$username = Session::get('email');	
		
        $response = $gateway->completePurchase($params)->send();
        $paypalResponse = $response->getData(); // this is the raw response object
		
		//echo'<pre>';print_r($paypalResponse);die;
		
        if(isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
                
				
				$user_data = $this->user_gestion->getUser_details($username);	
				
				$payment_data = $this->user_gestion->insertPayment($params , $user_data, $paypalResponse['PAYMENTINFO_0_PAYMENTSTATUS'] );
				
				return redirect('userOrder')->with('message', 'Order Completed Successfully !!');	
        
        } else {
                
                //Failed transaction
				return redirect('userOrderCancel')->with('message', 'Order canceled/Failed Successfully !!');
                
        }
            //return View::make('result');
    }
	
	
	public function cancelUrl(){
	
				return redirect('userOrderCancel')->with('message', 'Order canceled Successfully !!');
	}

	public function sendEmail(){

			Mail::raw('Text to e-mail', function($message)
			{
				$message->from('us@example.com', 'Laravel');

				$message->to('naval.allalgos@gmail.com');
			});
	}
	
	
}