<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();






Route::get('/visions', 'VisionController@visionIndex');
Route::get('/visionAdd', 'VisionController@visionAdd');
Route::post('/visionAdd', 'VisionController@visionStore');
Route::get('/visionEdit/{id}', 'VisionController@visionEdit');
Route::post('/visionUpdate', 'VisionController@visionUpdate');
Route::get('/visionDelete/{id}', 'VisionController@visionDelete');
Route::get('/vsearch', 'VisionController@vsearch');


Route::get('/cfgVisions', 'cfgVisionController@cfgVisionIndex');
Route::get('/cfgVisionAdd', 'cfgVisionController@cfgVisionAdd');
Route::post('/cfgVisionAdd', 'cfgVisionController@cfgVisionStore');
Route::get('/cfgVisionEdit/{id}', 'cfgVisionController@cfgVisionEdit');
Route::post('/cfgVisionUpdate', 'cfgVisionController@cfgVisionUpdate');
Route::get('/cfgVisionDelete/{id}', 'cfgVisionController@cfgVisionDelete');


Route::get('/languages', 'LanguageController@languageIndex');
Route::get('/languageAdd', 'LanguageController@languageAdd');
Route::post('/languageAdd', 'LanguageController@languageStore');
Route::get('/languageEdit/{id}', 'LanguageController@languageEdit');
Route::post('/languageUpdate', 'LanguageController@languageUpdate');
Route::get('/languageDelete/{id}', 'LanguageController@languageDelete');

Route::get('/feedbackMail/{id}', 'MemberController@feedbackMail');
Route::post('/feedbackMailUpdate', 'MemberController@feedbackMailUpdate');




Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    
    
//reports section

Route::get('/dashboard', 'DashboardController@index');

//last year

Route::get('/thisyear_notifications', 'PrintController@thisyear_notifications');
Route::get('/thisyear_members', 'PrintController@thisyear_members');
Route::get('/thisyear_ads', 'PrintController@thisyear_ads');
Route::get('/thisyear_polls', 'PrintController@thisyear_polls');

Route::get('/lastyear_notifications', 'PrintController@index');
Route::get('/lastyear_members', 'PrintController@lastyear_members');
Route::get('/lastyear_ads', 'PrintController@lastyear_ads');
Route::get('/lastyear_polls', 'PrintController@lastyear_polls');

//last month
Route::get('/thismonth_members', 'PrintController@thismonth_members');
Route::get('/thismonth_notifications', 'PrintController@thismonth_notifications');
Route::get('/thismonth_ads', 'PrintController@thismonth_ads');
Route::get('/thismonth_polls', 'PrintController@thismonth_polls');

Route::get('/lastmonth_members', 'PrintController@lastmonth_members');
Route::get('/lastmonth_notifications', 'PrintController@lastmonth_notifications');
Route::get('/lastmonth_ads', 'PrintController@lastmonth_ads');
Route::get('/lastmonth_polls', 'PrintController@lastmonth_polls');

//this week
Route::get('/thisweek_members', 'PrintController@thisweek_members');
Route::get('/thisweek_notifications', 'PrintController@thisweek_notifications');
Route::get('/thisweek_ads', 'PrintController@thisweek_ads');
Route::get('/thisweek_polls', 'PrintController@thisweek_polls');

//yesterday
Route::get('/yesterday_members', 'PrintController@yesterday_members');
Route::get('/yesterday_notifications', 'PrintController@yesterday_notifications');
Route::get('/yesterday_ads', 'PrintController@yesterday_ads');
Route::get('/yesterday_polls', 'PrintController@yesterday_polls');

//today
Route::get('/today_members', 'PrintController@today_members');
Route::get('/today_notifications', 'PrintController@today_notifications');
Route::get('/today_ads', 'PrintController@today_ads');
Route::get('/today_polls', 'PrintController@today_polls');

//total
Route::get('/total_members', 'PrintController@total_members');
Route::get('/total_notifications', 'PrintController@total_notifications');
Route::get('/total_ads', 'PrintController@total_ads');
Route::get('/total_polls', 'PrintController@total_polls');


// Zones
Route::get('/zone_details', 'ZoneController@index');
Route::get('/add_zone', 'ZoneController@show');
Route::post('/add_zone', 'ZoneController@store');

