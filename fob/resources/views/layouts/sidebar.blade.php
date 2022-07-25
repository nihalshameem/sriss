<style>
  .navbar-default .navbar-nav>li>a {
    color: #fff;
}
.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 14px;
  font-weight: 200;
  background-color: #ff9f30;
  position: fixed;
  top: 7.8%;
  left: 0%;
  width: 15%;
  height: 100%;
  color: white;
}
.nav-side-menu .brand {
  background-color: #23282e;
  line-height: 50px;
  display: block;
  text-align: center;
  font-size: 14px;
}
.nav-side-menu .toggle-btn {
  display: none;
}
.nav-side-menu ul,
.nav-side-menu li {
  list-style: none;
  padding: 0px;
  margin: 0px;
  line-height: 35px;
  cursor: pointer;
  /*    
    .collapsed{
       .arrow:before{
                 font-family: FontAwesome;
                 content: "\f053";
                 display: inline-block;
                 padding-left:10px;
                 padding-right: 10px;
                 vertical-align: middle;
                 float:right;
            }
     }
*/
}
.menu-list
{
  margin-top: 1%;
}
.nav-side-menu ul :not(collapsed) .arrow:before,
.nav-side-menu li :not(collapsed) .arrow:before {
  font-family: FontAwesome;
  content: "\f078";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
  float: right;
}

.nav-side-menu ul .sub-menu li:before,
.nav-side-menu li .sub-menu li:before {
  font-family: FontAwesome;
  content: "\f105";
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
  vertical-align: middle;
}
.nav-side-menu li {
  padding: 5px;
  margin-left:15px;
    /*border-left: 3px solid #2e353d;
    border: 1px solid #23282e;*/
}

.nav-side-menu li a {
  text-decoration: none;
  color: white;

}
.nav-side-menu li a i {
  padding-left: 10px;
  width: 20px;
  padding-right: 20px;
}

