@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Member Details
                </div>

                <div class="panel-body" style="text-align: left;">
                
                <div class="panel-body" style="text-align: left;">
                  
                  
                  <div class="col-md-3 form-group">
                    <select name="membersearch" id="mobile_number" class="selectpicker form-control membersearch"  data-live-search="true">
                          <option value="">Mobile Number</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->mobile_number }}">{{ $member->mobile_number }}</option>
                          @endforeach 
                        </select>
                  </div>

                  <div class="col-md-3 form-group">
                    <select name="membersearch" id="member_id" class="selectpicker form-control membersearch"  data-live-search="true">
                          <option value="">Email</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->email }}">{{ $member->email }}</option>
                          @endforeach 
                        </select>
                  </div>

                  <div class="col-md-3 form-group">
                    <select name="membersearch" id="member_id" class="selectpicker form-control membersearch"  data-live-search="true">
                          <option value="">Member Id</option>
                          @foreach ($members as $member)
                          <option value="{{ $member->member_id }}">{{ $member->member_id }}</option>
                          @endforeach 
                        </select>
                  </div>
                
                
                <table class="table">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Mobile Number</th>
                      <th>Member Id</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody>  
                  
                  </tbody> 
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.membersearch').on('change',function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('membersearch')}}',
        data : {'membersearch':$value},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
  </script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  
@endsection
