<?php

namespace App\Http\Controllers;

use App\Aos;
use App\Feedback;
use App\Advertisement;
use App\Member;
use App\Notification;
use App\Pollquestion;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Response;
use Excel;
 
class XlsxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //last month reports
    public function lastmonth_ads()
    {
        $currentMonth = date('m');
        $lastmonth_ads = Advertisement::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        $filename = "reports.lastmonth_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($lastmonth_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastmonth_ads.xlsx', $headers);
    }

        public function lastmonth_members()
    {
        $currentMonth = date('m');
        $lastmonth_members = Member::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        $filename = "reports.lastmonth_members.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        foreach($lastmonth_members as $row) {
            fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastmonth_members.xlsx', $headers);
    }

   public function lastmonth_notifications()
    {
        $currentMonth = date('m');
        $lastmonth_notifications = Notification::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
        $filename = "reports.lastmonth_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($lastmonth_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastmonth_notifications.xlsx', $headers);
    }
    public function lastmonth_polls()
    {
        $currentMonth = date('m');
        $lastmonth_polls = Pollquestion::whereRaw('MONTH(created_at) = ?',[$currentMonth])->get();
       // $lastmonth_ads = Advertisement::all();
        $filename = "reports.lastmonth_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($lastmonth_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastmonth_polls.xlsx', $headers);
    }

    


    //last year reports
    public function lastyear_ads()
    {
        $lastyear_ads = Advertisement::whereYear('created_at', date('Y'))->get();
        $filename = "reports.lastyear_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($lastyear_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastyear_ads.xlsx', $headers);
    }

        public function lastyear_members()
    {
        $lastyear_members = Member::whereYear('created_at', date('Y'))->get();
        $filename = "reports.lastyear_members.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        foreach($lastyear_members as $row) {
            fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastyear_members.xlsx', $headers);
    }

   public function lastyear_notifications()
    {
        $lastyear_notifications = Notification::whereYear('created_at', date('Y'))->get();
       
        $filename = "reports.lastyear_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($lastyear_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastyear_notifications.xlsx', $headers);
    }
    public function lastyear_polls()
    {
        $lastyear_polls = Pollquestion::whereYear('created_at', date('Y'))->get();
        $filename = "reports.lastyear_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($lastyear_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'lastyear_polls.xlsx', $headers);
    }



//Total reports
    public function total_ads()
    {
        $total_ads = Advertisement::get()->all();
        $filename = "reports.total_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($total_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'total_ads.xlsx', $headers);
    }

        public function total_members($type)
    {
        
        $data = Member::get()->toArray();

        return Excel::create('totalMembers', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);
        
        // $total_members = Member::get()->all();
        // $filename = "reports.total_members.xlsx";
        // $handle = fopen($filename, 'w+');
        // fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        // foreach($total_members as $row) {
        //     fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        // }

        // fclose($handle);

        // $headers = array(
        //     'Content-Type' => 'text/xlsx',
        // );

        // return Response::download($filename, 'total_members.xlsx', $headers);
    }

   public function total_notifications()
    {
        $total_notifications = Notification::get()->all();
        $filename = "reports.total_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($total_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'total_notifications.xlsx', $headers);
    }
    public function total_polls()
    {
        $total_polls = Pollquestion::get()->all();
        $filename = "reports.total_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($total_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'total_polls.xlsx', $headers);
    }



//this week reports
    public function lastweek_ads()
    {
        $lastweek_ads = Advertisement::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $filename = "reports.lastweek_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($lastweek_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'thisweek_ads.xlsx', $headers);
    }

        public function lastweek_members()
    {
        $lastweek_members = Member::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $filename = "reports.lastweek_members.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        foreach($lastweek_members as $row) {
            fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'thisweek_members.xlsx', $headers);
    }

   public function lastweek_notifications()
    {
        $lastweek_notifications = Notification::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $filename = "reports.lastweek_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($lastweek_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'thisweek_notifications.xlsx', $headers);
    }
    public function lastweek_polls()
    {
        $lastweek_polls = Pollquestion::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $filename = "reports.lastweek_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($lastweek_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'thisweek_polls.xlsx', $headers);
    }





    //Yesterday reports
    public function yesterday_ads()
    {
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $yesterday_ads = Advertisement::whereDate('created_at', $yesterday )->get();
        $filename = "reports.yesterday_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($yesterday_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'yesterday_ads.xlsx', $headers);
    }

        public function yesterday_members()
    {
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $yesterday_members = Member::whereDate('created_at', $yesterday )->get();
        $filename = "reports.yesterday_members.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        foreach($yesterday_members as $row) {
            fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'yesterday_members.xlsx', $headers);
    }

   public function yesterday_notifications()
    {
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $yesterday_notifications = Notification::whereDate('created_at', $yesterday )->get();
        $filename = "reports.yesterday_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($yesterday_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'yesterday_notifications.xlsx', $headers);
    }
    public function yesterday_polls()
    {
        $yesterday = date("Y-m-d", strtotime( '-1 days' ) );
        $yesterday_polls = Pollquestion::whereDate('created_at', $yesterday )->get();
        $filename = "reports.yesterday_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($yesterday_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'yesterday_polls.xlsx', $headers);
    }


   




    //today reports
    public function today_ads()
    {
        $today = date("Y-m-d", strtotime( '-1 days' ) );
        $today_ads = Advertisement::whereDate('created_at', Carbon::today())->get();
        $filename = "reports.today_ads.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'Company', 'Link', 'From_date', 'To_date', 'Active'));

        foreach($today_ads as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['company'], $row['link'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'today_ads.xlsx', $headers);
    }

        public function today_members()
    {
        $today = date("Y-m-d", strtotime( '-1 days' ) );
        $today_members = Member::whereDate('created_at', Carbon::today())->get();
        $filename = "reports.today_members.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Member_id', 'Name', 'Mobile_number', 'Dob', 'Sex', 'Email', 'Address'));

        foreach($today_members as $row) {
            fputcsv($handle, array($row['created_at'], $row['member_id'], $row['name'], $row['mobile_number'], $row['dob'], $row['sex'], $row['email'], $row['address_1']  ));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'today_members.xlsx', $headers);
    }

   public function today_notifications()
    {
        $today = date("Y-m-d", strtotime( '-1 days' ) );
        $today_notifications = Notification::whereDate('created_at', Carbon::today())->get();
        $filename = "reports.today_notifications.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Description', 'From_date', 'To_date', 'Active'));

        foreach($today_notifications as $row) {
            fputcsv($handle, array($row['created_at'], $row['description'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'today_notifications.xlsx', $headers);
    }
    public function today_polls()
    {
        $today = date("Y-m-d", strtotime( '-1 days' ) );
        $today_polls = Pollquestion::whereDate('created_at', Carbon::today())->get();
        $filename = "reports.today_polls.xlsx";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Booked_date', 'Question', 'From_date', 'To_date', 'Active'));

        foreach($today_polls as $row) {
            fputcsv($handle, array($row['created_at'], $row['question'], $row['from_date'], $row['to_date'], $row['active']));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/xlsx',
        );

        return Response::download($filename, 'today_polls.xlsx', $headers);
    }

    
       
}
