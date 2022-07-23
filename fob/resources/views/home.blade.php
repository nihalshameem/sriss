@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
           
 <div class="panel panel-default">
    <div class="panel-heading" style="background-color:#F3F8FA;color:white">Dashboard</div>
                <div class="panel-body">
                    
                  
                    <div class="row">                         
                       <center>

                        <a href="{{url('/home')}}"> <img src="{{url('/images')}}/sriss1.png" class="img-responsive" style="margin-left: -50px" width="230px" height="150px"></a>

                        </center>                
                    </div>
                </div>             
            </div>         
        </div>     
    </div> 
</div> 


<style>
    #css1
{
	font-size:16px;
	font-weight: bold;
	background-color:#591a4c;
	color:white;
	padding:5px;
}

#css2{
font-size:16px;
font-weight: bold;
background-color:#071f44;
color:white;padding:5px;
}

#css3{
font-size:16px;
font-weight: bold;
background-color:#0c2b03;
color:white;padding:5px;
}

#css4{
font-size:16px;
font-weight: bold;
background-color: #66290f;
color:white;padding:7px;
}

#row1{
font-size:20px;
font-weight: bold;
background-color: #874479;
color:white;width:80px;
height:60px;
width:160px;
padding:10px;
}

#row2{
font-size:20px;
font-weight: bold;
background-color: #246ad6;
color:white;width:100px;
height:100px;
padding:10px;
}

#row3{
font-size:20px;
font-weight: bold;
background-color: #598c4a;
color:white;width:120px;
height:100px;
padding:10px;
}

#row4{
font-size:20px;
font-weight: bold;
background-color: #937569;
color:white;
width:120px;
height:100px;
padding:10px;
}


#link1{
color:white;
width:100px;
height:100px;
background-color:#874479;
padding:40px;
text-decoration:none;
}

#link2{
color:white;
width:100px;
height:100px;
background-color:#246ad6;
padding:40px;
text-decoration:none;
}

#link3{
color:white;
width:100px;
height:100px;
background-color:#598c4a;
padding:40px;
text-decoration:none;
}

#link4{
color:white;
width:100px;
height:100px;
background-color:#937569;
padding:40px;
text-decoration:none;
}
</style>
@endsection
