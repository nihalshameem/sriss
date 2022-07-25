@extends('layouts.app')

@section('content')
<style>
th{
  font-size:20px;
  font-weight: bold;
}
</style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;">Referral Details
                
                </div>
                <div class="panel-body" style="text-align: left;">      
                
                <table class="table">
                    <?php 
                        $i =1;
                    ?>
                    
                  <thead>
                    <tr>
                      <th>SI NO</th>
                      <th>Name</th>
                      <th>Referral Id</th>
                      <th>Total Referrals</th>
                    </tr>
                  </thead>
                  <tbody> 
                  @foreach($totalreferrals as $value) 
                  <?php 
                      $name = App\Member::where('mobile_number',$value->referral_id)->first();
                      //dd($name->id);
                    ?>
                      
                            @if($value->referral_id == '') 
                          <tr>
                            <td style="display:none">{{ $value->referral_id }}</td>
                          </tr>
                            @else
                            <tr>
                              <td>{{ $i++ }}</td>
                              <td>{{ $name['name'] }}</td>
                              <td>{{ $value->referral_id }}</td>
                              <td>{{ $value->total }}</td>
                            @endif
                          </tr>
                  @endforeach 
                    </tr>
                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#advertisementsearch').on('change',function(si){
      $value=$(this).val();
      $('#advertisementsearch1').on('change',function(){
      $value1=$(this).val();
      dd($value1);
      $.ajax({
        type : 'get',
        url : '{{URL::to('reports_search')}}',
        data : {'advertisementsearch':$value , 'advertisementsearch1':$value1},
        success:function(data){
          $('tbody').html(data);
        } 
      });
    })
    })
</script>

@endsection
