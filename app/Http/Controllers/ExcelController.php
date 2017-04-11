<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bulk;
use App\View;
use Excel;
use DB;
use Session;

class ExcelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }




    public function downloadExcel(){
          
            $all = DB::table('views')->select('FirstName', 'SecondName', 'LastName', 'Cert', 'Year', 'Registration', 'School', 'status')->get();
            if(count($all) > 0){
            return response(array(
                'all' =>$all-> toArray()
                ),200);  
               }else{
                return response(array(
                    "message" => "You have no data to download",
                    "code" => 204,
                    "status" => "No content",
                    ));
               }  
                         
 }


   public function deleteExcel(){
    DB::table('views')->delete();
   }


   public function buyCredits(Request $request){
    $id = $request->input('id');
    if(strlen($id) > 0){
        $check = DB::table('persons')->select('FirstName', 'LastName', 'Phone', 'Email')->where(['id'=>$id])->get();
        if(strlen($check)>0){
            foreach($check as $values){
                $fname = $values->FirstName;
                $lname = $values->LastName;
                $phone = $values->Phone;
                $email = $values->Email;
            }
             return response(array(
            "Message" => "This id number exist",
            "status" => "success",
            "code" => 209,
            "FirstName" => $fname,
            "LastName" => $lname,
            "Phone" => $phone,
            "Email" => $email
            ));
        }else{
            return response(array(
            "Message" => "This id number does not exist",
            "status" => "fail",
            "code" => 209
            ));
        }
    }else{
        return response(array(
            "Message" => "Please enter your ypur id",
            "status" => "fail",
            "code" => 209
            ));
    }
   }



    public function importExcel(Request $request){
         $data =$request->input('data');
         //dd($data);
         if(count($data) > 0){
            foreach($data as $values){ 
                 
                    $cert = $values['cert'];
                    
                    $searchCert = DB::table('info')->where(['Cert' => $cert])->get();
                    if(count($searchCert) > 0){  
                            
                            $datas = DB::table('info')->select('FirstName', 'SecondName', 'LastName', 'Cert', 'Year', 'Registration', 'School')->where(['Cert' => $cert])->get(); 
                                    foreach ($datas as $data)
                                    {
                                        $fnameVar =  $data->FirstName;
                                        $snameVar =  $data->SecondName;
                                        $lnameVar =  $data->LastName;
                                        $certVar = $data->Cert;
                                        $yearVar = $data->Year;
                                        $regVar = $data->Registration;
                                        $schoolVar = $data->School;
                                        //$person_id = $personId;
                                        $status = "Verified";
                                        $add[] = ['FirstName' => $fnameVar, 'SecondName' => $snameVar,'LastName' => $lnameVar,'Cert' => $certVar, 'Year' => $yearVar, 'Registration' => $regVar, 'School' => $schoolVar,  'status' => $status];

                                      }
                                      }else{
                                        $status = "Not Verified";
                                        $certVar =  $cert;
                                        $yearVar = "null";
                                        $fnameVar = "null";
                                        $snameVar = "null";
                                        $lnameVar = "null";
                                        $regVar = "null";
                                        $schoolVar = "null";
                                        //$person_id = $personId;
                                       
                                        $add[] = ['FirstName' => $fnameVar, 'SecondName' => $snameVar,'LastName' => $lnameVar,'Cert' => $certVar, 'Year' => $yearVar, 'Registration' => $regVar, 'School' => $schoolVar,  'status' => $status];
                                         }
                                     }
                    
                   
            
              
              }
        
         
         if(!empty($add)){
            DB::table('views')->insert($add);
            return response(array(
                                "Message" => "Data has been uploaded successfully, Click Verify to see results",
                                "code" => 200,
                                "status" => "success",
                                
                   ));
        }else{
            return response(array(
                                "Message" => "Data upload has failed",
                                "code" => 200,
                                "status" => "fail",
                                
                   ));
        }



         // if($request->hasFile('import_file')){
         //    $path = $request->file('import_file')->getRealPath();


         //    $data = Excel::load($path, function($reader) {})->get();           
         //    if(!empty($data) && $data->count()){
         //        foreach ($data as $key => $value) {
         //             $insert[] = ['box' =>$value->box , 'code' => $value->code, 'person_id' => $person_id];         
         //            }

         //        if(!empty($insert)){
         //            DB::table('bulks')->insert($insert);
         //           return response(array(
         //                        "Message" => "Data has been uploaded successfully, Click download to check",
         //                        "code" => 200,
         //                        "status" => "success",
                                
         //           ));
                    
         //        }
         //    }
        // }

        // return response(array(
        //                         "Message" => "File Upload failed, Please check your file format",
        //                         "code" => 200,
        //                         "status" => "fail",
        //            ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
