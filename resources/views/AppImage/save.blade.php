@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content" style="padding-top:30px">
    <div class="container-fluid">
    </div>
    <div class="col-12">

        <div class="row mb-2">
          <div class="col-sm-2">
            <a href="/AppImage/List" class="btn btn-back" style="float:left;border-radius: 3px; margin-top: -15px;margin-left: -12px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
        </div>
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
            <h3 class="title-head">Edit App Image</h3>
        </div>
        <div class="col-sm-2">
        </div>
        
    </div>
</div>
<div class="row">
    <div class="col-md-12">
      <div class="card card-primary" >

        <form role="form" method="post" class="col-md-6 was-validated" action="{{ route('save.appImage') }}" enctype="multipart/form-data" style="margin: 0 auto;">
          @csrf
          
          <div class="form-group">
           
              <input type="hidden" name="App_image_cat_id" value="{{$AppImage->App_image_cat_id}}">
              
          </div>
          <div class="form-group">
              <label>Category Image</label>
              <select class="form-control" name="App_image_id" id="App_image_id"  onchange="subcategory(this.value)" required>
                <option value="">Select Category Image</option>
                @foreach($AppImageConfig as $appImage) 
                <option value="{{$appImage->App_image_config_id}}">{{ $appImage->App_image_desc}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" id="AppImageFile">
            <label >Image Path</label>
            <div class="input-group" >
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="AppImagePath" accept=" image/gif, image/jpeg ,image/png">
                <label class="custom-file-label">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
            </div>
        </div>
        <label id="dimension" style="color: #d23"></label>
    </div>
    
    <div class="row">
        <div class="col-md-11form-group" id="App_image_path_group">
           <label >Upload Image</label>
           <img src="" id="App_image_path" width="100px" height="50px">
       </div>
       
       <a class="col-md-1" style="cursor: pointer;margin-top:13px" onclick="Delete('{{$AppImage->App_image_cat_id}}')"><span class="badge bg-danger"><i class="fas fa-trash"></i></span></a>
   </div>
   <div class="form-group">
    <label >Image Text</label>
    <input type="text" class="form-control" id="AppText" name="AppText">                   
</div>
<div style="padding: 1.45rem 9.25rem">
  <a href="/AppImage/List" class="btn btn-primary">Cancel</a>
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

<script>
    function AppCategory(categoryId)
    {
      var id = categoryId;
      var subArray =  @json($AppImageConfig);
      $('#App_image_id').empty();
      $('#App_image_id').append('<option value="">Category Image</option>');
      var filteredArray = subArray.filter(x => x.App_cat_id == id);
      var options = filteredArray.forEach( function(item, index){
         $('#App_image_id').append('<option value="'+item.App_image_config_id+'">'+item.App_image_desc+'</option>');
     });
  }
</script>
<script>
    function subcategory(SubId)
    {
      var id = SubId;
      var subArray =  @json($AppImageConfig);
      $('#App_image_path').empty();
      $('#App_image_text').empty();
      $('#App_image_text').show();
      var filteredArray = subArray.filter(x => x.App_image_config_id == id);
      var options = filteredArray.forEach( function(item, index){
        document.getElementById('App_image_path').src = item.App_image_path;
        $('#AppText').val(item.App_image_text);
        if(item.Image_dimen!=null){
          $("#dimension").html("Image resolution should be "+item.Image_dimen);
        }else{
          $("#dimension").html(item.Image_dimen);
        }
    });
  }
</script>
<script>
  function Delete(value) {
    var values = document.getElementById("App_image_id").value;
    if (confirm("Are your sure you want to delete the image?")) {
      $.ajax({
          type : 'get',
          url : '{{URL::to('AppImage/Delete')}}',
          data : {'App_image_id':values},
          success:function(data){
            console.log(data);
            window.location.reload();
        },
        error: function(xhr, status, error) {
          alert('Image not available or deleted already');
      }
  });

  } else {
   
  }
}
</script>

@endsection