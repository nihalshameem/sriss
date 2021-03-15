<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
});



Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'AdminLogin'])->name('admin.login');

Route::post('/SendEmail', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'SendEmail'])->name('send.email');

Route::get('/forgotpassword/{email}/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgotPassword'])->name('forgotpassword');

Route::post('/ResetPassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPassword');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ContributionReports', [App\Http\Controllers\HomeController::class,'OnlineContributions'])->name('OnlineContributions');

Route::get('/OfflineContributionsReports', [App\Http\Controllers\HomeController::class,'OfflineContributions'])->name('OfflineContributions');
/*About Us*/

Route::get('/AboutUs', [App\Http\Controllers\WebApplicationController::class, 'Index'])->name('aboutus');
Route::post('/AboutUs', [App\Http\Controllers\WebApplicationController::class, 'SaveAbout'])->name('save.aboutus');

/* Compliance */

Route::get('/Compliance', [App\Http\Controllers\ComplianceController::class, 'ListCompliance'])->name('list.compliance');
Route::get('/EditCompliance/{id}', [App\Http\Controllers\ComplianceController::class, 'EditCompliance'])->name('edit.compliance');
Route::post('/SaveCompliance', [App\Http\Controllers\ComplianceController::class, 'SaveCompliance'])->name('save.compliance');


/* News Letter */

Route::get('/NewsLetter', [App\Http\Controllers\NewsLetterController::class, 'ListNewsLetter'])->name('list.newsletter');
Route::get('/ShowNewsLetter', [App\Http\Controllers\NewsLetterController::class, 'ShowNewsLetter'])->name('show.newsletter');
Route::post('/SaveNewsLetter', [App\Http\Controllers\NewsLetterController::class, 'SaveNewsLetter'])->name('save.newsletter');

Route::get('/NewsLetterMassDelete',[App\Http\Controllers\NewsLetterController::class,'TruncateNewsLetter'])->name('truncate.newsletter');

Route::get('/NewsLetterDelete',[App\Http\Controllers\NewsLetterController::class,'NewsLetterDelete'])->name('delete.newsletter');

Route::get('/EditNewsLetter/{NewsLetterId}', [App\Http\Controllers\NewsLetterController::class, 'EditNewsLetter'])->name('edit.newsletter');

Route::post('/UpdateNewsLetter', [App\Http\Controllers\NewsLetterController::class, 'UpdateNewsLetter'])->name('update.newsletter');


/* Language Lock */

Route::get('/languageLock', [App\Http\Controllers\WebApplicationController::class, 'ShowLanguageLock'])->name('list.languageLock');
Route::post('/languageLock', [App\Http\Controllers\WebApplicationController::class, 'SaveLanguageLock'])->name('save.languageLock');


/*App Image */

Route::group(['prefix' => 'AppImage'], function () {

   Route::get('/List', [App\Http\Controllers\AppImageController::class, 'List'])->name('list.AppList');

   Route::get('/Show/{imageId}', [App\Http\Controllers\AppImageController::class, 'Show'])->name('list.appImage');

   Route::post('/Store', [App\Http\Controllers\AppImageController::class, 'Save'])->name('save.appImage');

   Route::get('/Delete', [App\Http\Controllers\AppImageController::class, 'Delete'])->name('DeleteAppImage');
});



/*App Icon */

Route::get('/appIcon', [App\Http\Controllers\WebApplicationController::class, 'ShowAppIcon'])->name('list.appIcon');
Route::get('/EditAppIcon/{AppIconId}', [App\Http\Controllers\WebApplicationController::class, 'AddAppIcon'])->name('edit.appIcon');
Route::post('/appIcon', [App\Http\Controllers\WebApplicationController::class, 'SaveAppIcon'])->name('save.appIcon');


/*Member Search */

Route::get('/MemberDetails', [App\Http\Controllers\MembersController::class, 'MemberDetails'])->name('list.MemberDetails');

Route::get('/MemberSearch', [App\Http\Controllers\MembersController::class, 'MemberSearch'])->name('save.MemberDetails');

Route::get('/Profiles', [App\Http\Controllers\WebApplicationController::class, 'ListProfiles'])->name('list.ProfileDetails');

Route::get('/EditProfiles/{profileId}', [App\Http\Controllers\WebApplicationController::class, 'EditProfiles'])->name('edit.ProfileDetails');

