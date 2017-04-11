<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
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
    public function search(Request $request)
    {
        $cert = $request->input('cert');
        

        if(strlen($cert) > 0){
             
             $check = DB::table('info')->where(['Cert' => $cert,])->get();
             if(count($check) > 0){
                for($i=0; $i<count($check); $i++){
                $datas = DB::table('info')->select('FirstName', 'SecondName', 'LastName', 'Cert', 'Year', 'Registration', 'School')->where(['cert' => $cert])->get();
                
                foreach($datas as $data){
                        $FirstName = $data->FirstName;
                        $SecondName = $data->SecondName;
                        $LastName = $data->LastName;
                        $Cert = $data->Cert;
                        $Year = $data->Year;
                        $Registration = $data->Registration;
                        $School = $data->School;
                       }
                if($request->session()->has('FirstName')){
                            $data=$request->session()->get('FirstName');  
                        }
                return response(array(
                    'results' =>$datas->toArray(), 
                    ),200);
                    }
             }else{
            return response(array(
                "Message" => "This Certificate number does not exist",
                "code" => 209,
                "status" => "no-match",
                
             ));
             }
        }else{
              return response(array(
                "Message" => "Please enter your certificate number to verify",
                "code" => 209,
                "status" => "fail",
             ));
        }
        }
       
    


    public function bulk(Request $request){
        $input = $request->input('box');
        $box= array();
        for($i=0; $i<10; $i++){
            $box[$i] = $input;
        }
        print_r($box);
        for($i=0; $i<count($box); $i++){

           if(count($box[$i]) > 0){
            $check = DB::table('info')->select('name', 'box', 'code', 'town', 'category')->where(['box' => $box[$i]])->get();
            if(count($check) < 1){
                return response(array(
                "Message" => "P.O Box dont exist",
                "code" => 209,
                "status" => "fail",
                ));
            }else{
                 $datas = DB::table('info')->select('name', 'box', 'code', 'town', 'category')->where(['box' => $box[$i]])->get();
                foreach($datas as $data){
                        $name = $data->name;
                        $box = $data->box;
                        $code = $data->code;
                        $town = $data->town; 
                    }
            } 
        }
            return response(array(
                    "message" => "Verified",
                    "Name" => $name,
                    "Box" => $box,
                    "code" => $code,
                    "Town" => $town,
                ));
           }
       }
    

    public function private(Request $request)
    {
        $name = $request->input('name');
        $box = $request->input('box');
        $code = $request->input('code');
        $town = $request->input('town');

        if(strlen($name) < 1){
            return response(array(
                "Message" => "Please enter the name",
                "code" => 209,
                "status" => "No name",
                ));
            }else if(strlen($box) < 1){
                return response(array(
                "Message" => "Please enter the Box number",
                "code" => 209,
                "status" => "No Po Box",
                ));
            }else if(strlen($code) < 1){
                return response(array(
                "Message" => "Please enter the code",
                "code" => 209,
                "status" => "No Code number",
                ));
            }else if(strlen($town) < 1){
                return response(array(
                "Message" => "Please enter the town",
                "code" => 209,
                "status" => "No town entered",
                ));
            }else{
                
             $check = DB::table('info')->where(['box' => $box])->get();
             if(count($check) > 0){
                $datas = DB::table('info')->select('name', 'box', 'code', 'town', 'category')->where(['box' => $box])->get();
                foreach($datas as $data){
                        $name = $data->name;
                        $box = $data->box;
                        $code = $data->code;
                        $town = $data->town;
                       }
                   }
                return response(array(
                    "message" => "Verified",
                    "Name" => $name,
                    "Box" => $box,
                    "code" => $code,
                    "Town" => $town,
                    ),200);
             
        }
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
