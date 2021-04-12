@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding-top:30px;">
   <br>
   <br>
    <section class="content">
        <div class="col-md-12">
            <div class="row">
        
        
          <div class="col-md-12 card">
          
            <div class="card-body">
                
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th style="width:150px;">#</th>
                  <th style="width:150px;text-align:center">Members</th>
                  <th style="width:150px;text-align:center">Notifications</th>
                  <th style="width:150px;text-align:center">Online Contributions</th>
                  <th style="width:150px;text-align:center">Offline Contributions</th>
                  <th style="width:150px;text-align:center">Feedback</th>
                  <th style="width:150px;text-align:center">Volunteer Report</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td >Today</td>
                  <td style="text-align:center">{{$Todaymember}}</td>
                  <td style="text-align:center">{{$Todaynotification}}</td>
                  <td style="text-align:center"> {{$Todayonline_amount}}</td>
                  <td style="text-align:center">{{$Todayoffline_amount}}</td>
                  <td style="text-align:center"> {{$Todayfeedback_count}}</td>
                  <td style="text-align:center">{{$TodayprofileKaryakarthas}}</td>
                </tr>
                 <tr>
                  <td>Yesterday</td>
                  <td style="text-align:center">{{$Previousmember}}</td>
                  <td style="text-align:center">{{$Previousnotification}}</td>
                  <td style="text-align:center"> {{$Previousonline_amount}}</td>
                  <td style="text-align:center">{{$Previousoffline_amount}}</td>
                  <td style="text-align:center"> {{$Previousfeedback_count}}</td>
                  <td style="text-align:center">{{$PreviousprofileKaryakarthas}}</td>
                </tr>
                <tr>
                  <td>This Week</td>
                  <td style="text-align:center">{{$Thisweekmember}}</td>
                  <td style="text-align:center">{{$Thisweeknotification}}</td>
                  <td style="text-align:center"> {{$Thisweekonline_amount}}</td>
                  <td style="text-align:center">{{$Thisweekoffline_amount}}</td>
                  <td style="text-align:center"> {{$Thisweekfeedback_count}}</td>
                  <td style="text-align:center">{{$ThisweekprofileKaryakarthas}}</td>
                </tr>
                <tr>
                  <td>This Month</td>
                  <td style="text-align:center">{{$ThisMonthmember}}</td>
                  <td style="text-align:center">{{$ThisMonthnotification}}</td>
                  <td style="text-align:center"> {{$ThisMonthonline_amount}}</td>
                  <td style="text-align:center">{{$ThisMonthoffline_amount}}</td>
                  <td style="text-align:center"> {{$ThisMonthfeedback_count}}</td>
                  <td style="text-align:center">{{$ThisMonthprofileKaryakarthas}}</td>
                </tr>
                <tr>
                  <td>Previous Month</td>
                  <td style="text-align:center">{{$PreviousMonthmember}}</td>
                  <td style="text-align:center">{{$Previousmonthnotification}}</td>
                  <td style="text-align:center"> {{$Previousmonthonline_amount}}</td>
                  <td style="text-align:center">{{$Previousmonthoffline_amount}}</td>
                  <td style="text-align:center"> {{$Previousmonthfeedback_count}}</td>
                  <td style="text-align:center">{{$PreviousMonthprofileKaryakarthas}}</td>
                </tr>
                <tr>
                  <td>This Year</td>
                  <td style="text-align:center">{{$ThisYearmember}} </td>
                  <td style="text-align:center">{{$ThisYearnotification}}</td>
                  <td style="text-align:center"> {{$ThisYearonline_amount}}</td>
                  <td style="text-align:center">{{$ThisYearoffline_amount}}</td>
                  <td style="text-align:center"> {{$ThisYearfeedback_count}}</td>
                  <td style="text-align:center">{{$ThisYearprofileKaryakarthas}}</td>
                </tr>
                <tr>
                  <td>All</td>
                  <td style="text-align:center">{{$members_count}}</td>
                  <td style="text-align:center">{{$Notification_count}}</td>
                  <td style="text-align:center">{{$online_amount}}</td>
                  <td style="text-align:center">{{$offline_amount}}</td>
                  <td style="text-align:center">{{$feedback_count}}</td>
                  <td style="text-align:center">{{$profileKaryakarthas}}</td>
                </tr>
             
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
         

          
           
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