Route::post('/UpdateProfiles', [App\Http\Controllers\WebApplicationController::class, 'UpdateProfiles'])->name('update.ProfileDetails');

/*Member Deactivation */

Route::get('/MemberEdit', [App\Http\Controllers\MembersController::class, 'MemberDeactivateList'])->name('MemberEdit');

Route::get('/MemberDeactivate', [App\Http\Controllers\MembersController::class, 'MemberDeactivateSearch'])->name('save.MemberDetails');

Route::get('/MemberDeactivation/{memberId}', [App\Http\Controllers\MembersController::class, 'MemberDeactivation'])->name('MemberDeactivation');

Route::get('/MemberActivation/{memberId}', [App\Http\Controllers\MembersController::class, 'MemberActivation'])->name('MemberActivation');


/*Notification */
Route::get('/Notifications', [App\Http\Controllers\NotificationController::class, 'GetNotifications'])->name('list.notification');

Route::get('/Notificationsearch', [App\Http\Controllers\NotificationController::class,'Search']);

Route::get('/AddNotification', [App\Http\Controllers\NotificationController::class, 'NotificationShow'])->name('add.notification');

Route::post('/Save', [App\Http\Controllers\NotificationController::class, 'SaveNotification'])->name('save.notification');

Route::post('/updateNotification', [App\Http\Controllers\NotificationController::class, 'UpdateNotification'])->name('update.notification');

Route::get('/Edit/{Notification}', [App\Http\Controllers\NotificationController::class, 'editNotification'])->name('edit.notification');

Route::get('/NotificationMassDelete',[App\Http\Controllers\NotificationController::class,'TruncateNotification'])->name('truncate.notification');

Route::get('/notificationonly_delete',[App\Http\Controllers\NotificationController::class, 'DeleteNotification'])->name('delete.notification');

Route::post('/NotificationApproval', [App\Http\Controllers\NotificationController::class, 'NotificationApproval']);


/* Roles And Privilleges */


Route::group(['prefix' => 'User'], function () {

    Route::get('/', [App\Http\Controllers\AdminController::class, 'List'])->name('list.admin');

    Route::get('/Add', [App\Http\Controllers\AdminController::class, 'ShowUser'])->name('add.user');

   Route::get('/Search', [App\Http\Controllers\AdminController::class, 'UserSearch']);

   Route::get('/Edit/{UserId}', [App\Http\Controllers\AdminController::class, 'EditUser'])->name('edit.user');

  Route::post('/Update', [App\Http\Controllers\AdminController::class, 'UpdateUser'])->name('update.user');

  Route::get('/RemoveRole', [App\Http\Controllers\AdminController::class, 'RemoveRole'])->name('RemoveRole');

  Route::post('/Create', [App\Http\Controllers\AdminController::class, 'AssignUser'])->name('add.admin');


});

Route::group(['prefix' => 'Permission'], function () {

    Route::post('/Add', [App\Http\Controllers\AdminController::class, 'AddPermission'])->name('add.permission');

    Route::get('/Edit/{PermissionId}', [App\Http\Controllers\AdminController::class, 'EditPermission'])->name('edit.Permission');

    Route::post('/Update', [App\Http\Controllers\AdminController::class, 'UpdatePermission'])->name('update.Permission');

  Route::get('/Delete', [App\Http\Controllers\AdminController::class, 'DeletePermission'])->name('Delete.Permission');

});

Route::group(['prefix' => 'Role'], function () {

    Route::post('/Add', [App\Http\Controllers\AdminController::class, 'AddRoles'])->name('add.roles');

    Route::get('/Edit/{RoleId}', [App\Http\Controllers\AdminController::class, 'EditRole'])->name('edit.role');

  Route::get('/Delete', [App\Http\Controllers\AdminController::class, 'DeleteRole'])->name('Delete.role');

  Route::post('/Update', [App\Http\Controllers\AdminController::class, 'UpdateRole'])->name('update.role');

});

Route::group(['prefix' => 'Privilleges'], function () {

    Route::get('/Edit/{PrivillegeId}', [App\Http\Controllers\AdminController::class, 'EditPrivilleges'])->name('edit.Privilleges');

  Route::post('/Update', [App\Http\Controllers\AdminController::class, 'UpdatePrivileges'])->name('update.Privilleges');

});



/*Polls */

Route::get('/Polls', [App\Http\Controllers\PollsController::class, 'ListPolls'])->name('list.polls');
Route::get('/AddPolls', [App\Http\Controllers\PollsController::class, 'Addpolls'])->name('add.polls');

