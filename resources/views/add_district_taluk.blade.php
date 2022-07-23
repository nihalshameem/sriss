@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add {{ $district['district']}} Taluk</div>

                <div class="panel-body">
                    <form class="form-horizontal" action="/taluk_distid" method="POST">
                             {{ csrf_field() }}


                        <div class="form-group" style="display:none">
                          <label class="control-label col-sm-3" for="">District:</label> 
                          <div class="col-sm-5">
                          <input type="text" class="form-control" id="" placeholder="Enter District Name" name="districtid" value="{{ $district['id']}}" readonly >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="dist">District:</label> 
                          <div class="col-sm-5">
                          <input type="text" class=" form-control" id="dist" placeholder="Enter District Name" name="" value="{{ $district['district']}}" readonly >
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="taluk">Taluk:</label> 
                        <div class="col-sm-5">
                        <select name="taluk" id="taluk" class="selectpicker form-control"  data-live-search="true"  required>
                          <option value=""> -- Select Taluk --</option>
                          @foreach ($taluks as $taluk)
                          <option value="{{ $taluk->id }}">{{ $taluk->taluk }}</option>
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

@endsection
