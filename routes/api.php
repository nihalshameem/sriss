<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '/v2'], function () {

	    Route::post('/member_register',[App\Http\Controllers\MembersController::class, 'Registration']);

    	Route::post('/login', [App\Http\Controllers\MembersController::class,'Authenticate']);

		Route::post('/mobile_verification', [App\Http\Controllers\MembersController::class,'Mobile_Verification']);

		Route::get('/language_lock', [App\Http\Controllers\WebApplicationController::class,'getLanguageLock']);

		Route::post('/reset_password', [App\Http\Controllers\MembersController::class,'Forgot_password']);

		Route::get('/app_icon', [App\Http\Controllers\WebApplicationController::class,'getAppIcon']);

		Route::get('/app_image', [App\Http\Controllers\AppImageController::class,'getAppImage']);

		Route::get('/about_us', [App\Http\Controllers\WebApplicationController::class,'getAboutUs']);

		Route::get('/news_letter', [App\Http\Controllers\NewsLetterController::class,'getNewsLetter']);

		Route::get('/compliance', [App\Http\Controllers\WebApplicationController::class,'Compliance']);

		Route::post('/logout', [App\Http\Controllers\MembersController::class,'logout']);

		Route::post('/IdcardDetails', [App\Http\Controllers\MembersController::class, 'IdcardDetails']);

		Route::post('/IdcardUpdate', [App\Http\Controllers\MembersController::class, 'IdcardUpdate']);

		Route::post('/profilepictureupdate', [App\Http\Controllers\MembersController::class,'profilepictureupdate']);

		Route::post('/feedback', [App\Http\Controllers\MembersController::class,'Feedback']);

		Route::post('/notification', [App\Http\Controllers\NotificationController::class,'Notifications']);

		Route::post('/polls', [App\Http\Controllers\PollsController::class,'PollsQuestions']);


		Route::post('/pollanswer', [App\Http\Controllers\PollsController::class,'PollsAnswers']);

		Route::post('/pollanswerdetails', [App\Http\Controllers\PollsController::class,'PollsAnswerPercentage']);

		Route::post('/pollsresponse', [App\Http\Controllers\PollsController::class,'PollsResponse']);

		Route::get('/getprofiles', [App\Http\Controllers\MembersController::class,'getProfileData']);

		Route::get('/getDistrict', [App\Http\Controllers\GeoController::class,'getDistrict']);

		Route::post('/profileupdate', [App\Http\Controllers\MembersController::class,'profileupdate']);

		Route::post('/memberprofile', [App\Http\Controllers\MembersController::class,'getProfileStored']);

		Route::post('/contribution', [App\Http\Controllers\ContributionController::class,'storeContribution']);

		Route::post('/onlinepayment', [App\Http\Controllers\ContributionController::class,'StorePayment']);

		Route::post('/offlinepayment', [App\Http\Controllers\ContributionController::class,'StoreOfflinePayment']);

		Route::post('/getOrderId', [App\Http\Controllers\ContributionController::class,'getOrderId']);

		Route::get('/volunteer', [App\Http\Controllers\VolunteerController::class,'getVolunteer']);

		Route::get('/getReceipts', [App\Http\Controllers\ContributionController::class,'Receipts']);

		Route::get('/getMemberReferal',[App\Http\Controllers\MembersController::class, 'MemberReferal']);

		Route::get('/getMemberPendingList',[App\Http\Controllers\MembersController::class, 'MemberApprovalPending']);

		Route::post('/SetMemberApproval',[App\Http\Controllers\MembersController::class, 'UpdateMemberApproval']);

		Route::post('/SetMemberReferal',[App\Http\Controllers\MembersController::class, 'UpdateMemberReferal']);

		Route::get('/getCounts', [App\Http\Controllers\MembersController::class,'getCounts']);

		Route::post('/addAppNotification', [App\Http\Controllers\NotificationController::class,'addAppNotification']);

		Route::post('/listAppNotification', [App\Http\Controllers\NotificationController::class,'listAppNotification']);

		Route::get('/getGroups', [App\Http\Controllers\MemberGroupController::class,'getGroups']);

		Route::get('/termsandconditions', [App\Http\Controllers\WebApplicationController::class,'TermsandConditions']);

		Route::post('/advertisement', [App\Http\Controllers\AdvertisementController::class,'Advertisements']);
		
});