Route::post('/SavePolls', [App\Http\Controllers\PollsController::class, 'SavePolls'])->name('save.polls');

Route::get('/EditPoll/{QuestionId}', [App\Http\Controllers\PollsController::class, 'EditQuestion'])->name('edit.question');

Route::get('/deletePoll', [App\Http\Controllers\PollsController::class, 'DeleteQuestion'])->name('delete.question');

Route::post('/update', [App\Http\Controllers\PollsController::class, 'UpdateQuestion'])->name('update.question');

Route::get('/Responses/{question}', [App\Http\Controllers\PollsController::class, 'Responses'])->name('response');

Route::get('/Pollsearch', [App\Http\Controllers\PollsController::class,'Search']);

Route::get('/TruncatePolls', [App\Http\Controllers\PollsController::class,'TruncatePolls'])->name('truncate.polls');

Route::get('/deleteanswer', [App\Http\Controllers\PollsController::class, 'DeleteAnswer'])->name('delete.answer');


/* Contributions */

Route::get('/Contributions', [App\Http\Controllers\ContributionController::class,'listContributions'])->name('listContributions');

Route::get('/AddContributions', [App\Http\Controllers\ContributionController::class,'ShowContributions'])->name('ShowContributions');

Route::post('/SaveContributions', [App\Http\Controllers\ContributionController::class,'SaveContributions'])->name('SaveContributions');

Route::get('/AddContributions-payment', [App\Http\Controllers\ContributionController::class,'ShowPayment'])->name('contribution.payment');

Route::post('/PostContributions', [App\Http\Controllers\ContributionController::class,'CreateContributions'])->name('PostContributions');


Route::get('/EditContributions/{contributionId}', [App\Http\Controllers\ContributionController::class,'EditContributions'])->name('EditContributions');


Route::get('/MobileNumbersearch', [App\Http\Controllers\MembersController::class,'MobileNumbersearch'])->name('MobileNumbersearch');

Route::post('/UpdateContributions', [App\Http\Controllers\ContributionController::class,'UpdateContributions'])->name('UpdateContributions');

/* Geo */

Route::get('/geo', [App\Http\Controllers\GeoController::class,'listGeo'])->name('listGeo');

Route::get('/GreaterZone', [App\Http\Controllers\GeoController::class,'GreaterZone'])->name('GreaterZone');

Route::get('/Zone', [App\Http\Controllers\GeoController::class,'Zone'])->name('Zone');

Route::get('/District', [App\Http\Controllers\GeoController::class,'District'])->name('District');

Route::get('/Union', [App\Http\Controllers\GeoController::class,'Union'])->name('Union');

/* Create Geo */

Route::get('/ShowState', [App\Http\Controllers\GeoController::class,'ShowState'])->name('ShowState');

Route::get('/ShowStateDivision', [App\Http\Controllers\GeoController::class,'ShowStateDivision'])->name('ShowStateDivision');

Route::post('/CreateStateDivision', [App\Http\Controllers\GeoController::class,'CreateStateDivision'])->name('CreateStateDivision');

Route::get('/ShowGreaterZone', [App\Http\Controllers\GeoController::class,'ShowGreaterZone'])->name('ShowGreaterZone');

Route::post('/CreateState', [App\Http\Controllers\GeoController::class,'CreateState'])->name('CreateState');

Route::post('/AddGreaterZone', [App\Http\Controllers\GeoController::class,'CreateGreaterZone'])->name('AddGreaterZone');

Route::get('/ShowZone', [App\Http\Controllers\GeoController::class,'ShowZone'])->name('ShowZone');


Route::post('/AddZone', [App\Http\Controllers\GeoController::class,'CreateZone'])->name('AddZone');

Route::post('/AddDistrict', [App\Http\Controllers\GeoController::class,'CreateDistrict'])->name('AddDistrict');

Route::get('/ShowDistrict', [App\Http\Controllers\GeoController::class,'ShowDistrict'])->name('ShowDistrict');


Route::get('/ShowUnion', [App\Http\Controllers\GeoController::class,'ShowUnion'])->name('ShowUnion');

Route::post('/AddUnion', [App\Http\Controllers\GeoController::class,'CreateUnion'])->name('AddUnion');

Route::get('/ShowPanchayat', [App\Http\Controllers\GeoController::class,'ShowPanchayat'])->name('ShowPanchayat');

