<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use Carbon\Carbon;
use App\Member;
use App\EmailExist;

class ImportController extends Controller
{
        public function userAdd()
        {    
            return view('userAdd');
        }



        public function userAddPost(Request $request)
        {    
            $file = $request->file;
            
            $validator = Validator::make(
                [
                    'file'      => $file,
                    'extension' => strtolower($file->getClientOriginalExtension()),
                ],
                [
                    'file'          => 'required',
                    'extension'      => 'required|in:csv',
                ]
            );
            

            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }

            $file = $request->file('file');
            $csvData = file_get_contents($file);

            $rows = array_map("str_getcsv", explode("\n", $csvData));

            $header = ["name","email","mobile_number" ];

    $keyCount = count($rows)-1;

        foreach ($rows as $key => $row) {
    $rowCount = count($row);

            if($key < $keyCount && $rowCount == 3 && $row[0] != "" && $row[1] != "" &&  $row[2] != ""){
                $row = array_combine($header, $row);

                $userEmailExist = User::where('email',$row['email'])->orWhere('mobile_number',$row['mobile_number'])->first();
                $memberEmailExist = Member::where('email',$row['email'])->orWhere('mobile_number',$row['mobile_number'])->first();

                if(!$userEmailExist && !$memberEmailExist){
                User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile_number' => $row['mobile_number'],
                    'user_type' => "MEMBER",
                    'password' => \Hash::make($row['mobile_number']),
                ]);


                $month = Carbon::now()->format('m');
                $year = Carbon::now()->year;
                $lastInsertId = User::orderBy('id','DESC')->first();

                $member_id='VSS'.$month.$year.sprintf("%07d", $lastInsertId->id);
                $user = User::find($lastInsertId->id);
                $user->member_id = $member_id;
                $user->save();

                $member = Member::create([
                    'member_id' => $member_id,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'email_verification_status' => "false", 
                    'sex' => "",
                    'dob' => "",
                    'referral_id' => "",
                    'country' => "",
                    'state' => "",
                    'zone' => "",
                    'district' => "1",
                    'taluk' => "",
                    'pincode' => "",
                    'address_1' => "",
                    'mobile_number' => $row['mobile_number'],
                    'whatsapp_number' => "",
                ]);

            }
            }
            
            
        if($key < $keyCount && $rowCount == 3 && $row[0] != "" && $row[1] == "" &&  $row[2] != ""){
                $row = array_combine($header, $row);

                User::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'mobile_number' => $row['mobile_number'],
                    'user_type' => "MEMBER",
                    'password' => \Hash::make($row['mobile_number']),
                ]);


                $month = Carbon::now()->format('m');
                $year = Carbon::now()->year;
                $lastInsertId = User::orderBy('id','DESC')->first();

                $member_id='VSS'.$month.$year.sprintf("%07d", $lastInsertId->id);
                $user = User::find($lastInsertId->id);
                $user->member_id = $member_id;
                $user->email = $member_id."@gmail.com";
                $user->save();
                
                $row['email'] = $member_id."@gmail.com";
                
                $member = Member::create([
                    'member_id' => $member_id,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'email_verification_status' => "false", 
                    'sex' => "",
                    'dob' => "",
                    'referral_id' => "",
                    'country' => "",
                    'state' => "",
                    'zone' => "",
                    'district' => "1",
                    'taluk' => "",
                    'pincode' => "",
                    'address_1' => "",
                    'mobile_number' => $row['mobile_number'],
                    'whatsapp_number' => "",
                ]);

        
            
            }


}
        return redirect()->back()->with('message', 'Data Inserted Success!');

     

        }        
    }
