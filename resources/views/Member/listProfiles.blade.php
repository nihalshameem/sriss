@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">

      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/home" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -15px;margin-left: -19px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-4">
            <h3 class="title-head">Profile</h3>
          </div>
          <div class="col-sm-3">
          </div>
          
        </div>
      </div>
      
      <div class="row">
        <div class="col-1">
        </div>
        <div class="col-10">
          
          <button type="button" class="collapsible1">One</button>
                <div class="content1">
                  <?php
                      $MemberProfile=\App\Models\MemberProfile::where('grouping','one')->get();
                  ?>
                  <div class="table-responsive">
            <table id="example1" class="table table-borderless" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>D_label</th>
                  <th>L2_label</th>
                  <th>L3_label</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($MemberProfile as $i => $memberProfile)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $memberProfile->field_name }}</td>
                  <td>{{ $memberProfile->d_label }}</td>
                  <td>{{ $memberProfile->l2_label }}</td>
                  <td>{{ $memberProfile->l3_label }}</td>
                  <td>
                    <select class="form-control" style="height: auto;" onchange="changeStatus( {{$memberProfile->id}}, this)">
                      @if($memberProfile->active=='Y')
                      <option value="Y" selected="">Y</option>
                      <option value="N">N</option>
                      @elseif($memberProfile->active=='N')
                      <option value="Y">Y</option>
                      <option value="N" selected="" onclick="">N</option>
                      @endif
                    </select>
                  </td>
                  <td>
                   <a href="{{ route('edit.ProfileDetails', ['profileId' => $memberProfile->id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>

         </div>
</div>
<p></p>


         <button type="button" class="collapsible1">Two</button>
                <div class="content1">
                  <?php
                      $MemberProfile=\App\Models\MemberProfile::where('grouping','two')->get();
                  ?>
                  <div class="table-responsive">
            <table id="example1" class="table table-borderless" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>D_label</th>
                  <th>L2_label</th>
                  <th>L3_label</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($MemberProfile as $i => $memberProfile)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $memberProfile->field_name }}</td>
                  <td>{{ $memberProfile->d_label }}</td>
                  <td>{{ $memberProfile->l2_label }}</td>
                  <td>{{ $memberProfile->l3_label }}</td>
                  <td>
                    <select class="form-control" style="height: auto;" onchange="changeStatus( {{$memberProfile->id}}, this)">
                      @if($memberProfile->active=='Y')
                      <option value="Y" selected="">Y</option>
                      <option value="N">N</option>
                      @elseif($memberProfile->active=='N')
                      <option value="Y">Y</option>
                      <option value="N" selected="" onclick="">N</option>
                      @endif
                    </select>
                  </td>
                  <td>
                   <a href="{{ route('edit.ProfileDetails', ['profileId' => $memberProfile->id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>

         </div>
</div>
<p></p>

         <button type="button" class="collapsible1">Three</button>
                <div class="content1">
                  <?php
                      $MemberProfile=\App\Models\MemberProfile::where('grouping','three')->get();
                  ?>
                  <div class="table-responsive">
            <table id="example1" class="table table-borderless" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>D_label</th>
                  <th>L2_label</th>
                  <th>L3_label</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($MemberProfile as $i => $memberProfile)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $memberProfile->field_name }}</td>
                  <td>{{ $memberProfile->d_label }}</td>
                  <td>{{ $memberProfile->l2_label }}</td>
                  <td>{{ $memberProfile->l3_label }}</td>
                  <td>
                    <select class="form-control" style="height: auto;" onchange="changeStatus( {{$memberProfile->id}}, this)">
                      @if($memberProfile->active=='Y')
                      <option value="Y" selected="">Y</option>
                      <option value="N">N</option>
                      @elseif($memberProfile->active=='N')
                      <option value="Y">Y</option>
                      <option value="N" selected="" onclick="">N</option>
                      @endif
                    </select>
                  </td>
                  <td>
                   <a href="{{ route('edit.ProfileDetails', ['profileId' => $memberProfile->id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>

         </div>
</div>
<p></p>

         <button type="button" class="collapsible1">Four</button>
                <div class="content1">
                  <?php
                      $MemberProfile=\App\Models\MemberProfile::where('grouping','four')->get();
                  ?>
                  <div class="table-responsive">
            <table id="example1" class="table table-borderless" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  <th>Name</th>
                  <th>D_label</th>
                  <th>L2_label</th>
                  <th>L3_label</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($MemberProfile as $i => $memberProfile)
                <tr>
                  <td>{{ $i+1 }}</td>
                  <td>{{ $memberProfile->field_name }}</td>
                  <td>{{ $memberProfile->d_label }}</td>
                  <td>{{ $memberProfile->l2_label }}</td>
                  <td>{{ $memberProfile->l3_label }}</td>
                  <td>
                    <select class="form-control" style="height: auto;" onchange="changeStatus( {{$memberProfile->id}}, this)">
                      @if($memberProfile->active=='Y')
                      <option value="Y" selected="">Y</option>
                      <option value="N">N</option>
                      @elseif($memberProfile->active=='N')
                      <option value="Y">Y</option>
                      <option value="N" selected="" onclick="">N</option>
                      @endif
                    </select>
                  </td>
                  <td>
                   <a href="{{ route('edit.ProfileDetails', ['profileId' => $memberProfile->id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>

         </div>
</div>
<p></p>




       </div>
       <!-- /.col -->
     </div>
   </section>
 </div>
 <!-- /.row -->

 <script type="text/javascript">
   function changeStatus(id, value){
    var status = $(value).val();
      if (confirm("Are your sure you want to change the status?")) {
      $.ajax({
        type : 'GET',
        url : '{{URL::to('UpdateProfilesStatus')}}',
        data : {'id':id, 'value':status},
        success:function(data){
          if(data==="success"){
            alert("Success");
          }else{
            alert("Failed");
          }
        } 
      });

    } else {
     
    }
   }
 </script>
 @endsection