Route::post('/AddPanchayat', [App\Http\Controllers\GeoController::class,'CreatePanchayat'])->name('AddPanchayat');


Route::get('/ShowVillage', [App\Http\Controllers\GeoController::class,'ShowVillage'])->name('ShowVillage');

Route::post('/AddVillage', [App\Http\Controllers\GeoController::class,'CreateVillage'])->name('AddVillage');


Route::get('/ShowStreet', [App\Http\Controllers\GeoController::class,'ShowStreet'])->name('ShowStreet');

Route::post('/AddStreet', [App\Http\Controllers\GeoController::class,'CreateStreet'])->name('AddStreet');

/*Edit Geo*/

Route::get('/EditState/{Stateid}', [App\Http\Controllers\GeoController::class,'EditState'])->name('EditState');

Route::get('/EditStateDivision/{StateDivisionid}', [App\Http\Controllers\GeoController::class,'EditStateDivision'])->name('EditStateDivision');

Route::get('/EditGreaterZone/{GreaterZoneid}', [App\Http\Controllers\GeoController::class,'EditGreaterZone'])->name('EditGreaterZone');

Route::get('/EditZone/{Zoneid}', [App\Http\Controllers\GeoController::class,'EditZone'])->name('EditZone');

Route::get('/EditDistrict/{Districtid}', [App\Http\Controllers\GeoController::class,'EditDistrict'])->name('EditDistrict');

Route::get('/EditUnion/{Unionid}', [App\Http\Controllers\GeoController::class,'EditUnion'])->name('EditUnion');

Route::get('/EditPanchayat/{Panchayatid}', [App\Http\Controllers\GeoController::class,'EditPanchayat'])->name('EditPanchayat');

Route::get('/EditVillage/{VillageId}', [App\Http\Controllers\GeoController::class,'EditVillage'])->name('EditVillage');

Route::get('/EditStreet/{StreetId}', [App\Http\Controllers\GeoController::class,'EditStreet'])->name('EditStreet');

/*Update Geo */

Route::post('/UpdateState', [App\Http\Controllers\GeoController::class,'UpdateState'])->name('UpdateState');
Route::post('/UpdateStateDivision', [App\Http\Controllers\GeoController::class,'UpdateStateDivision'])->name('UpdateStateDivision');
Route::post('/UpdateGreaterZone', [App\Http\Controllers\GeoController::class,'UpdateGreaterZone'])->name('UpdateGreaterZone');
Route::post('/UpdateZone', [App\Http\Controllers\GeoController::class,'UpdateZone'])->name('UpdateZone');
Route::post('/UpdateDistrict', [App\Http\Controllers\GeoController::class,'UpdateDistrict'])->name('UpdateDistrict');

Route::post('/UpdateUnion', [App\Http\Controllers\GeoController::class,'UpdateUnion'])->name('UpdateUnion');
Route::post('/UpdatePanchayat', [App\Http\Controllers\GeoController::class,'UpdatePanchayat'])->name('UpdatePanchayat');
Route::post('/UpdateVillage', [App\Http\Controllers\GeoController::class,'UpdateVillage'])->name('UpdateVillage');
Route::post('/UpdateStreet', [App\Http\Controllers\GeoController::class,'UpdateStreet'])->name('UpdateStreet');


/*Delete Geo*/

Route::get('/DeleteState', [App\Http\Controllers\GeoController::class,'DeleteState'])->name('DeleteState');

Route::get('/DeleteStateDivision', [App\Http\Controllers\GeoController::class,'DeleteStateDivision'])->name('DeleteStateDivision');

Route::get('/DeleteGreaterZone', [App\Http\Controllers\GeoController::class,'DeleteGreaterZone'])->name('DeleteGreaterZone');

Route::get('/DeleteZone', [App\Http\Controllers\GeoController::class,'DeleteZone'])->name('DeleteZone');

Route::get('/DeleteDistrict', [App\Http\Controllers\GeoController::class,'DeleteDistrict'])->name('DeleteDistrict');

Route::get('/DeleteUnion', [App\Http\Controllers\GeoController::class,'DeleteUnion'])->name('DeleteUnion');

Route::get('/DeletePanchayat', [App\Http\Controllers\GeoController::class,'DeletePanchayat'])->name('DeletePanchayat');
Route::get('/DeleteVillage', [App\Http\Controllers\GeoController::class,'DeleteVillage'])->name('DeleteVillage');
Route::get('/DeleteStreet', [App\Http\Controllers\GeoController::class,'DeleteStreet'])->name('DeleteStreet');


