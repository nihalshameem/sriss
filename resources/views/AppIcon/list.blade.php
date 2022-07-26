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
            <h3 class="title-head">App Icon</h3>
          </div>
          <div class="col-sm-3">
            
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="col-1">
        </div>
            <?php $lang1=\App\Models\Language::Where('Language_active', 'D')
                              ->first();
            $langs=\App\Models\Language::where('Language_active', 'Y')
                                     ->orderBy('Language_id', 'desc')->count();
            if($langs>=2){
              $lang2=\App\Models\Language::where('Language_active', 'Y')
                                     ->orderBy('Language_id', 'desc')->first();
                               
              $lang3=\App\Models\Language::where('Language_active', 'Y')
                                     ->first(); 
            }else if($langs==0){
              $lang2=false;
              $lang3=false;
            }else{
              $lang2=\App\Models\Language::where('Language_active', 'Y')
                                     ->orderBy('Language_id', 'desc')->first();
              $lang3=false;
            }
            ?>

                                
        <div class="col-10">
          <div class="table-responsive">
            <table id="example1" class="table" >
              <thead>
                <tr>
                  <th>Sl No</th>
                  @if($lang1)
                  <th>Default Language</th>
                  @endif
                  @if($lang2 && $lang3)
                  <th>1st Language</th>
                  <th>2nd Language</th>
                  @elseif($lang2 || $lang3)
                  <th>1st Language</th>
                  @endif
                  <th>Icon</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($AppIcon as $i => $appIcon)
                <tr>
                  <td>{{ $i+1 }}</td>
                  @if($lang1)
                  <td>{{ $appIcon->L1_text }}</td>
                  @endif
                  @if($lang2 && $lang3)
                  <td>{{ $appIcon->L2_text }}</td>
                  <td>{{ $appIcon->L3_text }}</td>
                  @elseif(!$lang2)
                  @elseif($lang2->Language_flag=='L2')
                  <td>{{ $appIcon->L2_text }}</td>
                  @elseif($lang2->Language_flag=='L3')
                  <td>{{ $appIcon->L3_text }}</td>
                  @endif
                 
                  <td><img src="{{ $appIcon->AppIcon_image_path }}" width="120px" height="60px"></td>
                  <td><span class="badge bg-success">{{ $appIcon->AppIcon_visible }}</span></td>
                  
                  <td>
                   <a href="{{ route('edit.appIcon', ['AppIconId' => $appIcon->AppIcon_id]) }}"><span class="badge bg-danger"><i class="fa fa-edit fa-lg" style="text-align:center;"></i>&nbsp;&nbsp;Edit</span></a>
                 </td>
               </tr>
               @endforeach

               

             </tbody>
           </table>
         </div>

       </div>
       <!-- /.col -->
     </div>
   </div> 
 </section>
</div>

@endsection