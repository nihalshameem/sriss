@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add {{ $zone['zone']}} District</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/fob/dist_zoneid" method="POST">
                             {{ csrf_field() }}
                        
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="zone">Zone:</label> 
                          <div class="col-sm-5">
                          <input type="text" class="form-control" id="zone" placeholder="Enter Zone Name" name="zoneid" value="{{ $zone['id']}}" >
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="control-label col-sm-3" for="dist">District:</label> 
                        <div class="col-sm-5">
                        <select name="district" id="dist" class="form-control">
                          <option value=""> -- Select District --</option>
                          @foreach ($districts as $district)
                          <option value="{{ $district->id }}">{{ $district->district }}</option>
                          @endforeach 
                        </select>
                        </div>
                        </div>

                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-default" name="submit">Submit</button>
                            <a class="btn btn-default btn-close" href="{{ redirect()->getUrlGenerator()->previous() }}">Cancel</a>
                          </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