/*FeedBack */

Route::get('/Feedback', [App\Http\Controllers\ComplianceController::class,'listFeedback'])->name('listfeedback');

/*Volunteer*/

Route::get('/VolunteerList', [App\Http\Controllers\VolunteerController::class,'ListVolunteer'])->name('list.volunteer');

Route::get('/VolunteerSearch', [App\Http\Controllers\VolunteerController::class, 'VolunteerSearch'])->name('VolunteerSearch');

Route::get('/UpdateVolunteer/{memberId}', [App\Http\Controllers\VolunteerController::class,'UpdateVolunteer'])->name('update.volunteer');

Route::get('/RemoveVolunteer/{memberId}', [App\Http\Controllers\VolunteerController::class,'RemoveVolunteer'])->name('remove.volunteer');

/* Notification Broad Cast */

Route::get('/BroadCast', [App\Http\Controllers\NotificationController::class,'NotificationBroadcast'])->name('list.NotificationBroadcast');

Route::post('/SaveBroadCast', [App\Http\Controllers\NotificationController::class,'SaveBroadCast'])->name('createNotificationBroadcast');

Route::get('/NotificationBroadCastEdit', [App\Http\Controllers\NotificationController::class,'NotificationBroadCastEdit'])->name('list.notificationbroadcastedit');

Route::post('/UpdateBroadCast', [App\Http\Controllers\NotificationController::class,'UpdateBroadCast'])->name('UpdateBroadCast');

Route::get('/PollsBroadCast', [App\Http\Controllers\PollsController::class,'PollsBroadcast'])->name('list.PollsBroadcast');

Route::post('/SavePollsBroadCast', [App\Http\Controllers\PollsController::class,'SavePollsBroadCast'])->name('SavePollsBroadCast');

Route::get('/PollsBroadCastEdit', [App\Http\Controllers\PollsController::class,'PollsBroadCastEdit'])->name('list.PollsBroadCastEdit');

Route::post('/PollsUpdateBroadCast', [App\Http\Controllers\PollsController::class,'PollsUpdateBroadCast'])->name('PollsUpdateBroadCast');



Route::get('/LoadStateDivision', [App\Http\Controllers\NotificationController::class,'LoadStateDivision'])->name('list.LoadStateDivision');

Route::get('/LoadGreaterZones', [App\Http\Controllers\NotificationController::class,'LoadGreaterZones'])->name('LoadGreaterZones');

Route::get('/LoadZones', [App\Http\Controllers\NotificationController::class,'LoadZones'])->name('LoadZones');

Route::get('/LoadDistrict', [App\Http\Controllers\NotificationController::class,'LoadDistrict'])->name('LoadDistrict');

Route::get('/LoadUnion', [App\Http\Controllers\NotificationController::class,'LoadUnion'])->name('LoadUnion');

Route::get('/LoadPanchayat', [App\Http\Controllers\NotificationController::class,'LoadPanchayat'])->name('LoadPanchayat');

Route::get('/LoadVillage', [App\Http\Controllers\NotificationController::class,'LoadVillage'])->name('LoadVillage');

Route::get('/LoadStreet', [App\Http\Controllers\NotificationController::class,'LoadStreet'])->name('LoadStreet');

Route::post('/UpdateBroadCast', [App\Http\Controllers\NotificationController::class,'UpdateBroadCast'])->name('UpdateBroadCast');


Route::get('generate-pdf', [App\Http\Controllers\ContributionController::class, 'generatePDF']);

/*Reports */

Route::get('/MembersList', [App\Http\Controllers\ReportsController::class,'MembersList'])->name('MembersList');

Route::get('/Reports/MembersListView', [App\Http\Controllers\ReportsController::class,'MembersListView'])->name('MembersListView');

Route::get('/ContributionDetailsSelf', [App\Http\Controllers\ReportsController::class,'ContributionDetailsSelf'])->name('ContributionDetailsSelf');

Route::get('/OfflineCollection', [App\Http\Controllers\ReportsController::class,'OfflineCollection'])->name('OfflineCollection');

Route::get('/Reports/ContributionDetailsSelfView', [App\Http\Controllers\ReportsController::class,'ContributionDetailsSelfView'])->name('ContributionDetailsSelfView');

