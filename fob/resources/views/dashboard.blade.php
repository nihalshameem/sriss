@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
           
    <div class="col-md-7 col-md-offset-4" style="margin-top: 20px">
                <a class="col-md-8 " href="referral_reports" style="text-decoration: none;font-size: 20px;font-weight: bold;background-color: #0e56ce;color:white;padding:20px;border-radius:10px">
                    <span style="margin-right: 50px;padding-left:50px">Total Referrals</span>{{ $total_referrals }}</a>
            
    </div>
 <div class="panel panel-default">
    <div class="panel-heading" style="background-color:#F3F8FA;color:white">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                  
                    <div class="row">                         
                       <center>

                        <table width="100%" style="border-collapse: separate;
  margin-top: -60px"> 
                        
                       
                         <tr style="text-align: center;">
                            <td></td>
                            <td id="css1">Members</td>
                            <td id="css2">Notifications</td>
                            <td id="css3">Advertisements</td>
                            <td id="css4">Polls</td>
                        </tr>
                          <tr style="text-align: center;height: 60px">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 

                        </tr>
                        
                        
                        <tr  style="font-size:20px;text-align: center;">
                            <td style="padding:20px">Today</td>
                            <td style="padding:20px"><a href="/fob/today_members" style="padding-top: 38px;border-radius:50%" id="link1">{{ $today_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/today_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $today_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/today_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $today_ads }}</a>
                            </td> 
                            <td style="padding:20px"><a href="/fob/today_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $today_polls }}</a></td> 

                        </tr>

                        <tr style="text-align: center;height: 60px">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 

                        </tr>


                        <tr  style="font-size:20px;text-align: center;">
                            <td style="font-size:20px;text-align: center;padding:20px">Yesterday</td>
                            <td style="padding:20px"><a href="/fob/yesterday_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $yesterday_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/yesterday_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $yesterday_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/yesterday_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $yesterday_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/yesterday_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $yesterday_polls }}</a></td> 

                        </tr> 
                        <!--<tr style="text-align: center;height: 60px"">-->
                        <!--    <td></td>-->
                        <!--    <td style="font-size:20px;font-weight: bold"></td>-->
                        <!--    <td style="font-size:20px;font-weight: bold"></td>-->
                        <!--    <td style="font-size:20px;font-weight: bold"></td>-->
                        <!--    <td style="font-size:20px;font-weight: bold"></td>-->
                        <!--</tr>-->

                        <!--<tr  style="font-size:20px;text-align: center;">-->
                        <!--    <td></td>-->
                        <!--    <td style=""></td> -->
                        <!--    <td style=""></td>                    -->
                        <!--    <td style=""></td> -->
                        <!--    <td style=""></td> -->

                        <!--</tr>-->


                        <!--<tr  style="font-size:20px;text-align: center;">-->
                        <!--    <td style="font-size:20px;text-align: center;">Past week</td>-->
                        <!--    <td style="padding:20px"><a href="/fob/thisweek_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $thisweek_members }}</a></td> -->
                        <!--    <td style="padding:20px"><a href="/fob/thisweek_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $thisweek_notifications }}</a></td>                    -->
                        <!--    <td style="padding:20px"><a href="/fob/thisweek_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $thisweek_ads }}</a></td> -->
                        <!--    <td style="padding:20px"><a href="/fob/thisweek_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $thisweek_polls }}</a></td> -->

                        <!--</tr> -->
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <tr style="text-align: center;height: 60px"">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 
                        </tr>
        
                      
                        <tr  style="font-size:20px;text-align: center;">
                            <td style="font-size:20px;text-align: center;">This Month</td>
                            <td style="padding:20px"><a href="/fob/thismonth_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $thismonth_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/thismonth_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $thismonth_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/thismonth_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $thismonth_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/thismonth_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $thismonth_polls }}</a></td> 

                        </tr> <br><br>
                        
                        
                        <tr style="text-align: center;height: 60px"">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 
                        </tr>
        
                      
                        <tr  style="font-size:20px;text-align: center;">
                            <td style="font-size:20px;text-align: center;">Past month</td>
                            <td style="padding:20px"><a href="/fob/lastmonth_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $lastmonth_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/lastmonth_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $lastmonth_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/lastmonth_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $lastmonth_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/lastmonth_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $lastmonth_polls }}</a></td> 

                        </tr> <br><br>
                        
                        
                        
                        
                        
                        
                        <tr style="text-align: center;height: 60px">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 

                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td>This year</td>
                            <td style="padding:20px"><a href="/fob/thisyear_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $thisyear_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/thisyear_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $thisyear_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/thisyear_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $thisyear_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/thisyear_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $thisyear_polls }}</a></td> 

                        </tr> <br><br>
                        
                        
                        
                        <tr style="text-align: center;height: 60px">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 

                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td>Past year</td>
                            <td style="padding:20px"><a href="/fob/lastyear_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $lastyear_members }}</a></td> 
                            <td style="padding:20px"><a href="/fob/lastyear_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $lastyear_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/lastyear_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $lastyear_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/lastyear_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $lastyear_polls }}</a></td> 

                        </tr> <br><br>
                        
                        
                        
                        
                        
                         <tr style="text-align: center;height: 60px"">
                            <td></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                            <td style="font-size:20px;font-weight: bold"></td>
                        </tr>

                        <tr  style="font-size:20px;text-align: center;">
                            <td></td>
                            <td style=""></td> 
                            <td style=""></td>                    
                            <td style=""></td> 
                            <td style=""></td> 

                        </tr>

                        
                        <tr  style="font-size:20px;text-align: center;">
                            <td>Total</td>
                            <td style="padding:20px"><a href="/fob/total_members" style="padding-top: 38px;border-radius:50%"  id="link1">{{ $total_members }}</a></td></td> 
                            <td style="padding:20px"><a href="/fob/total_notifications" style="padding-top: 38px;border-radius:50%"  id="link2">{{ $total_notifications }}</a></td>                    
                            <td style="padding:20px"><a href="/fob/total_ads" style="padding-top: 38px;border-radius:50%"  id="link3">{{ $total_ads }}</a></td> 
                            <td style="padding:20px"><a href="/fob/total_polls" style="padding-top: 38px;border-radius:50%"  id="link4">{{ $total_polls }}</a></td> 

                        </tr> 

                    </table>
                    <br><br><br>

                        </center>                
                    </div>
                </div>             
            </div>         
        </div>     
    </div> 