Route::get('/zone_edit/{id}', 'ZoneController@edit');
Route::post('/zone_update','ZoneController@update');
Route::get('/zone_delete/{id}','ZoneController@destroy');

//   Districts
Route::get('/district_details', 'DistrictController@index');
Route::get('/search', 'DistrictController@search');
Route::get('/add_district', 'DistrictController@show');
Route::post('/add_district', 'DistrictController@store');

Route::get('/district_edit/{id}', 'DistrictController@edit');
Route::post('/district_update','DistrictController@update');
Route::get('/district_delete/{id}','DistrictController@destroy');

// Separate zone district details
Route::get('/zone_view/{id}', 'ZoneController@view');

// Add districts in zones
Route::get('/add_zone_district/{id}', 'ZoneController@add_zone_district');

//  zoneid update in district table
Route::post('/dist_zoneid','ZoneController@dist_zoneid');
Route::get('/dist_zoneid_delete/{id}','ZoneController@dist_zoneid_delete');

//  Taluk
Route::get('/taluk_details', 'TalukController@index');
Route::get('/searching', 'TalukController@searching');
Route::get('getdistrictlist', 'TalukController@getDistricts');
Route::get('/add_taluk', 'TalukController@show');
Route::post('/add_taluk', 'TalukController@store');

Route::get('/taluk_edit/{id}', 'TalukController@edit');
Route::post('/taluk_update','TalukController@update');
Route::get('/taluk_delete/{id}','TalukController@destroy');

// Separate district taluk details
Route::get('/district_view/{id}', 'DistrictController@view');

// Add taluks in districts
Route::get('/add_district_taluk/{id}', 'DistrictController@add_district_taluk');

//  distid update in taluk table
Route::post('/taluk_distid','DistrictController@taluk_distid');

// Notifications
Route::get('/notification_details', 'NotificationController@index');
Route::get('/add_notification', 'NotificationController@show');
Route::post('/add_notification', 'NotificationController@store');

Route::get('/search1', 'NotificationController@search1');

Route::get('/notification_edit/{id}', 'NotificationController@edit');
Route::post('/notification_update','NotificationController@update');
Route::get('/notification_delete/{id}','NotificationController@destroy');
Route::get('/notificationonly_delete/{id}','NotificationController@notificationonlydestroy');

// Advertisement
Route::get('/advertisement_details', 'AdvertisementController@index');
Route::get('/add_advertisement', 'AdvertisementController@show');
Route::post('/add_advertisement', 'AdvertisementController@store');

Route::get('/advertisementsearch', 'AdvertisementController@advertisementsearch');

Route::get('/advertisement_edit/{id}', 'AdvertisementController@edit');
Route::post('/advertisement_update','AdvertisementController@update');
Route::get('/advertisement_delete/{id}','AdvertisementController@destroy');
Route::get('/advertisementonly_delete/{id}','AdvertisementController@advertisementonlydestroy');
Route::get('/advertisement_mass_delete', 'AdvertisementController@advertisement_mass_delete_index');
Route::post('/advertisement_mass_delete', 'AdvertisementController@advertisement_mass_delete');

// AOS
Route::get('/aos_details', 'AosController@index');
Route::get('/add_aos', 'AosController@show');
Route::post('/add_aos', 'AosController@store');

Route::get('/aos_edit/{id}', 'AosController@edit');
Route::post('/aos_update','AosController@update');
Route::get('/aos_delete/{id}','AosController@destroy');

Route::get('/feedback_details', 'ZoneController@feedback');
Route::get('/feedback_info/{id}', 'ZoneController@feedback_info');


// Notification Receipient 
Route::get('/add_nreceipt', 'NreceiptController@show');
Route::post('/add_nreceipt', 'NreceiptController@store');

Route::get('/notification_receipt_edit/{id}', 'NreceiptController@edit');
Route::post('/notification_receipt_update','NreceiptController@update');
Route::get('/notification_mass_delete', 'NotificationController@notification_mass_delete_index');
Route::post('/notification_mass_delete', 'NotificationController@notification_mass_delete');

// Advertisement Receipient
Route::get('/add_areceipt', 'AreceiptController@show');
Route::post('/add_areceipt', 'AreceiptController@store');

Route::get('/advertisement_receipt_edit/{id}', 'AreceiptController@edit');
Route::post('/advertisement_receipt_update','AreceiptController@update');