Route::get('/Reports/OfflineCollectionView', [App\Http\Controllers\ReportsController::class,'OfflineCollectionView'])->name('OfflineCollectionView');

/* Volunteer Geo */

Route::get('/Volunteer', [App\Http\Controllers\VolunteerController::class,'Volunteer'])->name('Volunteer');

Route::post('/VolunteerSave', [App\Http\Controllers\VolunteerController::class,'VolunteerSave'])->name('VolunteerSave');


/*Geo Filter */

Route::get('/ZoneFilter', [App\Http\Controllers\GeoController::class, 'DistrictFilter'])->name('ZoneFilter');

Route::get('/UnionFilter', [App\Http\Controllers\GeoController::class, 'UnionFilter'])->name('UnionFilter');

Route::get('/PanchayatFilter', [App\Http\Controllers\GeoController::class, 'PanchayatFilter'])->name('PanchayatFilter');

Route::get('/VillageFilter', [App\Http\Controllers\GeoController::class, 'VillageFilter'])->name('VillageFilter');

Route::get('/StreetFilter', [App\Http\Controllers\GeoController::class, 'StreetFilter'])->name('StreetFilter');


Route::group(['prefix' => 'Reports'], function () {


Route::get('/', [App\Http\Controllers\ReportsController::class,'ListReports'])->name('list.reports');

Route::get('/Volunteers',[App\Http\Controllers\ReportsController::class, 'VolunteerReports'])->name('volunteer.reports');

Route::get('/volunteer/filter',[App\Http\Controllers\ReportsController::class, 'VolunteerReportFilter']);

Route::get('/DueReports', [App\Http\Controllers\ReportsController::class,'DueReports'])->name('reports.DueReports');

Route::get('/MemberDeactivation', [App\Http\Controllers\ReportsController::class,'MemberDeactivationReports'])->name('reports.MemberDeactivation');

Route::get('/MemberDeactivation/Filter', [App\Http\Controllers\ReportsController::class,'MemberDeactivationReportsFilter'])->name('reports.MemberDeactivation.Filter');

Route::get('/OfflineCollection/Filter', [App\Http\Controllers\ReportsController::class,'OfflineCollectionReportsFilter'])->name('reports.OfflineCollection.Filter');

Route::get('/MemberList/Filter', [App\Http\Controllers\ReportsController::class,'MemberReportsFilter'])->name('reports.MemberList.Filter');

Route::get('/OnlineCollection/Filter', [App\Http\Controllers\ReportsController::class,'OnlineCollectionReportsFilter'])->name('reports.OnlineCollection.Filter');

Route::get('/Karyakarthas',[App\Http\Controllers\ReportsController::class, 'KaryakarthaReports'])->name('karyakartha.reports');

Route::get('/Karyakartha/filter',[App\Http\Controllers\ReportsController::class, 'karyakarthaReportFilter']);

Route::get('/KaryakarthaProfile/Filter', [App\Http\Controllers\ReportsController::class,'KaryakarthaProfileReportsFilter'])->name('reports.KaryakarthaProfile.Filter');

Route::get('/KaryakarthaContribution/Filter', [App\Http\Controllers\ReportsController::class,'KaryakarthaContributionReportsFilter'])->name('reports.KaryakarthaContribution.Filter');

});

Route::group(['prefix' => 'ReportsView'], function () {


Route::get('/', [App\Http\Controllers\ReportsController::class,'ListReportsView'])->name('list.reportsview');

Route::get('/Volunteers',[App\Http\Controllers\ReportsController::class, 'VolunteerReportsView'])->name('volunteer.reportsview');

Route::get('/volunteer/filter',[App\Http\Controllers\ReportsController::class, 'VolunteerReportFilterView']);

Route::get('/DueReports', [App\Http\Controllers\ReportsController::class,'DueReportsView'])->name('reports.DueReportsview');

Route::get('/MemberDeactivation', [App\Http\Controllers\ReportsController::class,'MemberDeactivationReportsView'])->name('reports.MemberDeactivationview');

Route::get('/MemberDeactivation/Filter', [App\Http\Controllers\ReportsController::class,'MemberDeactivationReportsFilterView'])->name('reports.MemberDeactivation.Filterview');

Route::get('/OfflineCollection/Filter', [App\Http\Controllers\ReportsController::class,'OfflineCollectionReportsFilterView'])->name('reports.OfflineCollection.Filterview');

Route::get('/MemberList/Filter', [App\Http\Controllers\ReportsController::class,'MemberReportsFilterView'])->name('reports.MemberList.Filterview');

Route::get('/OnlineCollection/Filter', [App\Http\Controllers\ReportsController::class,'OnlineCollectionReportsFilterView'])->name('reports.OnlineCollection.Filterview');

Route::get('/Karyakarthas',[App\Http\Controllers\ReportsController::class, 'KaryakarthaReportsView'])->name('karyakartha.reportsview');

Route::get('/Karyakartha/filter',[App\Http\Controllers\ReportsController::class, 'karyakarthaReportFilterView']);

Route::get('/KaryakarthaProfile/Filter', [App\Http\Controllers\ReportsController::class,'KaryakarthaProfileReportsFilterView'])->name('reports.KaryakarthaProfile.Filterview');

Route::get('/KaryakarthaContribution/Filter', [App\Http\Controllers\ReportsController::class,'KaryakarthaContributionReportsFilterView'])->name('reports.KaryakarthaContribution.Filterview');

});

