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


Route::group(['middleware' => 'cors', 'prefix' => '/v2'], function () {


    Route::get('/languagesList', 'MemberController@languagesList');
    Route::get('/cfgVisionsList', 'MemberController@cfgVisionsList');
    Route::post('/visionsMenu', 'MemberController@visionsMenu');
    
    
    Route::post('/login', 'MemberController@authenticate');
    Route::post('/user_register', 'MemberController@register');
    Route::post('/logout', 'MemberController@logout');

    Route::post('/notifications', 'MemberController@notifications');
    Route::post('/advertisements', 'MemberController@advertisements');
    Route::post('/pollquestions', 'MemberController@pollquestions');
    Route::post('/pollanswers', 'MemberController@pollanswers');
    Route::post('/referral_details', 'MemberController@referral_details');
    Route::post('/pollanswersdetails', 'MemberController@pollanswersdetails');

    Route::get('/country', 'MemberController@country');
    Route::get('/state', 'MemberController@state');
    Route::get('/zones', 'MemberController@zones');
    Route::get('/districts', 'MemberController@districts');
    Route::get('/taluks', 'MemberController@taluks');

    Route::post('/feedback', 'MemberController@feedback');
    Route::post('/referral', 'MemberController@referral');
    Route::post('/notification_feedback', 'MemberController@notification_feedback');
    Route::post('/poll_feedback', 'MemberController@poll_feedback');
    
    Route::get('/vision', 'MemberController@vision');
    Route::get('/termsandcondition', 'MemberController@termsandcondition');
    Route::get('/privacypolicy', 'MemberController@privacypolicy');
    Route::get('/idcardvision', 'MemberController@idcardvision');
    
    Route::post('/forget_password', 'MemberController@forget_password');

    Route::post('/countrystate', 'MemberController@countrystate');
    Route::post('/statedistrict', 'MemberController@statedistrict');
    Route::post('/districtarea', 'MemberController@districtarea');
    Route::post('/districtassembly', 'MemberController@districtassembly');
    Route::post('/districtparliamentary', 'MemberController@districtparliamentary');
    
    Route::post('/profiledetails', 'MemberController@profiledetails');
    Route::post('/profileupdate', 'MemberController@profileupdate');
    Route::post('/myprofilepicture', 'MemberController@myprofilepicture');
    Route::post('/profilepictureupdate', 'MemberController@profilepictureupdate');
    Route::post('/idcardupdate', 'MemberController@idcardupdate');
 
    Route::post('/mobileverification', 'MemberController@mobileverification');
    Route::post('/idcarddetails', 'MemberController@idcarddetails');
    Route::post('/referral_active_update', 'MemberController@referral_active_update');
    //Route::post('/referralActiveUpdate', 'MemberController@referralActiveUpdate');

});