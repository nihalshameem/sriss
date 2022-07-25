@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top:40px">
        <div class="col-md-10 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color:#F3F8FA;">Add</div>

                <div class="panel-body">
                    



                    <form class="form-horizontal" action="{{ url('visionAdd') }}" method="POST">
                             {{ csrf_field() }}
                        
                        

                        <div class="form-group">
                          <label class="control-label col-sm-3" for="vision">Visions:</label>

                          <div class="col-sm-5">
                            <select name="visionId" id="vision" class="form-control" required>
                              <option value="">Select Vision</option>
                              @foreach ($visions as $vision)
                                <option value="{{ $vision->id }}">{{ $vision->vision }}</option>
                              @endforeach 
                            </select>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="control-label col-sm-3" for="language">Languages:</label>

                          <div class="col-sm-5">
                            <select name="languageId" id="language" class="form-control" required>
                              <option value="">Select Language</option>
                              @foreach ($languages as $language)
                                <option value="{{ $language->id }}">{{ $language->language }}</option>
                              @endforeach 
                            </select>
                          </div>
                        </div>


                        <div class="form-group">
                          <label class="control-label col-md-3" for="description">Descriptions:</label> 
                          <div class="col-md-9">
                          <textarea class="form-control" id="description" placeholder="Enter Descriptions" rows="10" name="description" required></textarea>
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
