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
                <h3 class="title-head">Edit Contributions</h3>
            </div>
            <div class="col-sm-2">
            </div>
            
        </div>
    </div>
    <div class="col-12">

        
      <div class="card card-primary">
       
        <form role="form" name="myForm" method="post"  action="{{ route('UpdateContributions') }}" enctype="multipart/form-data" onsubmit="return validateForm()">
          @csrf 
          <div class="col-md-12">
              <div class="row">
                <div class="col-md-1"> 
                </div>
                
                
                <div class="col-md-5">
                    <input type="hidden" class="form-control" name="ContributionId" value="{{ $OfflineContribution->Offline_Contribution_id }}">
                    
                    <div class="form-group">
                      <input type="hidden" class="form-control" name="amount" placeholder="Amount" value="{{ $OfflineContribution->Offline_Contribution_amount }}">
                      <label for="exampleInputPassword1">Received Amount&nbsp;<span style="color:red">*</span></label>
                      <input type="number" class="form-control"  placeholder="Amount" value="{{ $OfflineContribution->Offline_Contribution_amount }}"  disabled="">
                      
                  </div>
                  @if($OfflineContribution->drs_Inst_Type=='Cash')
                  <div class="form-group">
                      <label for="exampleInputPassword1">Realised Amount&nbsp;<span style="color:red">*</span></label>
                      <input type="number" min="0" class="form-control" name="realised_amount" placeholder="Realised Amount" value="{{$OfflineContribution->realised_amount }}" required="">
                      
                  </div>

                  
                  @else
                  <div class="form-group">
                      <label for="exampleInputPassword1">Realised Amount&nbsp;<span style="color:red">*</span></label>
                      <input type="number" class="form-control" value="{{$OfflineContribution->realised_amount }}"disabled="">
                      <input type="hidden" min="0" class="form-control" name="realised_amount" placeholder="Realised Amount" value="{{$OfflineContribution->realised_amount }}" >
                      
                  </div>
                  

                  @endif

                  
                  <div class="form-group">
                      <label for="exampleInputPassword1">Instrument Type&nbsp;<span style="color:red">*</span></label>
                      <select name="type" class="form-control" disabled="">
                        <option value="">Select Type</option>
                        <option value="DD" @if($OfflineContribution->drs_Inst_Type == "DD") selected @endif>DD</option>
                        <option value="Challan" @if($OfflineContribution->drs_Inst_Type == "Challan") selected @endif>Chalan</option>
                        <option value="Cheque"  @if($OfflineContribution->drs_Inst_Type == "Cheque") selected @endif>Cheque</option>
                        <option value="Cash" @if($OfflineContribution->drs_Inst_Type == "Cash") selected @endif>Cash</option>
                    </select>
                    
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Due Amount&nbsp;<span style="color:red">*</span></label>
                  <input type="number" class="form-control" placeholder="Due Amount" value="{{$OfflineContribution->Due_amount }}" disabled>
                  <input type="hidden" class="form-control" name="due_amount" placeholder="Due Amount" value="{{$OfflineContribution->Due_amount }}" >
              </div>
              
          </div>
          <div class="col-md-5">

            <div class="form-group">
              <label for="exampleInputPassword1">Received Date&nbsp;<span style="color:red">*</span></label>
              <input type="date" class="form-control" name="date" placeholder="Date" value="{{ $OfflineContribution->Offline_Contribution_date }}" id="received_date" disabled="">
              
          </div>
          
          
          <div class="form-group">
              <label for="exampleInputPassword1">Realised Date&nbsp;<span style="color:red">*</span></label>
              <input type="date" class="form-control" name="realised_date" placeholder="Date" value="{{ $OfflineContribution->realised_date }}" onchange="RealisedDateValidation(this.value)" id="realised_date" required="">
              
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Instrument Number&nbsp;<span style="color:red">*</span></label>
              <input type="text" class="form-control" name="Instnumber" placeholder="Number" value="{{$OfflineContribution->drs_Inst_No }}" disabled="">
              
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Status</label>
              <input type="text" class="form-control"  value="{{$OfflineContribution->Offline_Contribution_payment_status }}" disabled=" ">
              
              
          </div>
          
      </div>
      <div class="col-md-1">
      </div>
  </div>
</div>

<div class="row">
  <div style="max-width: 200px; margin: auto; margin-bottom: 20px;">
        <a href="/Contributions" class="btn btn-primary">Cancel</a>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>


</form>
</div>
</div>
</div>
</section>
</div>
<script>
    function validateForm() {
      var x = document.forms["myForm"]["due_amount"].value;
      var y = document.forms["myForm"]["realised_amount"].value;
      if (Number(y) > Number(x) ) {
        alert("Enter Valid Realised Amount");
        return false;
    }
    else
    {
        return true;
    }
    
}
</script>

@endsection