Route::get('/forgotpassword',[App\Http\Controllers\ReportsController::class, 'forgotpassword']);

/*Member Group */

Route::get('/memberGroup', [App\Http\Controllers\MemberGroupController::class, 'ShowMemberGroup'])->name('list.memberGroup');

Route::get('/AddMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'AddMemberGroup'])->name('add.memberGroup');

Route::POST('/memberGroup', [App\Http\Controllers\MemberGroupController::class, 'SaveMemberGroup'])->name('save.memberGroup');

Route::get('/EditMemberGroup/{memberGroupId}', [App\Http\Controllers\MemberGroupController::class, 'EditMemberGroup'])->name('edit.memberGroup');

Route::post('/UpdateMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'UpdateMemberGroup'])->name('update.memberGroup');

Route::get('/DeleteMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'DeleteMemberGroup'])->name('delete.memberGroup');

/*Add Member to Group */
Route::get('/groupMember', [App\Http\Controllers\MemberGroupController::class, 'ShowGroupMember'])->name('add.groupMember');

Route::POST('/groupSingleMember', [App\Http\Controllers\MemberGroupController::class, 'SaveSingleGroupMember'])->name('save.singleGroupMember');

Route::POST('/groupMultiMember', [App\Http\Controllers\MemberGroupController::class, 'SaveMultiGroupMember'])->name('save.multiGroupMember');

/** Advertisement **/

Route::get('/Advertisements', [App\Http\Controllers\AdvertisementController::class, 'GetAdvertisements'])->name('list.advertisements');

// Route::get('/Notificationsearch', [App\Http\Controllers\NotificationController::class,'Search']);

Route::get('/AddAdvertisements', [App\Http\Controllers\AdvertisementController::class, 'AdvertisementShow'])->name('add.advertisement');

Route::post('/SaveAdvertisements', [App\Http\Controllers\AdvertisementController::class, 'SaveAdvertisement'])->name('save.advertisement');

Route::post('/updateAdvertisement', [App\Http\Controllers\AdvertisementController::class, 'UpdateAdvertisement'])->name('update.advertisement');

Route::get('/AdEdit/{Advertisement}', [App\Http\Controllers\AdvertisementController::class, 'editAdvertisement'])->name('edit.advertisement');

// Route::get('/NotificationMassDelete',[App\Http\Controllers\NotificationController::class,'TruncateNotification'])->name('truncate.notification');

// Route::get('/notificationonly_delete',[App\Http\Controllers\NotificationController::class, 'DeleteNotification'])->name('delete.notification');

// Route::post('/NotificationApproval', [App\Http\Controllers\NotificationController::class, 'NotificationApproval']);


/* Advertisement Broad Cast */

Route::get('/AdBroadcast', [App\Http\Controllers\AdvertisementController::class,'AdvertisementBroadcast'])->name('list.AdvertisementBroadcast');

Route::post('/SaveAdBroadCast', [App\Http\Controllers\AdvertisementController::class,'SaveAdBroadCast'])->name('save.AdBroadcast');

Route::get('/AdBroadCastEdit', [App\Http\Controllers\AdvertisementController::class,'AdvertisementBroadCastEdit'])->name('list.advertisementbroadcastedit');

Route::post('/UpdateAdBroadCast', [App\Http\Controllers\AdvertisementController::class,'UpdateAdvertisementBroadCast'])->name('UpdateBroadCast');


