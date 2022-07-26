@extends('layouts.app')
@section('content')
<div class="content-wrapper">

  <section class="content" style="padding-top:25px">
    <div class="container-fluid">
      <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/political/category/list" class="btn btn-back" style="float:left;border-radius: 3px;background-color: aqua;margin-top: -10px;margin-left: -16px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
          </div>
          <div class="col-sm-3">
          </div>
          <div class="col-sm-5">
            <h3 class="title-head">Edit Parliament</h3>
          </div>
          <div class="col-sm-3">
          </div>

        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">

            <form role="form" method="post" class="col-md-6 "  action="{{ route('Update.Parliament') }}"  style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
              @csrf
              <div class="modal-body">
                <input type="hidden" name="id" value="{{$ParliamentConsituency->Parliament_Id}}">

                <div class="form-group">
                    <label for="exampleInputPassword1">State</label>
                    <select class="form-control" name="state" id="state">
                      <option selected="" disabled="">Select State</option>
                      @foreach($states as $state)
                        <option value="{{$state->State_id}}" @if($state->State_id == $ParliamentConsituency->State_id) selected="" @endif>{{$state->State_desc}}</option>
                      @endforeach
                    </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Description</label>
                  <input type="text" class="form-control" name="Description" placeholder="Enter Description" value="{{$ParliamentConsituency->Parliament_Constituency_Desc}}" required>
                </div>

              </div>
              <div style="max-width: 200px; margin: auto;">
                <a href="/political/category/list" class="btn btn-primary">Cancel</a>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>


    </div>
    <!-- /.container-fluid -->
  </section>
</div>
@endsection