// Polls
Route::get('/poll_details', 'PollquestionController@index');
Route::get('/add_poll_questions', 'PollquestionController@show');
Route::get('/pollquestion_edit/{id}', 'PollquestionController@edit');
Route::post('/pollquestion_update','PollquestionController@update');


Route::get('/pollquestiononly_delete/{id}','PollquestionController@pollquestiononlydestroy');
Route::get('/poll_delete/{id}','PollquestionController@destroy');
Route::post('/add_poll', 'PollquestionController@store');
Route::get('/add_poll_responses', 'PollanswerController@show');
Route::post('/add_poll_response', 'PollanswerController@store');
Route::get('/pollansweronly_delete/{question_id}','PollreceiptController@pollansweronlydestroy');

//poll mass delete
Route::get('/poll_mass_delete', 'PollquestionController@poll_mass_delete_index');
Route::post('/poll_mass_delete', 'PollquestionController@poll_mass_delete');

// Polls Receipient
Route::get('/add_pollreceipt', 'PollreceiptController@show');
Route::post('/add_pollreceipt', 'PollreceiptController@store');
Route::get('/feedback_info/{id}', 'ZoneController@feedback_info');
Route::get('/poll_receipt_edit/{id}', 'PollreceiptController@edit');
Route::post('/poll_receipt_update','PollreceiptController@update');



Route::get('/reports', 'ReportsController@index');

Route::get('/vision_details', 'FaqController@index_vision');
Route::get('/why_factor_details', 'FaqController@index_why_factor');
Route::get('/faq_details', 'FaqController@index_faq');
Route::get('/terms_condition_details', 'FaqController@index_tac');
Route::get('/privacy_policy_details', 'FaqController@index_privacypolicy');
Route::get('/idcard_vision_details', 'FaqController@index_idcardvision');

Route::get('/vision_edit/{id}', 'FaqController@edit_vision');
Route::post('/vision_update','FaqController@update_vision');

Route::get('/factor_edit/{id}', 'FaqController@edit_factor');
Route::post('/factor_update','FaqController@update_factor');

Route::get('/faq_edit/{id}', 'FaqController@edit_faq');
Route::post('/faq_update','FaqController@update_faq');

Route::get('/tac_edit/{id}', 'FaqController@edit_tac');
Route::post('/tac_update','FaqController@update_tac');

Route::get('/privacypolicy_edit/{id}', 'FaqController@edit_privacypolicy');
Route::post('/privacypolicy_update','FaqController@update_privacypolicy');

Route::get('/idcardvision_edit/{id}', 'FaqController@edit_idcardvision');
Route::post('/idcardvision_update','FaqController@update_idcardvision');

Route::get('/member_edit', 'MemberController@member_edit');
Route::post('/member_deactivation', 'MemberController@member_deactivation');

Route::get('/zonedistrict', 'ZonedistrictController@index');
Route::get('getdistrictlist', 'ZonedistrictController@getDistrict');


Route::get('/aos_approval/{id}', 'AosController@aos_approval');
Route::post('/aos_approval_update', 'AosController@aos_approval_update');

Route::get('/notification_approval/{id}', 'NotificationController@notification_approval');
Route::post('/notification_approval_update', 'NotificationController@notification_approval_update');

Route::get('/advertisement_approval/{id}', 'AdvertisementController@advertisement_approval');
Route::post('/advertisement_approval_update', 'AdvertisementController@advertisement_approval_update');

Route::get('/zone_volunteer/{id}', 'ZoneController@add_zone_volunteer');
Route::post('/zone_volunteer', 'ZoneController@store_zone_volunteer');

Route::get('/district_volunteer/{id}', 'DistrictController@add_district_volunteer');
Route::post('/district_volunteer', 'DistrictController@store_district_volunteer');

Route::get('/taluk_volunteer/{id}', 'TalukController@add_taluk_volunteer');
Route::post('/taluk_volunteer', 'TalukController@store_taluk_volunteer');

Route::get('/zone_volunteer_details/{id}', 'ZoneController@zonevolunteer_view');
Route::get('/district_volunteer_details/{id}', 'DistrictController@districtvolunteer_view');
Route::get('/taluk_volunteer_details/{id}', 'TalukController@talukvolunteer_view');


