<!DOCTYPE html>
<html lang="en">

<body>
	
	<p style="text-align:left;font-weight:bold"> Hello!</p>
	<p style="text-align:center">You are receiving this email because we received a password reset request for your account.</p>

	<div class="button_container" style="text-align:center">
		<a class="view_detail_button" href="{{env('EMAIL_URL')}}forgotpassword/{{$details['email']}}/{{$details['token']}}" target="_blank"
		style="text-align: center; padding: 10px 15px; background: #3b5998; border-radius: 10px; margin: 0; color: white;">Reset Password</a>
	</div><br>
	<p style="text-align:center">If you did not request a password reset, no further action is required.</p>
	<span>Regards</span><br>
	<span>Dharma Rakshana Samiti</span><br>
	<hr>
	{{env('EMAIL_URL')}}forgotpassword/{{$details['email']}}/{{$details['token']}}
</body>

</html> 