@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
       <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="/Contributions" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -12px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
              <h3 class="title-head">Add Contributions</h3>
          </div>
          <div class="col-sm-2">
          </div>
          
      </div>
  </div><br>
  <form role="form" method="post"  action="{{ route('SaveContributions') }}" enctype="multipart/form-data" >
      @csrf 
      <div class="card card-primary">
        <div class="add-button" >
          <div class="row">
            <div class="col-md-2"> 
              
            </div>
            <div class="col-md-2"> 
            </div>
            
            <div class="col-md-3 form-group">
              
              <input type="text" class="form-control" name="Mobile_No" placeholder="Mobile Number" id="mobilenumbersearch" value="{{{ $offline->mobile_number ?? '' }}}" required>
          </div>
          <div class="col-md-3 form-group">
              
           <a  class="btn btn-primary" style="cursor:pointer" onclick="Search()">Search</a>
       </div> 
   </div>
</div>
<br>


<div class="col-md-12">
    <div class="row">
      <div class="col-md-1"> 
      </div>
      
      <div class="col-md-10">   

        <div class="row">     
          <div class="col-md-4 form-group">
            <label for="exampleInputPassword1">First Name&nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control" name="First_Name" placeholder="First Name"  value="{{{ $offline->First_Name ?? '' }}}" id="first_name" required>

            <input type="hidden" class="form-control"  placeholder="First Name"  value="{{{ $offline->First_Name ?? '' }}}" id="first_name_hidden" >
            
        </div>
        <div class="col-md-4 form-group">
            <label for="exampleInputPassword1">Last Name&nbsp;<span style="color:red">*</span></label>
            <input type="text" class="form-control"  name="Last_Name" placeholder="Last Name" value="{{{ $offline->Last_Name ?? '' }}}" id="last_name" required>

            <input type="hidden" class="form-control"   placeholder="Last Name" value="{{{ $offline->Last_Name ?? '' }}}" id="last_name_hidden" >
            
        </div>
        <div class="col-md-4 form-group">
            <label>Member Id</label>
            <input type="text" class="form-control"  placeholder="Member Id" value="{{{ $offline->Member_id ?? '' }}}" id="member_id" disabled="">

            <input type="hidden" class="form-control" name="Member_id" placeholder="Member Id" value="{{{ $offline->Member_id ?? '' }}}" id="member_id_hidden" >
            
        </div>
    </div>
    <div class="row">
      
      <div class="col-md-4 form-group">
        <label for="exampleInputPassword1">Email</label>
        <input type="text" class="form-control" name="email" placeholder="Email" value="{{{ $offline->email ?? '' }}}" id="email" >

        <input type="hidden" class="form-control" placeholder="Email" value="{{{ $offline->email ?? '' }}}" id="email_hidden" >
    </div>
    <div class="col-md-4 form-group">
        <label for="exampleInputPassword1">Whatsapp Number</label>
        <input type="number" class="form-control" name="whatsapp_number" placeholder="Whatsapp Number" id="whatsapp_number" value="{{{ $offline->whatsapp_number ?? '' }}}" >

        <input type="hidden" class="form-control" placeholder="Whatsapp Number" id="whatsapp_number_hidden" value="{{{ $offline->whatsapp_number ?? '' }}}" >
        
    </div>
    <div class="col-md-4 form-group">
        <label for="exampleInputPassword1">Pincode&nbsp;<span style="color:red">*</span></label>
        <input type="number" class="form-control" name="pincode" placeholder="Pincode" value="{{{ $offline->pincode ?? '' }}}" id="pincode" required>

        <input type="hidden" class="form-control"  placeholder="Pincode" value="{{{ $offline->pincode ?? '' }}}" id="pincode_hidden" >
        
    </div>
