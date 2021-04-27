<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContributionMode;
use App\Models\ContributionModeType;
use App\Models\OnlineContribution;
use App\Models\OfflineContribution;
use App\Models\User;
use App\Models\Member;
use App\Models\Subscription;
use Validator;
use Razorpay\Api\Api;
use Carbon\Carbon;
use Session;
use PDF;

class ContributionController extends ApiController
{

    /**************Web Services****************/

    public function StorePayment(Request $request)
    {
        $rules = array (
            'member_id' => 'required',
            'token' => 'required',
            'payment_status'=>'required',
            'payment_flag' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token']))
            {
                $payment_flag=$request->payment_flag;
                if($payment_flag=='C'){
                    if($request->order_id!=null){
                        
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'ON/NEFT/'.$date.'/'.$month.'/'.$year;
                             $contributionId = Member::where('Member_id',$request->member_id)->first();
                             $OnlineContribution = OnlineContribution::where("Online_Contribution_id", $request->id)->first();

                             $data = [
                                    'name' => $contributionId->First_Name,
                                    'date' => date('m/d/Y'),
                                    'amount' => $OnlineContribution->Online_Contribution_amount,
                                    'type' =>'NEFT',
                                    'no' => $request->id,
                                    'receiptNo' =>$code,
                                    'Instnumber' => '',
                                ];

                            $imageName = $contributionId->First_Name.'_'.time(). '.pdf';
                            $pdf = PDF::loadView('myPDF',$data);
                            $pdf->save('Receipts/'.$imageName);

                            
                            
                            $OnlineContribution = OnlineContribution::where("Online_Contribution_id", $request->id)->update(['Online_Contribution_date'=> $request->date,'order_id'=> $request->order_id, 'payment_id'=> $request->payment_id,'digital_signature'=> $request->digital_signature,'email_id'=> $request->email_id,'mobile_number'=> $request->mobile_number,'payment_status'=> $request->payment_status,'Receipt_Code'=> $code,'My_receipts_path'=> config('app.url').'public/Receipts/'.$imageName]);
                    }
                    else{
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'ON/NEFT/'.$date.'/'.$month.'/'.$year;
                            $date = date("Y-m-d");
                            $date = date('Y-m-d', strtotime($date. ' + 1 year'));
                            
                            $OnlineContribution = OnlineContribution::where("Online_Contribution_id", $request->id)->update(['Online_Contribution_date'=> $request->date,'email_id'=> $request->email_id,'mobile_number'=> $request->mobile_number, 'payment_status'=> $request->payment_status,'Receipt_Code'=> $code]);
                    }
                }elseif ($payment_flag=='S') {
                    if($request->order_id!=null){
                        
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'ON/NEFT/'.$date.'/'.$month.'/'.$year;
                             $subscriptionId = Member::where('Member_id',$request->member_id)->first();
                             $Subscription = Subscription::where("Subscription_id", $request->id)->first();

                             $data = [
                                    'name' => $subscriptionId->First_Name,
                                    'date' => date('m/d/Y'),
                                    'amount' => $Subscription->Subscription_amount,
                                    'type' =>'NEFT',
                                    'no' => $request->id,
                                    'receiptNo' =>$code,
                                    'Instnumber' => '',
                                ];

                            $imageName = $subscriptionId->First_Name.'_'.time(). '.pdf';
                            $pdf = PDF::loadView('myPDF',$data);
                            $pdf->save('Subscription/'.$imageName);
                            $date = date("Y-m-d");
                            $date = date('Y-m-d', strtotime($date. ' + 1 year'));
                            
                            $Subscription = Subscription::where("Subscription_id", $request->id)->update(['Subscription_start_date' => date('Y-m-d'),'Subscription_end_date' => $date, 'order_id'=> $request->order_id,'payment_id'=> $request->payment_id,'digital_signature'=> $request->digital_signature,'email_id'=> $request->email_id,'mobile_number'=> $request->mobile_number,'payment_status'=> $request->payment_status,'Receipt_Code'=> $code,'My_receipts_path'=> config('app.url').'public/Subscription/'.$imageName]);
                    }
                    else{
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'ON/NEFT/'.$date.'/'.$month.'/'.$year;
                            
                            $Subscription = Subscription::where("Subscription_id", $request->id)->update(['Subscription_date'=> $request->date,'email_id'=> $request->email_id,'mobile_number'=> $request->mobile_number,'payment_status'=> $request->payment_status,'Receipt_Code'=> $code]);
                    }
                }

                    if($request->payment_status=='Payment Successfull')
                    {
                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => $request->payment_status,
                                    ]);
                    }
                    else
                    {
                        return $this->respond([
                            'status' => 'Failed',
                            'code' => $this->getStatusCode(),
                            'message' => $request->payment_status,
                        ]);
                    }
                }
                else
                {
                    return $this->respondTokenError("Token Mismatched");
                }
                
                
            }
           
    }

    public function StoreOfflinePayment(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'amount' => 'required',
            'mobilenumber' => 'required',
            'type' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token']))
            {
               $OfflineContribution =  OfflineContribution::where('Mobile_No',$request->mobilenumber)->first();
               $member =  Member::where('Mobile_No',$request->mobilenumber)->first();
                if(!$OfflineContribution)
                {
                    $OfflineContribution =  new OfflineContribution();
                    $OfflineContribution->Mobile_No = $request->mobilenumber;
                    $OfflineContribution->First_Name = $request->first_name;
                    $OfflineContribution->Last_Name = $request->last_name;
                    $OfflineContribution->Member_id = $request->member_id;
                    $OfflineContribution->Whatsapp_No = $request->whatsappnumber;
                    $OfflineContribution->Email_Id = $request->email;
                    $OfflineContribution->pincode = $request->pincode;
                    $OfflineContribution->pan_number = $request->pan_number;
                    $OfflineContribution->karyakathas_name = $request->karyakathas_name;
                    $OfflineContribution->postal_address = $request->postal_address;
                    $OfflineContribution->Offline_Contribution_amount = $request->amount;
                    $OfflineContribution->Offline_Contribution_date = date('Y-m-d');
                    $OfflineContribution->drs_Inst_Type = $request->type;
                    $OfflineContribution->drs_Inst_No = $request->Instnumber;
                    $OfflineContribution->realised_amount = $request->amount;
                    $OfflineContribution->Due_amount = $request->amount;
                    $OfflineContribution->realised_date = 'Nill';
                    $OfflineContribution->Offline_Contribution_payment_status = "Pending";
                    $OfflineContribution->Intrs_to_volunteer = $request->is_volunteer;
                    $OfflineContribution->Offline_mode = "V";
                    
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'OFF/'.$request->type.'/'.$date.'/'.$month.'/'.$year;
                            $OfflineContribution->Receipt_Code = $code;
                           
                    if($OfflineContribution->save())
                    {
                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'Payment SuccessFull',
                                    ]);
                    }
                    else
                    {
                        return $this->respond([
                            'status' => 'Failed',
                            'code' => $this->getStatusCode(),
                            'message' => 'Failed to update Payment',
                        ]);
                    }
                }
                else
                {

                    $OfflineContribution = OfflineContribution::where("Mobile_No", $request->mobilenumber)->update(['Offline_Contribution_amount'=> $request->amount,'Offline_Contribution_date'=> $request->date,'First_Name'=> $request->first_name,'Last_Name'=> $request->last_name,'Member_id'=> $request->member_id,'Whatsapp_No'=> $request->whatsapp_number,'drs_Inst_Type'=> $request->type,'drs_Inst_No'=> $request->Instnumber,'Email_Id'=> $request->email,'Offline_Contribution_payment_status'=> 'Pending','Offline_mode'=> 'V','realised_amount'=> $request->amount,'realised_date'=> 'Nill','Due_amount'=> $request->amount,'Intrs_to_volunteer'=>$request['is_volunteer']]);
                   
                            $date = Carbon::now()->format('d');
                            $month = Carbon::now()->format('m');
                            $year = Carbon::now()->year;

                            $code = 'OFF/'.$request->type.'/'.$date.'/'.$month.'/'.$year;

                            $OfflineContribution = OfflineContribution::where("Mobile_No", $request->mobilenumber)->update(['Receipt_Code'=> $code]);
                       

                    if($OfflineContribution)
                    {
                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'Payment SuccessFull',
                                    ]);
                    }
                    else
                    {
                        return $this->respond([
                            'status' => 'Failed',
                            'code' => $this->getStatusCode(),
                            'message' => 'Failed to update Payment',
                        ]);
                    }
                }
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function is_valid_token($token)
    {
        $user = User::where('api_token', $token)->first();
        return $user;
    }

    public function getOrderId(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'amount' => 'required',
            'member_id' => 'required',
            'payment_flag' => 'required'
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token'])){
                $api = new Api(config('app.key_id'),config('app.key_secret'));
                $order  = $api->order->create(array('receipt' => '123', 'amount' => $request->amount*100, 'currency' => 'INR')); // Creates order
                $orderId = $order['id']; // Get the created Order ID
                if($orderId)
                {
                    $payment_flag=$request->payment_flag;
                    if($payment_flag=='C'){
                        $OnlineContribution =  new OnlineContribution();
                        $OnlineContribution->Online_Contribution_amount = $request->amount;
                        $OnlineContribution->Member_id = $request->member_id;
                        $OnlineContribution->order_id = $orderId;
                        $OnlineContribution->save();

                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'data' => [
                                "orderId" => $orderId,
                                "razorpaykey" => config('app.key_id'),
                                "id" => $OnlineContribution->id
                            ],
                            'message' => 'Success',
                        ]);

                    }elseif ($payment_flag=='S') {
                        $Subscription =  new Subscription();
                        $Subscription->Subscription_amount = $request->amount;
                        $Subscription->Member_id = $request->member_id;
                        $Subscription->order_id = $orderId;
                        $Subscription->save();

                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'data' => [
                                "orderId" => $orderId,
                                "razorpaykey" => config('app.key_id'),
                                "id" => $Subscription->id
                            ],
                            'message' => 'Success',
                        ]);
                    }else{

                    }

                    
                }
                else
                {
                    return $this->respond([
                        'status' => 'Failed',
                        'code' => $this->getStatusCode(),
                        'message' => 'Failed',
                    ]);
                }
            }
            else
            {
                return $this->respondTokenError("Token Mismatched");
            }
        }
    }

    public function Receipts(Request $request)
    {
        $rules = array (
            'token' => 'required',
            'member_id' => 'required',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator-> fails())
        {
            return $this->respondValidationError('Fields Validation Failed.', $validator->errors());
        }
        else
        {
            if($user=$this->is_valid_token($request['token']))
            {

                $OfflineReceipt = OfflineContribution::where("Member_id", $request->member_id)->select('My_receipts_path')->where('My_receipts_path','!=',null)->get();

                $OnlineReceipt = OnlineContribution::where("Member_id", $request->member_id)->select('My_receipts_path')->where('My_receipts_path','!=',null)->get();
                
                 $OfflineReceiptcount = OfflineContribution::where("Member_id", $request->member_id)->where('My_receipts_path','!=',null)->count();
                 
                 $OnlineReceiptcount = OnlineContribution::where("Member_id", $request->member_id)->where('My_receipts_path','!=',null)->count();

               

                if($OfflineReceiptcount!=0 || $OnlineReceiptcount!=0)
                    {
                        return $this->respond([
                            'status' => 'success',
                            'code' => $this->getStatusCode(),
                            'message' => 'success',
                            'data' => array([
                                'OnlineReceipts' =>$OnlineReceipt,
                                'OfflineReceipts' =>$OfflineReceipt,
                            ])
                         ]);
                    }
                    else
                    {
                        return $this->respond([
                            'status' => 'Failed',
                            'code' => 400,
                            'message' => 'Receipts not found',
                        ]);
                    }

            }
            else
            {
                    return $this->respondTokenError("Token Mismatched");
            }
        }
    }   

    /*************** Web Application***************/
    
    public function ShowContributions(Request $request)
    {
        $member =  Member::get();  
        $memberEmail =  Member::get();
        $offline = $request->session()->get('offline');
        return view('contribution.offline',compact('member','memberEmail','offline'));
        
    }
    public function listContributions()
    {
        $OfflineContribution = OfflineContribution::where('Offline_Contribution_payment_status','Pending')->get();
        return view('contribution.list',compact('OfflineContribution'));
    }

    public function SaveContributions(Request $request)
    {
        $offline = new OfflineContribution();
        $offline->fill($request->all());
        $request->session()->put('offline',$offline);
        return view('contribution.offlinepayment',compact('offline'));
    }

    public function CreateContributions(Request $request)
    {
       
        $contributionId = $request->session()->get('offline');
        $date = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->year;
        $Offline = OfflineContribution::where('Offline_Contribution_payment_status','Completed')->orderby('Offline_Contribution_id','desc')->first();
        if($Offline!=null)
        {
            $invoice = (str_pad((int)$Offline->Offline_Contribution_id+1 + 1, 8, '0', STR_PAD_LEFT));
        }
        else
        {
           $invoice = (str_pad((int)'1' + 1, 8, '0', STR_PAD_LEFT)); 
        }

        if($request->type=="Cash")
        {
            $code = 'OFF/CH'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        elseif($request->type=="Cheque")
        {
            $code = 'OFF/CHQ'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        else if($request->type=="Challan")
        {
            $code = 'OFF/CHA'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        else
        {
            $code = 'OFF/DD'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }

        if($request->type=="Cash" || $request->type=="Challan")
        {
            $data = [
                'name' => $contributionId->First_Name,
                'date' => date('m/d/Y'),
                'amount' => $request->amount,
                'type' => $request->type,
                'Instnumber' => $request->Instnumber,
                'no' => $contributionId->Offline_Contribution_id,
                'receiptNo' =>$code
            ];
           
            $imageName = $contributionId->First_Name.'_'.time(). '.pdf';
            $pdf = PDF::loadView('myPDF',$data);
            $pdf->save('Receipts/'.$imageName);
            $OfflineContribution = $request->session()->get('offline');
            $OfflineContribution->Offline_Contribution_amount = $request->amount;
            $OfflineContribution->Offline_Contribution_date = $request->date;
            $OfflineContribution->drs_Inst_Type = $request->type;
            $OfflineContribution->drs_Inst_No =  $request->Instnumber;
            $OfflineContribution->Offline_Contribution_payment_status = 'Completed'; 
            $OfflineContribution->Due_amount = "0" ;
            $OfflineContribution->Offline_mode = "A";
            $OfflineContribution->realised_amount = $request->amount;
            $OfflineContribution->realised_date = $request->date;
            $OfflineContribution->Receipt_Code = $code;
            $OfflineContribution->My_receipts_path = config('app.url').'public/Receipts/'.$imageName;
            $OfflineContribution->save();
            

               

        }
        else
        {
            $OfflineContribution = $request->session()->get('offline');
            $OfflineContribution->Offline_Contribution_amount = $request->amount;
            $OfflineContribution->Offline_Contribution_date = $request->date;
            $OfflineContribution->drs_Inst_Type = $request->type;
            $OfflineContribution->drs_Inst_No =  $request->Instnumber;
            $OfflineContribution->Offline_Contribution_payment_status = 'Pending'; 
            $OfflineContribution->Due_amount = $request->amount ;
            $OfflineContribution->Offline_mode = "A";
            $OfflineContribution->Receipt_Code = $code;
            $OfflineContribution->realised_amount = $request->amount;
            $OfflineContribution->My_receipts_path = null;
            $OfflineContribution->save();
        }

        Session::forget('offline');
        return redirect(route('listContributions'));  
    }


    public function EditContributions($contributionId)
    {
            $OfflineContribution = OfflineContribution::where("Offline_Contribution_id",$contributionId)->first();
            $member =  Member::get();  
            $memberEmail =  Member::get();
            return view('contribution.edit',compact('member','memberEmail'))->with([
            'OfflineContribution'   => $OfflineContribution
            
        ]);
    }

    public function UpdateContributions(Request $request)
    {

        $contributionId = OfflineContribution::where("Offline_Contribution_id",$request->ContributionId)->first();        
        $date = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->year;
        $Offline = OfflineContribution::where('Offline_Contribution_payment_status','Completed')->orderby('Offline_Contribution_id','desc')->first();

       if($Offline!=null){
        $invoice =(str_pad((int)$Offline->Offline_Contribution_id+1 + 1, 8, '0', STR_PAD_LEFT));
    }else{
        $invoice =(str_pad((int)1 + 1, 8, '0', STR_PAD_LEFT));
    }
        

        if($contributionId->drs_Inst_Type=="Cash")
        {
            $code = 'OFF/CH'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        elseif($contributionId->drs_Inst_Type=="Cheque")
        {
            $code = 'OFF/CHQ'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        else if($contributionId->drs_Inst_Type=="Challan")
        {
            $code = 'OFF/CHA'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
        else
        {
            $code = 'OFF/DD'.'/'.$invoice.'/'.$date.'/'.$month.'/'.$year;
        }
               
        
        if($request->due_amount-$request->realised_amount=='0')
        {
            $data = [
                'name' => $contributionId->First_Name,
                'date' => date('m/d/Y'),
                'amount' => $request->amount,
                'type' => $contributionId->drs_Inst_Type,
                'no' => $request->ContributionId,
                'receiptNo' =>$code,
                'Instnumber' => $contributionId->drs_Inst_No,
            ];
           
            $imageName = $contributionId->First_Name.'_'.time(). '.pdf';
            $pdf = PDF::loadView('myPDF',$data);
            $pdf->save('Receipts/'.$imageName);

             $PollsQuestions = OfflineContribution::where("Offline_Contribution_id",$request->ContributionId)->update([
                                
                                'Offline_Contribution_payment_status'=>"Completed",
                                'realised_amount'=>$request->realised_amount,
                                'realised_date'=>$request->realised_date,
                                'Due_amount'=>$request->due_amount-$request->realised_amount,'Receipt_Code'=> $code,'My_receipts_path'=> config('app.url').'public/Receipts/'.$imageName
                            ]);
        }
        else
        {
                $PollsQuestions = OfflineContribution::where("Offline_Contribution_id",$request->ContributionId)->update([
                                
                                'Offline_Contribution_payment_status'=>"Pending",
                                'realised_amount'=>$request->realised_amount,
                                'realised_date'=>$request->realised_date,
                                'Due_amount'=>$request->due_amount-$request->realised_amount,
                                'Receipt_Code'=> $code,
                                'My_receipts_path'=> null
                            ]);
        }
       

        return redirect(route('listContributions'));  
    }

    
    
}