//xlsx file export
Route::get('/lastmonth_ads_xlsx','XlsxController@lastmonth_ads');
Route::get('/lastmonth_members_xlsx','XlsxController@lastmonth_members');
Route::get('/lastmonth_notifications_xlsx','XlsxController@lastmonth_notifications');
Route::get('/lastmonth_polls_xlsx','XlsxController@lastmonth_polls');

Route::get('/thismonth_ads_xlsx','XlsxController@thismonth_ads');
Route::get('/thismonth_members_xlsx','XlsxController@thismonth_members');
Route::get('/thismonth_notifications_xlsx','XlsxController@thismonth_notifications');
Route::get('/thismonth_polls_xlsx','XlsxController@thismonth_polls');

Route::get('/lastyear_ads_xlsx','XlsxController@lastyear_ads');
Route::get('/lastyear_members_xlsx','XlsxController@lastyear_members');
Route::get('/lastyear_notifications_xlsx','XlsxController@lastyear_notifications');
Route::get('/lastyear_polls_xlsx','XlsxController@lastyear_polls');

Route::get('/thisyear_ads_xlsx','XlsxController@thisyear_ads');
Route::get('/thisyear_members_xlsx','XlsxController@thisyear_members');
Route::get('/thisyear_notifications_xlsx','XlsxController@thisyear_notifications');
Route::get('/thisyear_polls_xlsx','XlsxController@thisyear_polls');

Route::get('/lastweek_ads_xlsx','XlsxController@lastweek_ads');
Route::get('/lastweek_members_xlsx','XlsxController@lastweek_members');
Route::get('/lastweek_notifications_xlsx','XlsxController@lastweek_notifications');
Route::get('/lastweek_polls_xlsx','XlsxController@lastweek_polls');

Route::get('/today_ads_xlsx','XlsxController@today_ads');
Route::get('/today_members_xlsx','XlsxController@today_members');
Route::get('/today_notifications_xlsx','XlsxController@today_notifications');
Route::get('/today_polls_xlsx','XlsxController@today_polls');

Route::get('/total_ads_xlsx','XlsxController@total_ads');
Route::get('/total_members_xlsx','XlsxController@total_members');
Route::get('/total_notifications_xlsx','XlsxController@total_notifications');
Route::get('/total_polls_xlsx','XlsxController@total_polls');

Route::get('/yesterday_ads_xlsx','XlsxController@yesterday_ads');
Route::get('/yesterday_members_xlsx','XlsxController@yesterday_members');
Route::get('/yesterday_notifications_xlsx','XlsxController@yesterday_notifications');
Route::get('/yesterday_polls_xlsx','XlsxController@yesterday_polls');

// Get active member list for volunteer assignment

Route::get('getMember', 'ZoneController@getMember');
Route::get('getMemberByMobile', 'RolesController@getMemberByMobile');
Route::get('getMemberByMemberId', 'RolesController@getMemberByMemberId');

Route::get('getMemberByMobile1', 'MemberController@getMemberByMobile1');
Route::get('getMemberByMemberId1', 'MemberController@getMemberByMemberId1');

//fob reports
Route::get('fob_reports', 'FobReportsController@index');
Route::get('/referral_reports','FobReportsController@referral_reports');

Route::get('/user_roles_assign', 'MemberController@user_roles_assign');
Route::post('/roll_assignment', 'MemberController@roll_assignment');

Route::get('/member_details', 'MemberController@member_details');
Route::get('/membersearch', 'MemberController@membersearch');

Route::get('/userAdd', 'ImportController@userAdd');
Route::post('/userAdd', 'ImportController@userAddPost');

Route::get('/volunteer_approval/{id}', 'ZoneController@volunteer_approval');
Route::post('/volunteer_approval_update', 'ZoneController@volunteer_approval_update');
Route::get('/volunteer_destroy/{id}','ZoneController@volunteer_destroy');



Route::get('/memberIdFormat','MemberIdFormatController@index');
Route::get('/memberIdFormatEdit/{id}','MemberIdFormatController@edit');
Route::post('/memberIdFormatPost','MemberIdFormatController@update');





Route::post('/AjaxApproveNotif/{id}', 'NotificationController@AjaxApprove');

Route::post('/AjaxApproveAdver/{id}', 'AdvertisementController@AjaxApprove');






});