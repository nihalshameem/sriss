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
            $validator = Validator::make($request->all(),[
                'file' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }

            $file = $request->file('file');
            $csvData = file_get_contents($file);
            $rows = array_map("str_getcsv", explode("\n", $csvData));
            $header = array_shift($rows);

    $keyCount = count($rows)-1;

            foreach ($rows as $key => $row) {

            if($key < $keyCount){
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

                $member_id='TMP'.$month.$year.sprintf("%07d", $lastInsertId->id);
                $user = User::find($lastInsertId->id);
                $user->member_id = $member_id;
                $user->save();

                $member = Member::create([
                    'member_id' => $member_id,
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'sex' => "",
                    'dob' => "",
                    'referral_id' => "",
                    'country' => "",
                    'state' => "",
                    'zone' => "",
                    'district' => "1",
                    'taluk' => "",
                    'pincode' => "",
                    'address' => "",
                    'referral_id' => "",
                    'father_name' => "",
                    'mobile_number' => $row['mobile_number'],
                    'whatsapp_number' => "",
                ]);


            }else{
                $member = EmailExist::create([
                    'mobile_number' => $row['mobile_number'],
                    'email' => $row['email'],
                ]);
            }
            }
            }



        return redirect()->back()->with('message', 'User Inserted Success!!');;

        }
}