</div> 


<style>
    #css1
{
    font-size:16px;
    font-weight: bold;
    background-color:#591a4c;
    color:white;
    padding:5px;
}

#css2{
font-size:16px;
font-weight: bold;
background-color:#071f44;
color:white;padding:5px;
}

#css3{
font-size:16px;
font-weight: bold;
background-color:#0c2b03;
color:white;padding:5px;
}

#css4{
font-size:16px;
font-weight: bold;
background-color: #66290f;
color:white;padding:7px;
}

#row1{
font-size:20px;
font-weight: bold;
background-color: #874479;
color:white;width:80px;
height:60px;
width:160px;
padding:10px;
}

#row2{
font-size:20px;
font-weight: bold;
background-color: #246ad6;
color:white;width:100px;
height:100px;
padding:10px;
}

#row3{
font-size:20px;
font-weight: bold;
background-color: #598c4a;
color:white;width:120px;
height:100px;
padding:10px;
}

#row4{
font-size:20px;
font-weight: bold;
background-color: #937569;
color:white;
width:120px;
height:100px;
padding:10px;
}


#link1{
color:white;
width:100px;
height:100px;
background-color:#874479;
padding:40px;
text-decoration:none;
}

#link2{
color:white;
width:100px;
height:100px;
background-color:#246ad6;
padding:40px;
text-decoration:none;
}

#link3{
color:white;
width:100px;
height:100px;
background-color:#598c4a;
padding:40px;
text-decoration:none;
}

#link4{
color:white;
width:100px;
height:100px;
background-color:#937569;
padding:40px;
text-decoration:none;
}
</style>
@endsection
