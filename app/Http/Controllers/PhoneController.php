<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use AfricasTalkingGateway;

class PhoneController extends Controller
{
    public function join(Request $request){
        $from = $request->input('from');
        $text = $request->input('text');
        $to = $request->input('to');
        $id = $request->input('id');

        if(strlen($from) > 0 && strlen($text) > 0){
            $phone = '55555';
            $text  =  "To register, reply with. name#yourname#email#youremail#password#yourpassword. name#john#email#example@gmail.com#password#12345";
            $this->send($to, $text); 
            return response(array(
                    "status" => "success"
                ));
        }
    }

    public function phoneRegister(Request $request){
        $from = $request->input('from');
        $text = $request->input('text');
        $to = $request->input('to');
        $id = $request->input('id');
        $code = rand( 10000, 99999 );

        $phone = '55555';
        $text  =  "To use Posta sms, 1. Reply with 1 to verify box. 2. Reply with 2 to check credit balance";

            if(strlen($from) > 0 && strlen($text) > 0){
                $details = explode('#', $text);
                $firstName = $details[1];
                $lastName = $details[3];
                $email = $details[5];
                $password= $details[7];
                $add[] = ['FirstName' => $firstName, 'Phone' => $from, 'LastName' => $lastName, 'Email' => $email, 'Password' => $password, 'Code' => $code];
                }

                if(!empty($add)){
                    DB::table('persons')->insert($add);
                    $phone = '55555';
                    $text  =  "To use, reply with. 1. To verify box number. 2. To check credit balance";
                    $this->send($to, $text); 
                    return response(array(
                        "Message" => "Registration successful",
                        "status" => "success",
                        "code" => 200,
                        ));
                }
    }

    public function codeCheck(Request $request){
        $from = $request->input('from');
        $text = $request->input('text');
        $to = $request->input('to');
        $id = $request->input('id');
        if(strlen($from) > 0 && strlen($text) > 0){
                $details = explode('#', $text);
                $box = $details[1];
                $code = $details[3];
                
                $check = DB::table('info')->where(['box' => $box, 'code' => $code])->get();
                if(count($check) > 0){
                    for($i=0; $i<count($check); $i++){
                    $datas = DB::table('info')->select('name', 'box', 'code', 'town', 'category')->where(['box' => $box, 'code'=>$code])->get();
                    
                    foreach($datas as $data){
                            $name = $data->name;
                            $box = $data->box;
                            $code = $data->code;
                            $town = $data->town;
                           }
                             return response(array(
                                    'results' =>$datas->toArray(), 
                            ),200);
                           }
                     }else{
                            return response(array(
                                "Message" => "This box and code number combination does not exist",
                                "status" => "no-match",
                                "code" => 200,
                                ));
                     }
                }
       }

    public function creditCheck(Request $request){
        $from = $request->input('from');
        $text = $request->input('text');
        $to = $request->input('to');
        $id = $request->input('id');

        if(strlen($from) > 0 && strlen($text) > 0){
            
            
        }
    }

    public function verifyCode(Request $request){
        
    }


    public function send($to, $text){

           if(strlen($to) == 10){
              require_once(app_path(). '/functions/AfricasTalkingGateway.php');
                $newNum = ltrim($to, "0");
                $numUse = "+254". $newNum;
               
                $username   = "LOGIC";
                $apikey     = "d55cc2f1b6d649bb44ed1a39f8ab2623305a5ebafb442938bebc9a5f3e21e764";
                $recipients = $numUse;
                $message    = $text;
                $gateway    = new AfricasTalkingGateway($username, $apikey);
                try 
                { 
                  $results = $gateway->sendMessage($recipients, $message);
                            
                  foreach($results as $result) {
                    echo " Number: " .$result->number;
                    echo " Status: " .$result->status;
                    echo " MessageId: " .$result->messageId;
                    echo " Cost: "   .$result->cost."\n";
                  }
                }
                catch ( AfricasTalkingGatewayException $e )
                {
                  echo "Encountered an error while sending: ".$e->getMessage();
                }
           }else{
               
                $username   = "LOGIC";
                $apikey     = "d55cc2f1b6d649bb44ed1a39f8ab2623305a5ebafb442938bebc9a5f3e21e764";
                $recipients = $to;
                $message    = $text;
                $gateway    = new AfricasTalkingGateway($username, $apikey);
                try 
                { 
                  $results = $gateway->sendMessage($recipients, $message);
                            
                  foreach($results as $result) {
                    echo " Number: " .$result->number;
                    echo " Status: " .$result->status;
                    echo " MessageId: " .$result->messageId;
                    echo " Cost: "   .$result->cost."\n";
                  }
                }
                catch ( AfricasTalkingGatewayException $e )
                {
                  echo "Encountered an error while sending: ".$e->getMessage();
                }
            }
          
    }

    public function knecCert(Request $request){
        $from = $request->input('from');
        $text = $request->input('text');
        $to = $request->input('to');
        $id = $request->input('id');

         if(strlen($from) > 0 && strlen($text) > 0){
                $details = explode('#', $text);
                if(count($details) > 3){
                    $year = $details[1];
                    $reg = $details[3];

                    $check = DB::table('knecs')->where(['Year' => $year, 'Reg' => $reg]);
                    if(count($check) > 0){
                         $to = 55555;
                         $text = "This ". $reg. " (Registration number) is verified";
                         $this->send($to, $text);
                            return response(array(
                                    "Message" => "Details you have entered above are okay",
                                    "status" => "success",
                                    "code" => $text,
                                   

                                ));
                        }else{
                             return response(array(
                                    "Message" => "This combination of year and reg number does not exist",
                                    "status" => "fail",     

                                ));
                        }
                }else{
                    $cert = $details[1];
                        $check = DB::table('knecs')->where(['Cert' => $cert])->get();
                        if(count($check) > 0){
                            $to = 55555;
                            $text = "This ". $cert. " number is verified";
                            return response(array(
                                    "Message" => "Cert number verified",
                                    "status" => "success",
                                    "code" => $text,
                                   

                                ));
                        }else{
                            return response(array(
                                "Message" => "This cert number does not exist",
                                ));
                        }
                    
                }
            }
    }
}