@media (max-width: 767px) {
  .navbar-default 
  {
    width: 100%;
  }
  .nav-side-menu {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
    height:  20%;
    left: 0%;
  }
  .nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
  }
  .brand {
    text-align: left !important;
    font-size: 22px;
    padding-left: 20px;
    line-height: 50px !important;
    color: #fff;
  }

}
@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
  }
}
body {
  margin: 0px;
  padding: 0px;
}
.navbar{ margin-bottom: 0; }
.navbar-default {
    background-color: #ff9f30;
    border-color: #ff9f30;
    position: fixed;
  top: 0;
  width: 100%;
    
}
.navbar-default .navbar-brand {
color: #7A7A86;
}
.panel-primary { opacity: 0.9; }
.red,.orange,.green,.blue .fa
{
  font-size: 30px;
}
.red .fa
{ color: #FA2A02; }
.orange .fa
{ color: #FFB402; }
.green .fa
{ color: #19BC9C; }
.blue .fa
{ color: #21A7F0; }

.panel-primary {
    border-color: #19BC9C;
}
.panel-primary>.panel-heading {
    color: #fff;
    background-color: #19BC9C;
    border-color: #19BC9C;
}
.panel-primary .panel-body th
{ color: red; }
.fa-pencil-square-o
{ color: #0662FE; }
.fa-trash-o
{ color: red; }
.red .panel-primary,.red .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FA2A02;
}
.orange .panel-primary,.orange .panel-primary .panel-heading
{
background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #FFB402;
}
.green .panel-primary,.green .panel-primary .panel-heading
{
  background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #19BC9C;
}
.blue .panel-primary,.blue .panel-primary .panel-heading
{
 background-color: #fff;
  color: #000;
  text-align: center;
  border-color: #21A7F0;
}
.row
{ margin-right: 0; }
.fa-edit
{
  color:blue;
  font-size: 20px;
}
.fa-check-square-o
{
  color:green;
  font-size: 20px;
}




 /*sidebar navbar*/

.dropbtn {
    background-color:  #ff9f30;
    color: white;
    padding: 16px;
    font-size: 14px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color:  #ff9f30;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color:  #0091bf;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: white;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: white;}

.show {display: block;}


</style>
<div class="col-md-2">
    <div class="nav-side-menu">
      <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

      <div class="menu-list">
          
          
        @if(Auth::user())
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("REPORT", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#home" class="collapsed"  style="margin-top:30px">
              <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard fa-lg"></i> Reports </a></li>
              @endif
            
              @if(Auth::user()->user_type == "ADMIN" || (in_array("LOCATION", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#locations" class="collapsed">
              <a href="{{ url('zone_details') }}"><i class="fa fa-area-chart fa-lg"></i> Locations </a></li>
              @endif
             
              @if(Auth::user()->user_type == "ADMIN" || (in_array("NOTIFICATION", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#notifications" class="collapsed">
              <a href="{{ url('notification_details') }}"><i class="fa fa-bell fa-lg"></i> Notifications </a></li>
              @endif
                
               @if(Auth::user()->user_type == "ADMIN" || (in_array("ADVERTISEMENT", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#advertisement" class="collapsed">
              <a href="{{ url('advertisement_details') }}"><i class="fa fa-bullhorn fa-lg"></i> Advertisement </a></li>
              @endif
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("POLL", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#poll" class="collapsed">
              <a href="{{ url('poll_details') }}"><i class="fa fa-hand-o-up fa-lg"></i> Polls </a></li>
              @endif
              
                
              @if(Auth::user()->user_type == "ADMIN" || (in_array("ROLE", explode(",",(Auth::user()->user_type)))))          
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('user_roles_assign') }}"><i class="fa fa-check fa-lg"></i> Role Assign </a></li>
              @endif

              @if(Auth::user()->user_type == "ADMIN" || (in_array("MEMSEARCH", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('member_details') }}"><i class="fa fa-search fa-lg"></i> Member Search </a></li>
              @endif
              
              <!--@if(Auth::user()->user_type == "ADMIN" )-->
              <!--<li data-toggle="collapse" data-target="#aos" class="collapsed">-->
              <!--<a href="{{ url('fob_reports') }}"><i class="fa fa-search fa-lg"></i>Reports </a></li>-->
              <!--@endif-->
              
              <!--@if(Auth::user()->user_type == "ADMIN" || (in_array("VISION", explode(",",(Auth::user()->user_type)))))-->
              <!--<li data-toggle="collapse" data-target="#aos" class="collapsed">-->
              <!--<a href="{{ url('vision_details') }}"><i class="fa fa-eye fa-lg"></i> Vision </a></li>-->
              <!--@endif-->
              
              <!--@if(Auth::user()->user_type == "ADMIN" || (in_array("TAC", explode(",",(Auth::user()->user_type)))))-->
              <!--<li data-toggle="collapse" data-target="#aos" class="collapsed">-->
              <!--<a href="{{ url('terms_condition_details') }}"><i class="fa fa-info-circle fa-lg"></i> T&C </a></li>-->
              <!--@endif-->
              
              <!--@if(Auth::user()->user_type == "ADMIN" || (in_array("PRIVACYPOLICY", explode(",",(Auth::user()->user_type)))))-->
              <!--<li data-toggle="collapse" data-target="#aos" class="collapsed">-->
              <!--<a href="{{ url('privacy_policy_details') }}"><i class="fa fa-lock fa-lg"></i> Privacy Policy </a></li>-->
              <!--@endif-->
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("IDCARDVISION", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('idcard_vision_details') }}"><i class="fa fa-credit-card fa-lg"></i> ID Card Vision </a></li>
              @endif
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("MEMBERDEACT", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('member_edit') }}"><i class="fa fa-user fa-lg"></i> Member DeAct </a></li>
              @endif
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("FEEDBACK", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('feedback_details') }}"><i class="fa fa-comments fa-lg"></i> Feedback </a></li>
              @endif
              
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("MEMIDFORMAT", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('memberIdFormat') }}"><i class="fa fa-user-plus fa-lg"></i> Member Id </a></li>
              @endif
              
              
              
              
              @if(Auth::user()->user_type == "ADMIN")
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('visions') }}"><i class="fa fa  fa-lg"></i> 3 Dot Menu </a></li>
              @endif
              
              
              @if(Auth::user()->user_type == "ADMIN")
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('languages') }}"><i class="fa fa  fa-lg"></i> Language </a></li>
              @endif
              
              
            @if(Auth::user()->user_type == "ADMIN")
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('cfgVisions') }}"><i class="fa fa  fa-lg"></i> 3 Dot List </a></li>
            @endif
              
              
             

 
              
              @if(Auth::user()->user_type == "ADMIN" || (in_array("FEEDBACK", explode(",",(Auth::user()->user_type)))))
              <li data-toggle="collapse" data-target="#aos" class="collapsed">
              <a href="{{ url('feedback_details') }}"><i class="fa fa-comments fa-lg"></i> Feedback </a></li>
              @endif
              
        @endif


        </ul>
      </div>
    </div>
  </div>


  <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>