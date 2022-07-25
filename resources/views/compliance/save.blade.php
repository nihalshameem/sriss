@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">

       <div class="col-12">

          <div class="row mb-2">
            <div class="col-sm-2">
              <a href="/Compliance" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          
          <div class="col-sm-5">
              <h3 class="title-head">Edit Compliance</h3>
          </div>
          <div class="col-sm-2">
          </div>
          
      </div>
  </div>
  <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
           
          <form role="form" method="post" class="col-md-11 was-validated" action="{{ route('save.compliance') }}" style="margin:0 auto">
            @csrf
            <input type="hidden" name="ComplianceId" value="{{$Compliances->Compliance_id}}">
            
            <div class="form-group">
              <label for="exampleInputPassword1">Compliance Item</label>
              <input type="text" class="form-control" name="Compliance_desc" placeholder="Enter Description" value="{{ $Compliances->Compliance_desc }}" required>
              
          </div>
          <div class="form-group">
              <label for="exampleInputPassword1">Text</label>
              <textarea class="textarea form-control"  name="Compliance_text" placeholder="Enter text" value="{{ $Compliances->Compliance_text }}" required>{{ html_entity_decode($Compliances->Compliance_text) }}
              </textarea>
              <div class="invalid-feedback" style="font-size:25px;font-weight: bold">
                Please enter  description
            </div>
            
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Version No</label>
          <input type="number" class="form-control" name="version" placeholder="Enter version" value="{{ $Compliances->Version_no }}" required>
          
      </div>

      <div class="form-group">
              <div >
                <label>Active</label>
              </div>
              <!-- checkbox -->
              <div class="form-group clearfix">
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary1" value="Y" name="active" {{ ($Compliances->Compliance_active == "Y") ? 'checked' : '' }}>
                  <label for="checkboxPrimary1">Yes
                  </label>
                </div>
                
                <div class="icheck-primary d-inline">
                  <input type="radio" id="checkboxPrimary2" value="N"  name="active" {{ ($Compliances->Compliance_active == "N") ? 'checked' : '' }}>
                  <label for="checkboxPrimary2">
                    No
                  </label>
                </div>
              </div>
            </div>
  </div>

  <div style="max-width: 200px; margin: auto;">
    <a href="/Compliance" class="btn btn-primary">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<br>
</form>
</div>
</div>
</div>
</div>
</section>
</div>
@endsection