
<!DOCTYPE html>
<html style="height: 100%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Dharma Rakshana Samiti') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/login/images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/daterangepicker/daterangepicker.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/timepicker.css') }}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Include the plugin's CSS and JS: -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" type="text/css"/>

    <style>
        .nav-link{ color:white; }
        .btn-primary{ color: #fafafa !important; background-color: #0640b5; !important; border-color: #0640b5 !important; transition: all 0.4s ease 0s; }
        .btn-primary:hover{ color: #0640b5 !important; background: #fafafa !important; border: 1px solid #0640b5 !important; display: inline-block; }
        .btn-primary:focus{ color: #0640b5 !important; background: #fafafa !important; border: 1px solid #0640b5 !important; display: inline-block; }
        .btn-back { color: #fafafa !important; background-color: #0640b5 !important; border-color: #0640b5 !important; transition: all 0.4s ease 0s; }
        .btn-back:hover { color: #0640b5 !important; background-color: #fafafa !important; border-color: #0640b5 !important; transition: all 0.4s ease 0s; }
        .content-wrapper{ background-color: #fafafa; }
        .info-box .info-box-icon{color: #3a3a3a; border-color: #fafafa; }
        .info-box{ background-color: #fafafa; border-color: #3a3a3a; border: 1px solid;}
        .info-box .info-box-text { color: #3a3a3a; }
        .info-box .info-box-number { color: #3a3a3a; }
        .table-borderless{ border: 1px solid #ddd; }
        .table{ background-color:#edf6fe; }
        .card-header{ background-color:#fafafa; border: 1px solid #ddd; }
        .card-title { float: left; font-size: 1.1rem; font-weight: 400; margin: 0; }
        .badge{ font-size:15px; }
        table { border-collapse: collapse; border-spacing: 0; width: 100%; border: 1px solid #ddd; padding-top:30px; }
        th{ text-align: left; border: 1px solid #ddd; color:#3a3a3a; font-size:16px; font-family: sans-serif; }
        td{ text-align: left; border: 1px solid #ddd; font-family: sans-serif; }
        tr:nth-child(even) { background-color: #fafafa; }
        .bg-danger1 { background-color: #8f3319; color:white; }
        .content-wrapper{ padding-top:50px; }
        .nav-link{ color:black; font-size:14px; }
        h3{ font-size:20px; }
        .info-box-text{ font-size:14px; }
        th{ font-size:14px; }
        td{ font-size:14px; }
        .badge{ font-size:14px; }
        .link1 { color: white; height: 100px; background-color: #874479; padding: 40px; text-decoration: none; }
        .title-head{ font-weight: bold; color: #3a3a3a; font-size: 17px; }
        .example::-webkit-scrollbar { display: none; }
        /* Hide scrollbar for IE, Edge and Firefox */
        .example {-ms-overflow-style: none;/* IE and Edge */scrollbar-width: none;/* Firefox */display: none; }
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; -moz-appearance: none; appearance: none; margin: 0; }
        label{ background-color: #3f3f3f; }
        .card{ background-color: #fafafa; }
        .nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{ background-color: #ffffff; border-color: #3a3a3a #3a3a3a #d1dde7; }
        label:not(.form-check-label):not(.custom-file-label){ background-color: #fafafa; }
        .bootstrap-select .dropdown-toggle .filter-option{ background-color: #c6d4e5; color: #212543; }
        .card-primary:not(.card-outline) > .card-header {background-color: #edf6fe; }
        .collapsible1 {
  background-color: #0640B5;
  color: white;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
}

.active1, .collapsible1:hover {
  background-color: #0640B5;
}
.collapsible1:after {
  content: '\002B';
  color: white;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.active1:after {
  content: "\2212";
}
.content1 {
  padding: 0 18px;
  display: none;
  overflow: hidden;
  background-color: #f1f1f1;
}

</style>

</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color:#fafafa; ">
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebar')
        @yield('content')
        @include('layouts.footer')

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script> $.widget.bridge('uibutton', $.ui.button); </script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sparklines/sparkline.js') }}"></script>
    <!-- <script src="{{ asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script> -->
    <!-- <script src="{{ asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/time-picker-bootstrap/timepicker.css')}}">
    <script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('assets/dist/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('assets/dist/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <script src="{{ asset('assets/dist/js/demo.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
 $(document).ready(function(){
   
  $('#group_name1').multiselect({
    buttonWidth: '300px'
  });
  $('#group_name2').multiselect({
    buttonWidth: '300px'
  });
    });
  
  
</script>
<script>
var coll = document.getElementsByClassName("collapsible1");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active1");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>
    


    <script>
        $(document).ready(function () {
            bsCustomFileInput.init();
        });
    </script>
    <script>
        $(function(){
            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            
            var maxDate = year + '-' + month + '-' + day;
            $('#to_date').attr('min', maxDate);
            
        });
    </script>
    <script>
        $(function(){
            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();

            
            var maxDate = year + '-' + month + '-' + day;
            $('#from_date').attr('min', maxDate);
            
        });
    </script>


    <script>
        $(function(){
            var dtToday = new Date();
            
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            
            var maxDate = year + '-' + month + '-' + day;
            $('#txtDate').attr('min', maxDate);
            
        });
    </script>
    
    <script>
        $(function(){
            var dtToday2 = new Date();
            var month2 = dtToday2.getMonth() + 1;
            var day2 = dtToday2.getDate();
            var year2 = dtToday2.getFullYear();
            if(month2 < 10)
                month2 = '0' + month2.toString();
            if(day2 < 10)
                day2 = '0' + day2.toString();
            var maxDate2 = year2 + '-' + month2 + '-' + day2;

            $('#received_date').attr('max', maxDate2);
            console.log($('#received_date').attr('max', maxDate2));
            
        });
    </script>
    <script type="text/javascript">
      $(function(){
         var value = document.getElementById('mobilenumbersearch').value;
         $.ajax({
          type : 'get',
          url : '{{URL::to('MobileNumbersearch')}}',
          data : {'MobileNumbersearch':value },
          success:function(data){

            if (!$.trim(data)){ 
               
               document.getElementById("first_name").disabled = false; 
               document.getElementById("last_name").disabled = false; 
               document.getElementById("email").disabled = false; 
               document.getElementById("pincode").disabled = false; 
               document.getElementById("whatsapp_number").disabled = false; 
               document.getElementById("pan_number").disabled = false; 
               document.getElementById("postal_address").disabled = false; 

               $("#first_name").attr("name","First_Name");
               $("#last_name").attr("name","Last_Name");
               $("#email").attr("name","email");
               $("#whatsapp_number").attr("name","whatsapp_number");
               $("#pincode").attr("name","pincode");
               $("#pan_number").attr("name","pan_number");
               $("#postal_address").attr("name","postal_address");

               $("#first_name_hidden").removeAttr("name");
               $("#last_name_hidden").removeAttr("name");
               $("#member_id").removeAttr("name");
               $("#email_hidden").removeAttr("name");
               $("#whatsapp_number_hidden").removeAttr("name");
               $("#pincode_hidden").removeAttr("name");
               $("#pan_number_hidden").removeAttr("name");
               $("#postal_address_hidden").removeAttr("name");

           }
           else
           {   
            var options = data.forEach( function(item, index){
               $('#first_name').val(item.First_Name);
               $('#last_name').val(item.Last_Name);
               $('#member_id').val(item.Member_Id);
               $('#email').val(item.Email_Id);
               $('#pincode').val(item.Pincode);
               $('#postal_address').val(item.Address1);

               document.getElementById("first_name").disabled = true; 
               document.getElementById("last_name").disabled = true; 
               document.getElementById("email").disabled = true; 
               document.getElementById("pincode").disabled = true; 
               document.getElementById("whatsapp_number").disabled = true; 
               if(item.Pan_No!=null)
               {
                document.getElementById("pan_number").disabled = true; 
                $("#pan_number").removeAttr("name");
                $("#pan_number_hidden").attr("name","pan_number");
            }
            else
            {

             document.getElementById("pan_number").disabled = false; 
             $("#pan_number_hidden").removeAttr("name");
             $("#pan_number").attr("name","pan_number");
         }
         if(item.Address1!=null)
         {
          document.getElementById("postal_address").disabled = true; 
      }
      else
      {
          document.getElementById("postal_address").disabled = false; 
      }

      $("#first_name").removeAttr("name");
      $("#last_name").removeAttr("name");
      $("#member_id").removeAttr("name");
      $("#email").removeAttr("name");
      $("#whatsapp_number").removeAttr("name");
      $("#pincode").removeAttr("name");
      $("#pan_number").removeAttr("name");
      $("#postal_address").removeAttr("name");

      $('#first_name_hidden').val(item.First_Name);
      $('#last_name_hidden').val(item.Last_Name);
      $('#member_id_hidden').val(item.Member_Id);
      $('#email_hidden').val(item.Email_Id);
      $('#whatsapp_number_hidden').val(item.Whatsapp_No);
      $('#pincode_hidden').val(item.Pincode);
      $('#pan_number_hidden').val(item.Pan_No);
      $('#postal_address_hidden').val(item.Address1);

      $("#first_name_hidden").attr("name","First_Name");
      $("#last_name_hidden").attr("name","Last_Name");
      $("#email_hidden").attr("name","email");
      $("#whatsapp_number_hidden").attr("name","whatsapp_number");
      $("#pincode_hidden").attr("name","pincode");
      $("#pan_number_hidden").attr("name","pan_number");
      $("#postal_address_hidden").attr("name","postal_address");
  });
        }

        
    } 
});
});
</script>

<script>
    $(function(){
      var dtToday = new Date();
      
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
        day = '0' + day.toString();
    var maxDate = year + '-' + month + '-' + day;
    $('#realised_date').attr('max', maxDate);
    $('#start_date').attr('max', maxDate);
    $('#end_date').attr('max', maxDate);
});
</script>

<script>
    $('.membersearch').on('change',function(){
      var value=$(this).val();
      var volunteer='';
      var volunteer = document.getElementsByName("approve");
      for(i = 0; i < volunteer.length; i++) { 
                if(volunteer[i].checked)
                volunteer = volunteer[i].value; 
               
            } 
      $.ajax({
        type : 'get',
        url : '{{URL::to('MemberSearch')}}',
        data : {'membersearch':value,'VolunteerSearch':volunteer},
        success:function(data){
          $('#membersearch').empty();
          $('#membersearch').html(data);
      } 
  });
  })
</script>
<script>
    $('#checkboxPrimary1').on('click',function(){
      var volunteer=$(this).val();
      console.log(volunteer);
      var value='';
      var value = document.getElementsByName("membersearch");
      for(i = 0; i < value.length; i++) { 
                value = value[i].value; 
            } 
      $.ajax({
        type : 'get',
        url : '{{URL::to('MemberSearch')}}',
        data : {'membersearch':value,'VolunteerSearch':volunteer},
        success:function(data){
          $('#membersearch').empty();
          $('#membersearch').html(data);
      } 
  });
  })
</script>
<script>
    $('#checkboxPrimary2').on('click',function(){
      var volunteer=$(this).val();
      var value='';
      var value = document.getElementsByName("membersearch");
      for(i = 0; i < value.length; i++) { 
                value = value[i].value; 
            } 
      $.ajax({
        type : 'get',
        url : '{{URL::to('MemberSearch')}}',
        data : {'membersearch':value,'VolunteerSearch':volunteer},
        success:function(data){
          $('#membersearch').empty();
          $('#membersearch').html(data);
      } 
  });
  })
</script>
<script>
    $('.volunteersearch').on('change',function(){
      var value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('VolunteerSearch')}}',
        data : {'membersearch':value},
        success:function(data){
          $('#volunteersearch').empty();
       $('#volunteersearch').html(data['Member']);
      } 
  });
  })
</script>

<script>
    $('.usersearch').on('change',function(){
      var value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('User/Search')}}',
        data : {'UserSearch':value},
        success:function(data){
         if(data){

            $("#membername").empty();
            $("#memberid").empty();
            $.each(data,function(key,value){
              console.log(value);
                $("#memname").show();
                $("#membername").append('<input type="text" class="form-control" name="membername" value="'+value.name+'" readonly>');
                $("#memberid").append('<input type="text" class="form-control" name="member" value="'+value.id+'" readonly>');
            });

        }else{
            $("#memname").hide();
            $("#membername").empty();
        }
    } 
});
  })
</script>
<script>
    $('.memberdeactivate').on('change',function(){
      var value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('MemberDeactivate')}}',
        data : {'memberdeactivate':value},
        success:function(data){
          $('#memberdeactivate').html(data);
      } 
  });
  })
</script>
<script>
    function AppTitle(value)
    {  
        if(value=="5")
        {
            $("#AppImageFile").hide();
            document.getElementById("AppImageFile").required = false;
            $("#AppTitle").show();
            document.getElementById("AppTitle").required = true;
        }
        else
        {
            $("#AppImageFile").show();
            document.getElementById("AppImageFile").required = true;
            $("#AppTitle").hide();
            document.getElementById("AppTitle").required = false;
        }
    }
</script>


<script type="text/javascript">
    $(".searchby").on('change', function(){
        var searchby = $(this).val();
        if(searchby == "member_id"){
            $(".memberdiv").show();
            $(".mobilediv").hide();
        }else{
            $(".memberdiv").hide();
            $(".mobilediv").show();
        }
    });
</script>

<script type="text/javascript">
    $('#search').on('change',function(){
      $value=$(this).val();
      $('#search1').on('change',function(){
          $value1=$(this).val();
          $.ajax({
            type : 'get',
            url : '{{URL::to('Notificationsearch')}}',
            data : {'search':$value , 'search1':$value1},
            success:function(data){
              $('tbody').html(data);
          } 
      });
      })
  })
</script>
<script type="text/javascript">
    $('#pollsearch').on('change',function(){
      $value=$(this).val();
      $('#pollsearch1').on('change',function(){
          $value1=$(this).val();
          $.ajax({
            type : 'get',
            url : '{{URL::to('Pollsearch')}}',
            data : {'pollsearch':$value , 'pollsearch1':$value1},
            success:function(data){
              $('tbody').html(data);
          } 
      });
      })
  })
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.nav-tabs a[href="#state-tabs-tab"]').tab('show');
});
</script>

<script>

 function LoadStateDivision(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadStateDivision')}}',
    data : {'state_id':result},
    success:function(response){
     $('#StateDivision').empty();
     $('#StateDivision').append('<option value="">Select State Division</option>');
     var options = response.forEach( function(istate, index){
      $('#StateDivision').append('<option value="'+istate.State_Division_id+'">'+istate.State_Division_desc+'</option>');
      
  });
     
 } 
});


}
</script>

<script>

 function LoadGreaterZones(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadGreaterZones')}}',
    data : {'statedivision_id':result},
    success:function(response){
     $('#GreaterZones').empty();
     $('#GreaterZones').append('<option value="">Select Greater Zone</option>');
     var options = response.forEach( function(istate, index){
        $('#GreaterZones').append('<option value="'+istate.Greater_Zones_id+'">'+istate.Greater_Zones_desc+'</option>');
    });
     
 } 
});


}
</script>
<script>

 function LoadZones(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadZones')}}',
    data : {'State_id':result},
    success:function(response){
     $('#zone').empty();
     $('#zone').append('<option value="">Select Zone</option>');
     var options = response.forEach( function(istate, index){
        $('#zone').append('<option value="'+istate.Zone_id+'">'+istate.Zone_desc+'</option>');
    });
     
 } 
});


}
</script>

<script>

 function LoadDistrict(select){
  var result = [];
  var options = select && select.options;
  var opt;

  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadDistrict')}}',
    data : {'zone_id':result},
    success:function(response){
     $('#district').empty();
     $('#district').append('<option value="">Select District</option>');
     var options = response.forEach( function(istate, index){
        $('#district').append('<option value="'+istate.District_id+'">'+istate.District_desc+'</option>');
    });
     
 } 
});


}
</script>

<script>

 function LoadUnion(select){
  var result = [];
  var options = select && select.options;
  var opt;
  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadUnion')}}',
    data : {'district_id':result},
    success:function(response){
     $('#union').empty();
     $('#union').append('<option value="">Select Union</option>');
     var options = response.forEach( function(istate, index){
        $('#union').append('<option value="'+istate.Union_id+'">'+istate.Union_desc+'</option>')
    });
     
 } 
});


}
</script>
<script>

 function LoadPanchayat(select){
  var result = [];
  var options = select && select.options;
  var opt;
  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadPanchayat')}}',
    data : {'union_id':result},
    success:function(response){
     $('#Panchayat').empty();
     $('#Panchayat').append('<option value="">Select Panchayat</option>');
     var options = response.forEach( function(istate, index){
        $('#Panchayat').append('<option value="'+istate.Panchayat_id+'">'+istate.Panchayat_desc+'</option>')
    });
     
 } 
});


}
</script>

<script>

 function LoadVillage(select){
  var result = [];
  var options = select && select.options;
  var opt;
  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadVillage')}}',
    data : {'panchayat_id':result},
    success:function(response){
     $('#Village').empty();
     $('#Village').append('<option value="">Select Village</option>');
     var options = response.forEach( function(istate, index){
        $('#Village').append('<option value="'+istate.Village_id+'">'+istate.Village_desc+'</option>')
    });
     
 } 
});


}
</script>
<script>

 function LoadStreet(select){
  var result = [];
  var options = select && select.options;
  var opt;
  for (var i=0, iLen=options.length; i<iLen; i++) {
    opt = options[i];

    if (opt.selected) {
      result.push(opt.value || opt.text);
  }
}
$.ajax({
    type : 'get',
    url : '{{URL::to('LoadStreet')}}',
    data : {'village_id':result},
    success:function(response){
     $('#Street').empty();
     $('#Street').append('<option value="">Select Street</option>');
     var options = response.forEach( function(istate, index){
        $('#Street').append('<option value="'+istate.Street_id+'">'+istate.Street_desc+'</option>')
    });
     
 } 
});


}
</script>

<script type="text/javascript">
    function exportTableToExcel(tableID, filename = ''){
        var downloadLink;
        var dataType = 'application/vnd.ms-excel';
        var tableSelect = document.getElementById(tableID);
        var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
        
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>

</body>
</html>
