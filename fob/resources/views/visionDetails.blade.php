@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:40px;">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align:center;background-color:#F3F8FA;"><b>Visions</b><a href="{{ url( 'visionAdd' ) }}"><i class="fa fa-plus-square fa-lg" style="float:right"></i></a>
                @if(Session::has('volunteer-added'))
                <strong style="color:green;float:left;">Volunteer added success!!</strong> {{ Session::get('message', '') }}
                @endif
                </div>
                
                <div class="panel-body" style="text-align: left;">

                <div class="col-md-3 form-group">
                    <select name="vsearch" id="vsearch" class="form-control">
                          <option value="">Select Vision</option>
                          @foreach ($cfgvisions as $value)
                          <option value="{{ $value->id }}">{{ $value->vision }}</option>
                          @endforeach 
                        </select>
                  </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Language</th>
                      <th>Vision</th>
                      <th>Description</th>
                      <th>Update</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>  

                <?php $i =1; ?>
                    @foreach($visions as $vision)

                <?php
                  $languageName = DB::table('cfg_languages')->where('id',$vision->languageId)->first();
                  $visionName = DB::table('cfg_visions')->where('id',$vision->typeId)->first();
                ?>
                       <tr>
                         <td>{{ $i++ }}</td>
                         <td>{{ $languageName->language }}</td>
                         <td>{{ $visionName->vision }}</td> 
                         <td>{{ $vision->description }}</td> 
                         <td><a href="/fob/visionEdit/{{ $vision->id }}" ><i class="fa fa-edit fa-lg" style="text-align:cenetr;"></i></a></td>
                         <td><a href="/fob/visionDelete/{{ $vision->id }}" onclick="return confirm('Are you sure,You want to delete?')"><i class="fa fa-trash fa-lg" style="text-align:cenetr;"></i></a></td>
                       </tr>
                     @endforeach



                  </tbody> 
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >


<script type="text/javascript">
    $('#vsearch').on('change',function(){
      $value=$(this).val();
      $.ajax({
        type : 'get',
        url : '{{URL::to('vsearch')}}',
        data : {'vsearch':$value},
        success:function(data){
          console.log(data);
          $('tbody').html(data);
        } 
      });
    })
  </script>

  <script language="JavaScript" type="text/javascript">
    function checkDelete(){
    return confirm('Are you sure?');
}
</script>

@endsection
