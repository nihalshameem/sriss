@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
     <div class="col-12">

        
        <h3 class="title-head" style="text-align:center">Add Contributions</h3>
        
    </div>
</div>

<div class="card card-primary">
   
    <form role="form" method="post"  id="paymentform" action="{{ route('PostContributions') }}" onsubmit="return AmountRestriction()" enctype="multipart/form-data" >
      @csrf 
      <div class="col-md-12">
          <div class="row">
            <div class="col-md-3"> 
            </div>
            
            <div class="col-md-7">   
              
              <div class="row">
                <div class="col-md-6 form-group">
                  <label for="exampleInputPassword1">Received Amount&nbsp;<span style="color:red">*</span></label>
                  <input type="number" class="form-control" name="amount" placeholder="Amount" value="{{ old('amount') }}"  min="0" required>
                  
              </div>
              <div class="col-md-6 form-group">
                  <label for="exampleInputPassword1">Received Date&nbsp;<span style="color:red">*</span></label>
                  <input type="date" class="form-control" name="date" placeholder="Date" value="{{ old('date') }}" id="received_date" required>
                  
              </div>
          </div>
          
          <div class="row">
            <div class="col-md-6 form-group">
              <label for="exampleInputPassword1">Instrument Type&nbsp;<span style="color:red">*</span></label>
              <select name="type" class="form-control" id="type" onchange="changeType(this.value)" required>
                <option value="">Select Type</option>
                <option value="DD">DD</option>
                <option value="Challan">Chalan</option>
                <option value="Cheque">Cheque</option>
                <option value="Cash">Cash</option>
            </select>
            
        </div>
        <div class="col-md-6 form-group">
          <label for="exampleInputPassword1">Instrument Number&nbsp;<span style="color:red">*</span></label>
          <input type="text" class="form-control" name="Instnumber" placeholder="Number" value="{{ old('Instnumber') }}" id="Instnumber">
          
      </div>
  </div>
  
</div>


</div>
</div>
<br>

<div class="row">

   <div style="max-width: 200px; margin: auto; margin-bottom: 20px;">
        <a href="/AddContributions" class="btn btn-primary">Previous</a>

        <button type="submit" class="btn btn-primary">Submit</button>
    </div><br><br>
</div>


</form>
</div>
</div>
</div>
</section>
</div>
<script>
  function changeType(value)
  {
    if(value=="Cash")
    {
        document.getElementById("Instnumber").disabled = true;
        $('#Instnumber').val('');
    }
    else if(value=="Challan")
    {
        document.getElementById("Instnumber").disabled = true;
        $('#Instnumber').val('');
    }
    else
    {
      document.getElementById("Instnumber").disabled = false;
      document.getElementById("Instnumber").required = true;
      $('#Instnumber').val('');
  }
}
</script>
<script>
  function AmountRestriction()
  {
    var type = document.forms["paymentform"]["type"].value;
    var amount = document.forms["paymentform"]["amount"].value;
    if(type=="Cash" && amount>2000)
    {
      alert("Amount should be <=2000");
      return false;
  }
  else
  {
      return true;
  }
}
</script>
@endsection