</div>
<div class="row">     
   <div class="col-md-4  form-group">
      <label for="exampleInputPassword1">Volunteer Name&nbsp;<span style="color:red">*</span></label>
      <input type="text" class="form-control" name="karyakathas_name" placeholder="Karyakathas Name" value="{{{ $offline->karyakathas_name ?? '' }}}" required>
      
  </div>
  <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">Postal Address&nbsp;<span style="color:red">*</span></label>
      <input type="text" class="form-control" name="postal_address" id="postal_address" placeholder="Postal Address" value="{{{ $offline->postal_address ?? '' }}}" required>

      <input type="hidden" class="form-control" placeholder="Postal Address" id="postal_address_hidden" value="{{{ $offline->postal_address ?? '' }}}" required>
      
  </div>
  <div class="col-md-4 form-group">
      <label for="exampleInputPassword1">Pan Number&nbsp;<span style="color:red">*</span></label>
      <input type="text" class="form-control" name="pan_number" placeholder="Pan Number" value="{{{ $offline->pan_number ?? '' }}}" id="pan_number" required>

      <input type="hidden" class="form-control"  placeholder="Pan Number" value="{{{ $offline->pan_number ?? '' }}}" id="pan_number_hidden" required>
      
  </div>
</div>
<div class="row">
    
 
</div>
</div>
<div class="col-md-1"> 
</div>


</div>
</div>

<div class="row">
  
  <div style="max-width: 200px; margin: auto; margin-bottom: 20px;">

    <a href="/Contributions" class="btn btn-primary">Cancel</a>

    <button type="submit" class="btn btn-primary">Next</button>
</div>
</div>
</div>

</form>
</div>
</div>
</div>
</section>
</div>
<script type="text/javascript">
  function Search()
  {
    var value = document.getElementById('mobilenumbersearch').value;
    $.ajax({
      type : 'get',
      url : '{{URL::to('MobileNumbersearch')}}',
      data : {'MobileNumbersearch':value },
      success:function(data){

        if (!$.trim(data))
        { 
           $('#first_name').val('');
           $('#last_name').val('');
           $('#member_id').val('');
           $('#email').val('');
           $('#whatsapp_number').val('');
           $('#pincode').val('');
           $('#pan_number').val('');  
           $('#postal_address').val(''); 

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

           alert("Mobile number is not available");
       }
       else
       {   
        var options = data.forEach( function(item, index){
           $('#first_name').val(item.First_Name);
           $('#last_name').val(item.Last_Name);
           $('#member_id').val(item.Member_Id);
           $('#email').val(item.Email_Id);
           $('#whatsapp_number').val(item.Whatsapp_No);
           $('#pincode').val(item.Pincode);
           $('#pan_number').val(item.Pan_No);
           $('#postal_address').val(item.Address1);

           document.getElementById("first_name").disabled = true; 
           document.getElementById("last_name").disabled = true; 
           document.getElementById("email").disabled = true; 
           document.getElementById("pincode").disabled = true; 
           document.getElementById("whatsapp_number").disabled = true; 
           console.log(item.Pan_No);
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
        $("#postal_address").removeAttr("name");
    }
    else
    {
        document.getElementById("postal_address").disabled = false; 
        $("#postal_address_hidden").attr("name","postal_address");
    }
    

    $("#first_name").removeAttr("name");
    $("#last_name").removeAttr("name");
    $("#member_id").removeAttr("name");
    $("#email").removeAttr("name");
    $("#whatsapp_number").removeAttr("name");
    $("#pincode").removeAttr("name");
    $("#postal_address").removeAttr("name");

    $('#first_name_hidden').val(item.First_Name);
    $('#last_name_hidden').val(item.Last_Name);
    $('#member_id_hidden').val(item.Member_Id);
    $('#email_hidden').val(item.Email_Id);
    $('#whatsapp_number_hidden').val(item.Whatsapp_No);
    $('#pincode_hidden').val(item.Pincode);
    $('#postal_address_hidden').val(item.Address1);

    $("#first_name_hidden").attr("name","First_Name");
    $("#last_name_hidden").attr("name","Last_Name");
    $("#email_hidden").attr("name","email");
    $("#whatsapp_number_hidden").attr("name","whatsapp_number");
    $("#pincode_hidden").attr("name","pincode");
    $("#postal_address_hidden").attr("name","postal_address");
});
    }

    
} 
});
}

</script>
@endsection