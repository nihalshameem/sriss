<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => 'cors', 'prefix' => '/v1'], function () {

    Route::post('/login', 'MemberController@authenticate');
    Route::post('/register', 'MemberController@register');
    //Route::get('/logout/{api_token}', 'MemberController@logout');
    Route::post('/logout', 'MemberController@logout');

    Route::post('/notifications', 'MemberController@notifications');
    Route::post('/advertisements', 'MemberController@advertisements');
    Route::post('/pollquestions', 'MemberController@pollquestions');
    Route::post('/pollanswers', 'MemberController@pollanswers');
    Route::post('/pollanswersdetails', 'MemberController@pollanswersdetails');

    Route::get('/zones', 'MemberController@zones');
    Route::get('/districts', 'MemberController@districts');
    Route::get('/taluks', 'MemberController@taluks');
    Route::get('/pins', 'MemberController@pins');
    Route::get('/aos', 'MemberController@aos');
    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');

    Route::post('/feedback', 'MemberController@feedback');
    Route::post('/referral', 'MemberController@referral');
    Route::post('/notification_feedback', 'MemberController@notification_feedback');
    Route::post('/poll_feedback', 'MemberController@poll_feedback');
    
    
    Route::get('/vision', 'MemberController@vision');
    Route::get('/why_factor', 'MemberController@why_factor');
    Route::get('/faq', 'MemberController@faq');
    Route::get('/termsandcondition', 'MemberController@termsandcondition');
    Route::get('/privacypolicy', 'MemberController@privacypolicy');
    Route::get('/idcardvision', 'MemberController@idcardvision');
    
    Route::get('/country', 'MemberController@country');
    Route::get('/state', 'MemberController@state');
    
    
    Route::post('/forget_password', 'MemberController@forget_password');
    Route::post('/myfamily', 'MemberController@myfamily');
    Route::get('/myfamily_details', 'MemberController@myfamily_details');

    Route::post('/countrystate', 'MemberController@countrystate');
    Route::post('/statedistrict', 'MemberController@statedistrict');
    Route::post('/districtarea', 'MemberController@districtarea');
    
    
    Route::post('/registerdetails', 'MemberController@registerdetails');
    Route::post('/profiledetails', 'MemberController@profiledetails');
    Route::post('/religionupdate', 'MemberController@religionupdate');
    Route::post('/maritalupdate', 'MemberController@maritalupdate');
    Route::post('/professionupdate', 'MemberController@professionupdate');
    Route::post('/myfamilyupdate', 'MemberController@myfamilyupdate');
    
    Route::post('/profilepictureupdate', 'MemberController@profilepictureupdate');
    Route::post('/myprofilepicture', 'MemberController@myprofilepicture');
    Route::post('/profileCompletionPercentageUpdate', 'MemberController@profileCompletionPercentageUpdate');
    
    Route::post('/idcardupdate', 'MemberController@idcardupdate');
    
    Route::post('/religiondetails', 'MemberController@religiondetails');
    Route::post('/maritaldetails', 'MemberController@maritaldetails');
    Route::post('/professiondetails', 'MemberController@professiondetails');
    Route::post('/profileupdate', 'MemberController@profileupdate');
    
    
    // Mobile verification
    
    Route::post('/mobileverification', 'MemberController@mobileverification');
    Route::post('/idcarddetails', 'MemberController@idcarddetails');
    
    Route::post('/generalprofilecompletion', 'MemberController@generalprofilecompletion');
    Route::post('/religionprofilecompletion', 'MemberController@religionprofilecompletion');
    Route::post('/familyprofilecompletion', 'MemberController@familyprofilecompletion');
    
    Route::post('/donations', 'MemberController@donations');
    Route::post('/donationupdate', 'MemberController@donationupdate');
    
    
    Route::get('/donationCategory', 'MemberController@donationCategory');
    Route::post('/donationText', 'MemberController@donationText');

    Route::get('/shoppingCategory', 'MemberController@shoppingCategory');
    Route::post('/shoppingSubCategory', 'MemberController@shoppingSubCategory');
    Route::post('/shoppingcartText', 'MemberController@shoppingcartText');
    Route::post('/shoppingProduct', 'MemberController@shoppingProduct');

    Route::get('/sanadhanamCategory', 'MemberController@sanadhanamCategory');
    Route::post('/sanadhanamSubCategory', 'MemberController@sanadhanamSubCategory');
    Route::post('/sanadhanamText', 'MemberController@sanadhanamText');
    Route::post('/sanadhanam', 'MemberController@sanadhanam');
    
    Route::post('/referral_details', 'MemberController@referral_details');
    Route::post('/referral_active_update', 'MemberController@referral_active_update');


});