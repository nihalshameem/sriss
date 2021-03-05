<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	  <style type="text/css">
	  		h2,h4,h3
	  		{
	  			color:#3b5998;
	  		}
	  	/* Dashed red border */
			hr.new2 
			{
		  		border: 1px dashed #3b5998;
			}
			hr.new1 
			{
		  		border: 1px solid #3b5998;
			}
			p
			{
				font-size:16px;
				color:#3b5998;

			}
			.square 
			{
			  height: 90px;
			  background-color: white;
			  border: 2px solid #3b5998;
			}
			#rcorners1 
			{
			  border-radius: 10px;
			  background: #3b5998;
			  padding: 15px; 
			  height: 15px;  
			  color:white;
			  line-height:20px;
			  text-align:center;

			}
			.hr{
				border:1px solid #3b5998;
			}
			.grid-underline {
  				border-bottom: 2px dotted #3b5998;
			}
			.grid-underline1 {
  				border-bottom: 2px dotted #3b5998;
  				margin-left:20px;
			}
			strong{
				color: #8f3319;
			}


	
		
	  </style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-1">
				<img src="http://dharmarakshanasamiti.org/dev/storage/app/public/AppIcon/1611824404_logo%20tpnt%20opti.jpg" style="width:120px">
			</div>
			<div class="col-xs-10" style="margin-left:10px">
				<h1 style="color:#3b5998;text-align:center;font-weight: bolder">Dharma Rakshna Samithi Trust<p style="color:#3b5998;text-align:center;font-size:14px;font-weight: normal">No.64 Police Commisioner Office Road,Egmore,Chennai-600 008. </p></h1>
			</div>
		</div>
		<hr style="font-weight:bolder">
		<div class="row">
			<div class="col-xs-4"></div>
			<div class="col-xs-5"></div>
		</div>
		<div class="row">
			<div class="col-xs-5">
				<h4>No:{{$receiptNo}}</h4>
			</div>
			<div class="col-xs-2">
				<h3 id="rcorners1">Receipt</h3>
			</div>
			
			<div class="col-xs-3">
				<h4 style="text-align:right">Date : {{$date}}</h4>
			</div>
		</div><br><br>
		<div class="row">
			<p class="col-xs-4" style="margin-top:5px">Received with thanks from</p>
			<p class="col-xs-8 grid-underline" style="margin-left:-60px;"><strong>{{$name}}</strong></p>
		</div>
		<div class="row"  style="margin-top:25px">
			<p class="col-xs-11 grid-underline1" ></p>
		</div>
		<div class="row" style="margin-top:25px">
			<p class="col-xs-3" >the sum of rupees*</p>
			<p class="col-xs-9 grid-underline" style="margin-left:-60px;"><strong>{{$amount}}</strong></p>
		</div>
		<div class="row"  style="margin-top:25px">
			<p class="col-xs-11 grid-underline1" ></p>
		</div>
		<div class="row" style="margin-top:15px">
			<p class="col-xs-3" >by Cheque/Cash/DD No</p>
			<p class="col-xs-8 grid-underline" style="margin-left:-15px;" ><strong>{{$type}}&nbsp;&nbsp;{{$Instnumber}}</strong></p>
		</div>
		<div class="row" style="margin-top:15px">
			<p class="col-xs-12" >towards Donation/Corpus fund.</p>
		</div>
		
	<br><br>
		<div class="row">
			<div class="col-xs-7">
				<br><br><br>
				<h4>RS.{{$amount}}</h4>
			</div>
			
			<div class="col-xs-5">
						<h5 style="color:#3b5998;font-weight: bolder;font-size:17px">for Dharma Rakshana Samiti Trust</h5><br>
						<h5 style="color:#3b5998;text-align:center">Authorised Signature</h5>

			</div>
		</div>
		<br>
		<div class="row">
		<div class="col-xs-12 square">
					<h5 style="text-align:center;font-size:15px;color:#3b5998;font-weight: bold">
					80-G INCOME TAX EXEMPTION
					</h5>
					<p style="font-size:12px;text-align:center">DIT(E) No.2,(1081)0708 Chennai Dated {{$date}}</p>
					<h5 style="color:#3b5998;text-align:center;font-size:12px;font-weight: bold">Validity Continues</h5>
			</div>
		</div>
		<hr class="hr">
				<h5  style="color:#3b5998;text-align:left">*Cheques subject to realisation</h5>

	</div>
</body>
</html>