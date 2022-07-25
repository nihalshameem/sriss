<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;

=======
>>>>>>> main
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
<<<<<<< HEAD
 */
=======
*/
>>>>>>> main

Route::get('/', function () {
    return view('auth.login');
});

<<<<<<< HEAD
Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
});

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'AdminLogin'])->name('admin.login');

Route::post('/SendEmail', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'SendEmail'])->name('send.email');

Route::get('/forgotpassword/{email}/{token}', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ForgotPassword'])->name('forgotpassword');

Route::post('/ResetPassword', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'ResetPassword'])->name('ResetPassword');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/ContributionReports', [App\Http\Controllers\HomeController::class, 'OnlineContributions'])->name('OnlineContributions');

Route::get('/OfflineContributionsReports', [App\Http\Controllers\HomeController::class, 'OfflineContributions'])->name('OfflineContributions');
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

Route::get('/NewsLetterMassDelete', [App\Http\Controllers\NewsLetterController::class, 'TruncateNewsLetter'])->name('truncate.newsletter');

Route::get('/NewsLetterDelete', [App\Http\Controllers\NewsLetterController::class, 'NewsLetterDelete'])->name('delete.newsletter');

Route::get('/EditNewsLetter/{NewsLetterId}', [App\Http\Controllers\NewsLetterController::class, 'EditNewsLetter'])->name('edit.newsletter');

Route::post('/UpdateNewsLetter', [App\Http\Controllers\NewsLetterController::class, 'UpdateNewsLetter'])->name('update.newsletter');

/* Language Lock */

Route::get('/language', [App\Http\Controllers\WebApplicationController::class, 'ListLanguage'])->name('list.languageLock');

Route::post('/languageUpdate', [App\Http\Controllers\WebApplicationController::class, 'UpdateLanguage'])->name('update.language');

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

Route::get('/MemberEdit/{memberId}', [App\Http\Controllers\MembersController::class, 'MemberEdit'])->name('edit.Member');

Route::get('/MemberSearch', [App\Http\Controllers\MembersController::class, 'membersearch'])->name('save.MemberDetails');

Route::get('/Profiles', [App\Http\Controllers\WebApplicationController::class, 'ListProfiles'])->name('list.ProfileDetails');

Route::get('/EditProfiles/{profileId}', [App\Http\Controllers\WebApplicationController::class, 'EditProfiles'])->name('edit.ProfileDetails');

Route::post('/UpdateProfiles', [App\Http\Controllers\WebApplicationController::class, 'UpdateProfiles'])->name('update.ProfileDetails');

Route::get('/UpdateProfilesStatus', [App\Http\Controllers\WebApplicationController::class, 'UpdateProfileStatus']);

/*Member Deactivation */

Route::get('/MemberEdit', [App\Http\Controllers\MembersController::class, 'MemberDeactivateList'])->name('MemberEdit');

Route::get('/MemberDeactivate', [App\Http\Controllers\MembersController::class, 'MemberDeactivateSearch'])->name('save.MemberDetails');

Route::get('/MemberDeactivation/{memberId}', [App\Http\Controllers\MembersController::class, 'MemberDeactivation'])->name('MemberDeactivation');

Route::get('/MemberActivation/{memberId}', [App\Http\Controllers\MembersController::class, 'MemberActivation'])->name('MemberActivation');

/*Notification */
Route::get('/Notifications', [App\Http\Controllers\NotificationController::class, 'GetNotifications'])->name('list.notification');

Route::get('/Notificationsearch', [App\Http\Controllers\NotificationController::class, 'Search']);

Route::get('/AddNotification', [App\Http\Controllers\NotificationController::class, 'NotificationShow'])->name('add.notification');

Route::post('/Save', [App\Http\Controllers\NotificationController::class, 'SaveNotification'])->name('save.notification');

Route::post('/updateNotification', [App\Http\Controllers\NotificationController::class, 'UpdateNotification'])->name('update.notification');

Route::get('/Edit/{Notification}', [App\Http\Controllers\NotificationController::class, 'editNotification'])->name('edit.notification');

Route::get('/NotificationMassDelete', [App\Http\Controllers\NotificationController::class, 'TruncateNotification'])->name('truncate.notification');

Route::get('/notificationonly_delete', [App\Http\Controllers\NotificationController::class, 'DeleteNotification'])->name('delete.notification');

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

Route::get('/Pollsearch', [App\Http\Controllers\PollsController::class, 'Search']);

Route::get('/TruncatePolls', [App\Http\Controllers\PollsController::class, 'TruncatePolls'])->name('truncate.polls');

Route::get('/deleteanswer', [App\Http\Controllers\PollsController::class, 'DeleteAnswer'])->name('delete.answer');

/* Contributions */

Route::get('/Contributions', [App\Http\Controllers\ContributionController::class, 'listContributions'])->name('listContributions');

Route::get('/AddContributions', [App\Http\Controllers\ContributionController::class, 'ShowContributions'])->name('ShowContributions');

Route::post('/SaveContributions', [App\Http\Controllers\ContributionController::class, 'SaveContributions'])->name('SaveContributions');

Route::get('/AddContributions-payment', [App\Http\Controllers\ContributionController::class, 'ShowPayment'])->name('contribution.payment');

Route::post('/PostContributions', [App\Http\Controllers\ContributionController::class, 'CreateContributions'])->name('PostContributions');

Route::get('/EditContributions/{contributionId}', [App\Http\Controllers\ContributionController::class, 'EditContributions'])->name('EditContributions');

Route::get('/MobileNumbersearch', [App\Http\Controllers\MembersController::class, 'MobileNumbersearch'])->name('MobileNumbersearch');

Route::post('/UpdateContributions', [App\Http\Controllers\ContributionController::class, 'UpdateContributions'])->name('UpdateContributions');

/* Geo */

Route::get('/geo', [App\Http\Controllers\GeoController::class, 'listGeo'])->name('listGeo');

Route::get('/GreaterZone', [App\Http\Controllers\GeoController::class, 'GreaterZone'])->name('GreaterZone');

Route::get('/Zone', [App\Http\Controllers\GeoController::class, 'Zone'])->name('Zone');

Route::get('/District', [App\Http\Controllers\GeoController::class, 'District'])->name('District');

Route::get('/Union', [App\Http\Controllers\GeoController::class, 'Union'])->name('Union');

/* Create Geo */

Route::get('/ShowState', [App\Http\Controllers\GeoController::class, 'ShowState'])->name('ShowState');

Route::get('/ShowStateDivision', [App\Http\Controllers\GeoController::class, 'ShowStateDivision'])->name('ShowStateDivision');

Route::post('/CreateStateDivision', [App\Http\Controllers\GeoController::class, 'CreateStateDivision'])->name('CreateStateDivision');

Route::get('/ShowGreaterZone', [App\Http\Controllers\GeoController::class, 'ShowGreaterZone'])->name('ShowGreaterZone');

Route::post('/CreateState', [App\Http\Controllers\GeoController::class, 'CreateState'])->name('CreateState');

Route::post('/AddGreaterZone', [App\Http\Controllers\GeoController::class, 'CreateGreaterZone'])->name('AddGreaterZone');

Route::get('/ShowZone', [App\Http\Controllers\GeoController::class, 'ShowZone'])->name('ShowZone');

Route::post('/AddZone', [App\Http\Controllers\GeoController::class, 'CreateZone'])->name('AddZone');

Route::post('/AddDistrict', [App\Http\Controllers\GeoController::class, 'CreateDistrict'])->name('AddDistrict');

Route::get('/ShowDistrict', [App\Http\Controllers\GeoController::class, 'ShowDistrict'])->name('ShowDistrict');

Route::get('/ShowUnion', [App\Http\Controllers\GeoController::class, 'ShowUnion'])->name('ShowUnion');

Route::post('/AddUnion', [App\Http\Controllers\GeoController::class, 'CreateUnion'])->name('AddUnion');

Route::get('/ShowPanchayat', [App\Http\Controllers\GeoController::class, 'ShowPanchayat'])->name('ShowPanchayat');

Route::post('/AddPanchayat', [App\Http\Controllers\GeoController::class, 'CreatePanchayat'])->name('AddPanchayat');

Route::get('/ShowVillage', [App\Http\Controllers\GeoController::class, 'ShowVillage'])->name('ShowVillage');

Route::post('/AddVillage', [App\Http\Controllers\GeoController::class, 'CreateVillage'])->name('AddVillage');

Route::get('/ShowStreet', [App\Http\Controllers\GeoController::class, 'ShowStreet'])->name('ShowStreet');

Route::post('/AddStreet', [App\Http\Controllers\GeoController::class, 'CreateStreet'])->name('AddStreet');

/*Edit Geo*/

Route::get('/EditState/{Stateid}', [App\Http\Controllers\GeoController::class, 'EditState'])->name('EditState');

Route::get('/EditStateDivision/{StateDivisionid}', [App\Http\Controllers\GeoController::class, 'EditStateDivision'])->name('EditStateDivision');

Route::get('/EditGreaterZone/{GreaterZoneid}', [App\Http\Controllers\GeoController::class, 'EditGreaterZone'])->name('EditGreaterZone');

Route::get('/EditZone/{Zoneid}', [App\Http\Controllers\GeoController::class, 'EditZone'])->name('EditZone');

Route::get('/EditDistrict/{Districtid}', [App\Http\Controllers\GeoController::class, 'EditDistrict'])->name('EditDistrict');

Route::get('/EditUnion/{Unionid}', [App\Http\Controllers\GeoController::class, 'EditUnion'])->name('EditUnion');

Route::get('/EditPanchayat/{Panchayatid}', [App\Http\Controllers\GeoController::class, 'EditPanchayat'])->name('EditPanchayat');

Route::get('/EditVillage/{VillageId}', [App\Http\Controllers\GeoController::class, 'EditVillage'])->name('EditVillage');

Route::get('/EditStreet/{StreetId}', [App\Http\Controllers\GeoController::class, 'EditStreet'])->name('EditStreet');

/*Update Geo */

Route::post('/UpdateState', [App\Http\Controllers\GeoController::class, 'UpdateState'])->name('UpdateState');
Route::post('/UpdateStateDivision', [App\Http\Controllers\GeoController::class, 'UpdateStateDivision'])->name('UpdateStateDivision');
Route::post('/UpdateGreaterZone', [App\Http\Controllers\GeoController::class, 'UpdateGreaterZone'])->name('UpdateGreaterZone');
Route::post('/UpdateZone', [App\Http\Controllers\GeoController::class, 'UpdateZone'])->name('UpdateZone');
Route::post('/UpdateDistrict', [App\Http\Controllers\GeoController::class, 'UpdateDistrict'])->name('UpdateDistrict');

Route::post('/UpdateUnion', [App\Http\Controllers\GeoController::class, 'UpdateUnion'])->name('UpdateUnion');
Route::post('/UpdatePanchayat', [App\Http\Controllers\GeoController::class, 'UpdatePanchayat'])->name('UpdatePanchayat');
Route::post('/UpdateVillage', [App\Http\Controllers\GeoController::class, 'UpdateVillage'])->name('UpdateVillage');
Route::post('/UpdateStreet', [App\Http\Controllers\GeoController::class, 'UpdateStreet'])->name('UpdateStreet');

/*Delete Geo*/

Route::get('/DeleteState', [App\Http\Controllers\GeoController::class, 'DeleteState'])->name('DeleteState');

Route::get('/DeleteStateDivision', [App\Http\Controllers\GeoController::class, 'DeleteStateDivision'])->name('DeleteStateDivision');

Route::get('/DeleteGreaterZone', [App\Http\Controllers\GeoController::class, 'DeleteGreaterZone'])->name('DeleteGreaterZone');

Route::get('/DeleteZone', [App\Http\Controllers\GeoController::class, 'DeleteZone'])->name('DeleteZone');

Route::get('/DeleteDistrict', [App\Http\Controllers\GeoController::class, 'DeleteDistrict'])->name('DeleteDistrict');

Route::get('/DeleteUnion', [App\Http\Controllers\GeoController::class, 'DeleteUnion'])->name('DeleteUnion');

Route::get('/DeletePanchayat', [App\Http\Controllers\GeoController::class, 'DeletePanchayat'])->name('DeletePanchayat');
Route::get('/DeleteVillage', [App\Http\Controllers\GeoController::class, 'DeleteVillage'])->name('DeleteVillage');
Route::get('/DeleteStreet', [App\Http\Controllers\GeoController::class, 'DeleteStreet'])->name('DeleteStreet');

/*FeedBack */

Route::get('/Feedback', [App\Http\Controllers\ComplianceController::class, 'listFeedback'])->name('listfeedback');

/*Volunteer*/

Route::get('/VolunteerList', [App\Http\Controllers\VolunteerController::class, 'ListVolunteer'])->name('list.volunteer');

Route::get('/VolunteerSearch', [App\Http\Controllers\VolunteerController::class, 'VolunteerSearch'])->name('VolunteerSearch');

Route::get('/UpdateVolunteer', [App\Http\Controllers\VolunteerController::class, 'UpdateVolunteer'])->name('update.volunteer');

Route::get('/RemoveVolunteer/{memberId}', [App\Http\Controllers\VolunteerController::class, 'RemoveVolunteer'])->name('remove.volunteer');

/* Notification Broad Cast */

Route::get('/BroadCast', [App\Http\Controllers\NotificationController::class, 'NotificationBroadcast'])->name('list.NotificationBroadcast');

Route::post('/SaveBroadCast', [App\Http\Controllers\NotificationController::class, 'SaveBroadCast'])->name('createNotificationBroadcast');

Route::get('/NotificationBroadCastEdit', [App\Http\Controllers\NotificationController::class, 'NotificationBroadCastEdit'])->name('list.notificationbroadcastedit');

Route::post('/UpdateBroadCast', [App\Http\Controllers\NotificationController::class, 'UpdateBroadCast'])->name('UpdateBroadCast');

/* Notification Group Broad Cast */

Route::get('/showGroupBroadCast', [App\Http\Controllers\NotificationController::class, 'showNotificationGroupBroadcast'])->name('show.NotificationGroupBroadcast');

Route::post('/saveGroupBroadCast', [App\Http\Controllers\NotificationController::class, 'saveNotificationGroupBroadcast'])->name('save.NotificationGroupBroadcast');

Route::get('/editGroupBroadCast', [App\Http\Controllers\NotificationController::class, 'editNotificationGroupBroadcast'])->name('edit.NotificationGroupBroadcast');

Route::post('/updateGroupBroadCast', [App\Http\Controllers\NotificationController::class, 'updateNotificationGroupBroadcast'])->name('update.NotificationGroupBroadcast');

/* Notification Broad Cast */

Route::get('/PollsBroadCast', [App\Http\Controllers\PollsController::class, 'PollsBroadcast'])->name('list.PollsBroadcast');

Route::post('/SavePollsBroadCast', [App\Http\Controllers\PollsController::class, 'SavePollsBroadCast'])->name('SavePollsBroadCast');

Route::get('/PollsBroadCastEdit', [App\Http\Controllers\PollsController::class, 'PollsBroadCastEdit'])->name('list.PollsBroadCastEdit');

Route::post('/PollsUpdateBroadCast', [App\Http\Controllers\PollsController::class, 'PollsUpdateBroadCast'])->name('PollsUpdateBroadCast');

/* Polls Group Broad Cast */

Route::get('/showPollsBroadCast', [App\Http\Controllers\PollsController::class, 'showPollsGroupBroadcast'])->name('show.PollsGroupBroadcast');

Route::post('/savePollsBroadCast', [App\Http\Controllers\PollsController::class, 'savePollsGroupBroadcast'])->name('save.PollsGroupBroadcast');

Route::get('/editPollsBroadCast', [App\Http\Controllers\PollsController::class, 'editPollsGroupBroadCast'])->name('edit.PollsGroupBroadcast');

Route::post('/updatePollsBroadCast', [App\Http\Controllers\PollsController::class, 'updatePollsGroupBroadCast'])->name('update.PollsGroupBroadcast');

Route::get('/LoadStateDivision', [App\Http\Controllers\NotificationController::class, 'LoadStateDivision'])->name('list.LoadStateDivision');

Route::get('/LoadGreaterZones', [App\Http\Controllers\NotificationController::class, 'LoadGreaterZones'])->name('LoadGreaterZones');

Route::get('/LoadZones', [App\Http\Controllers\NotificationController::class, 'LoadZones'])->name('LoadZones');

Route::get('/LoadDistrict', [App\Http\Controllers\NotificationController::class, 'LoadDistrict'])->name('LoadDistrict');

Route::get('/LoadUnion', [App\Http\Controllers\NotificationController::class, 'LoadUnion'])->name('LoadUnion');

Route::get('/LoadPanchayat', [App\Http\Controllers\NotificationController::class, 'LoadPanchayat'])->name('LoadPanchayat');

Route::get('/LoadVillage', [App\Http\Controllers\NotificationController::class, 'LoadVillage'])->name('LoadVillage');

Route::get('/LoadStreet', [App\Http\Controllers\NotificationController::class, 'LoadStreet'])->name('LoadStreet');

Route::post('/UpdateBroadCast', [App\Http\Controllers\NotificationController::class, 'UpdateBroadCast'])->name('UpdateBroadCast');

Route::get('generate-pdf', [App\Http\Controllers\ContributionController::class, 'generatePDF']);

/*Reports */

Route::get('/MembersList', [App\Http\Controllers\ReportsController::class, 'MembersList'])->name('MembersList');

Route::get('/Reports/MembersListView', [App\Http\Controllers\ReportsController::class, 'MembersListView'])->name('MembersListView');

Route::get('/ContributionDetailsSelf', [App\Http\Controllers\ReportsController::class, 'ContributionDetailsSelf'])->name('ContributionDetailsSelf');

Route::get('/OfflineCollection', [App\Http\Controllers\ReportsController::class, 'OfflineCollection'])->name('OfflineCollection');

Route::get('/Reports/ContributionDetailsSelfView', [App\Http\Controllers\ReportsController::class, 'ContributionDetailsSelfView'])->name('ContributionDetailsSelfView');

Route::get('/Reports/OfflineCollectionView', [App\Http\Controllers\ReportsController::class, 'OfflineCollectionView'])->name('OfflineCollectionView');

/* Volunteer Geo */

Route::get('/Volunteer', [App\Http\Controllers\VolunteerController::class, 'Volunteer'])->name('Volunteer');

Route::post('/VolunteerSave', [App\Http\Controllers\VolunteerController::class, 'VolunteerSave'])->name('VolunteerSave');

/*Geo Filter */

Route::get('/ZoneFilter', [App\Http\Controllers\GeoController::class, 'DistrictFilter'])->name('ZoneFilter');

Route::get('/UnionFilter', [App\Http\Controllers\GeoController::class, 'UnionFilter'])->name('UnionFilter');

Route::get('/PanchayatFilter', [App\Http\Controllers\GeoController::class, 'PanchayatFilter'])->name('PanchayatFilter');

Route::get('/VillageFilter', [App\Http\Controllers\GeoController::class, 'VillageFilter'])->name('VillageFilter');

Route::get('/StreetFilter', [App\Http\Controllers\GeoController::class, 'StreetFilter'])->name('StreetFilter');

Route::group(['prefix' => 'Reports'], function () {

    Route::get('/MemberReferal/Members/List/{mobile_number}', [App\Http\Controllers\ReportsController::class, 'ReferalMembersList'])->name('MemberReferal.reports.members.list');

    Route::get('/', [App\Http\Controllers\ReportsController::class, 'ListReports'])->name('list.reports');

    Route::get('/Volunteers', [App\Http\Controllers\ReportsController::class, 'VolunteerReports'])->name('volunteer.reports');

    Route::get('/volunteer/filter', [App\Http\Controllers\ReportsController::class, 'VolunteerReportFilter']);

    Route::get('/DueReports', [App\Http\Controllers\ReportsController::class, 'DueReports'])->name('reports.DueReports');

    Route::get('/MemberDeactivation', [App\Http\Controllers\ReportsController::class, 'MemberDeactivationReports'])->name('reports.MemberDeactivation');

    Route::get('/MemberDeactivation/Filter', [App\Http\Controllers\ReportsController::class, 'MemberDeactivationReportsFilter'])->name('reports.MemberDeactivation.Filter');

    Route::get('/OfflineCollection/Filter', [App\Http\Controllers\ReportsController::class, 'OfflineCollectionReportsFilter'])->name('reports.OfflineCollection.Filter');

    Route::get('/MemberList/Filter', [App\Http\Controllers\ReportsController::class, 'MemberReportsFilter'])->name('reports.MemberList.Filter');

    Route::get('/OnlineCollection/Filter', [App\Http\Controllers\ReportsController::class, 'OnlineCollectionReportsFilter'])->name('reports.OnlineCollection.Filter');

    Route::get('/Subscription/Filter', [App\Http\Controllers\ReportsController::class, 'SubscriptionReportsFilter'])->name('reports.SubscriptionReport.Filter');

    Route::get('/Karyakarthas', [App\Http\Controllers\ReportsController::class, 'KaryakarthaReports'])->name('karyakartha.reports');

    Route::get('/Karyakartha/filter', [App\Http\Controllers\ReportsController::class, 'karyakarthaReportFilter']);

    Route::get('/KaryakarthaProfile/Filter', [App\Http\Controllers\ReportsController::class, 'KaryakarthaProfileReportsFilter'])->name('reports.KaryakarthaProfile.Filter');

    Route::get('/KaryakarthaContribution/Filter', [App\Http\Controllers\ReportsController::class, 'KaryakarthaContributionReportsFilter'])->name('reports.KaryakarthaContribution.Filter');

    Route::get('/MemberReferal', [App\Http\Controllers\ReportsController::class, 'MemberReferalReports'])->name('MemberReferal.reports');

    Route::get('/MemberReferal/Filter', [App\Http\Controllers\ReportsController::class, 'MemberReferalReportsFilter'])->name('reports.MemberReferal.Filter');

});

Route::group(['prefix' => 'ReportsView'], function () {

    Route::get('/', [App\Http\Controllers\ReportsController::class, 'ListReportsView'])->name('list.reportsview');

    Route::get('/Volunteers', [App\Http\Controllers\ReportsController::class, 'VolunteerReportsView'])->name('volunteer.reportsview');

    Route::get('/volunteer/filter', [App\Http\Controllers\ReportsController::class, 'VolunteerReportFilterView']);

    Route::get('/DueReports', [App\Http\Controllers\ReportsController::class, 'DueReportsView'])->name('reports.DueReportsview');

    Route::get('/MemberDeactivation', [App\Http\Controllers\ReportsController::class, 'MemberDeactivationReportsView'])->name('reports.MemberDeactivationview');

    Route::get('/MemberDeactivation/Filter', [App\Http\Controllers\ReportsController::class, 'MemberDeactivationReportsFilterView'])->name('reports.MemberDeactivation.Filterview');

    Route::get('/OfflineCollection/Filter', [App\Http\Controllers\ReportsController::class, 'OfflineCollectionReportsFilterView'])->name('reports.OfflineCollection.Filterview');

    Route::get('/MemberList/Filter', [App\Http\Controllers\ReportsController::class, 'MemberReportsFilterView'])->name('reports.MemberList.Filterview');

    Route::get('/OnlineCollection/Filter', [App\Http\Controllers\ReportsController::class, 'OnlineCollectionReportsFilterView'])->name('reports.OnlineCollection.Filterview');

    Route::get('/Subscription/Filter', [App\Http\Controllers\ReportsController::class, 'SubscriptionReportsFilterView'])->name('reports.SubscriptionReport.FilterView');

    Route::get('/Karyakarthas', [App\Http\Controllers\ReportsController::class, 'KaryakarthaReportsView'])->name('karyakartha.reportsview');

    Route::get('/Karyakartha/filter', [App\Http\Controllers\ReportsController::class, 'karyakarthaReportFilterView']);

    Route::get('/KaryakarthaProfile/Filter', [App\Http\Controllers\ReportsController::class, 'KaryakarthaProfileReportsFilterView'])->name('reports.KaryakarthaProfile.Filterview');

    Route::get('/KaryakarthaContribution/Filter', [App\Http\Controllers\ReportsController::class, 'KaryakarthaContributionReportsFilterView'])->name('reports.KaryakarthaContribution.Filterview');

    Route::get('/MemberReferal', [App\Http\Controllers\ReportsController::class, 'MemberReferalReportsView'])->name('MemberReferal.reportsview');

    Route::get('/MemberReferal/Filter', [App\Http\Controllers\ReportsController::class, 'MemberReferalReportsFilterView'])->name('reports.MemberReferal.Filterview');

});

Route::get('/forgotpassword', [App\Http\Controllers\ReportsController::class, 'forgotpassword']);

/*Member Group */

Route::get('/memberGroup', [App\Http\Controllers\MemberGroupController::class, 'ShowMemberGroup'])->name('list.memberGroup');

Route::get('/AddMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'AddMemberGroup'])->name('add.memberGroup');

Route::POST('/memberGroup', [App\Http\Controllers\MemberGroupController::class, 'SaveMemberGroup'])->name('save.memberGroup');

Route::get('/EditMemberGroup/{memberGroupId}', [App\Http\Controllers\MemberGroupController::class, 'EditMemberGroup'])->name('edit.memberGroup');

Route::post('/UpdateMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'UpdateMemberGroup'])->name('update.memberGroup');

Route::get('/DeleteMemberGroup', [App\Http\Controllers\MemberGroupController::class, 'DeleteMemberGroup'])->name('delete.memberGroup');

Route::get('/GroupMembers/{GroupId}', [App\Http\Controllers\MemberGroupController::class, 'ListGroupMembers'])->name('list.groupMembers');

/*Add Member to Group */
Route::get('/groupMember', [App\Http\Controllers\MemberGroupController::class, 'ShowGroupMember'])->name('add.groupMember');

Route::POST('/groupSingleMember', [App\Http\Controllers\MemberGroupController::class, 'SaveSingleGroupMember'])->name('save.singleGroupMember');

Route::POST('/groupMultiMember', [App\Http\Controllers\MemberGroupController::class, 'SaveMultiGroupMember'])->name('save.multiGroupMember');

Route::get('/groupMemberOnly_delete', [App\Http\Controllers\MemberGroupController::class, 'DeleteGroupMember'])->name('delete.groupMember');

/** Advertisement **/

Route::get('/Advertisements', [App\Http\Controllers\AdvertisementController::class, 'GetAdvertisements'])->name('list.advertisements');

// Route::get('/Notificationsearch', [App\Http\Controllers\NotificationController::class,'Search']);

Route::get('/AddAdvertisements', [App\Http\Controllers\AdvertisementController::class, 'AdvertisementShow'])->name('add.advertisement');

Route::post('/SaveAdvertisements', [App\Http\Controllers\AdvertisementController::class, 'SaveAdvertisement'])->name('save.advertisement');

Route::post('/updateAdvertisement', [App\Http\Controllers\AdvertisementController::class, 'UpdateAdvertisement'])->name('update.advertisement');

Route::get('/AdEdit/{Advertisement}', [App\Http\Controllers\AdvertisementController::class, 'editAdvertisement'])->name('edit.advertisement');

Route::get('/AdMassDelete', [App\Http\Controllers\AdvertisementController::class, 'TruncateAdvertisement'])->name('truncate.notification');

Route::get('/adonly_delete', [App\Http\Controllers\AdvertisementController::class, 'DeleteAdvertisement'])->name('delete.advertisement');

// Route::post('/NotificationApproval', [App\Http\Controllers\NotificationController::class, 'NotificationApproval']);

/* Advertisement Broad Cast */

Route::get('/AdBroadcast', [App\Http\Controllers\AdvertisementController::class, 'AdvertisementBroadcast'])->name('list.AdvertisementBroadcast');

Route::post('/SaveAdBroadCast', [App\Http\Controllers\AdvertisementController::class, 'SaveAdBroadCast'])->name('save.AdBroadcast');

Route::get('/AdBroadCastEdit', [App\Http\Controllers\AdvertisementController::class, 'AdvertisementBroadCastEdit'])->name('list.advertisementbroadcastedit');

Route::post('/UpdateAdBroadCast', [App\Http\Controllers\AdvertisementController::class, 'UpdateAdBroadCast'])->name('UpdateAdBroadCast');

/*MemberCategory */

Route::get('/MemberCategory', [App\Http\Controllers\WebApplicationController::class, 'ListMemberCategory'])->name('MemberCategory.list');

Route::get('/MemberCategory/Add', [App\Http\Controllers\WebApplicationController::class, 'AddMemberCategory'])->name('MemberCategory.Add');

Route::post('/MemberCategory', [App\Http\Controllers\WebApplicationController::class, 'StoreMemberCategory'])->name('MemberCategory.Store');

Route::get('/MemberCategory/Edit/{CategoryId}', [App\Http\Controllers\WebApplicationController::class, 'EditMemberCategory'])->name('MemberCategory.Edit');

Route::post('/MemberCategory/Update', [App\Http\Controllers\WebApplicationController::class, 'UpdateMemberCategory'])->name('MemberCategory.Update');

Route::get('/MemberCategory/Assign/{CategoryId}', [App\Http\Controllers\WebApplicationController::class, 'AssignAppIcon'])->name('Assign.MemberCategory.Edit');

Route::post('/MemberCategory/Assign', [App\Http\Controllers\WebApplicationController::class, 'UpdateAppIconMemberCategory'])->name('Assign.MemberCategory.Update');

Route::get('/MemberCategory/Delete/{CategoryId}', [App\Http\Controllers\WebApplicationController::class, 'DeleteMemberCategory'])->name('MemberCategory.Delete');

Route::get('/MemberPending/List', [App\Http\Controllers\MembersController::class, 'ListMemberPending'])->name('MemberPending.list');

Route::get('/MemberPending/Filter', [App\Http\Controllers\MembersController::class, 'MemberPendingFilter'])->name('MemberPending.Filter');

Route::post('/UpdateMemberApproval', [App\Http\Controllers\MembersController::class, 'UpdateMemberApprovalPending'])->name('MemberApproval.Update');

Route::get('/ReportsView/Subscription', [App\Http\Controllers\SubscriptionController::class, 'SubscriptionReportView'])->name('Subscription.reportsview');

Route::get('/Reports/Subscription', [App\Http\Controllers\SubscriptionController::class, 'SubscriptionReport'])->name('Subscription.reports');

Route::get('/ReportsView/SubscriptionDefaulter', [App\Http\Controllers\SubscriptionController::class, 'SubscriptionDefaulterReportView'])->name('SubscriptionDefaulter.reportsview');

Route::get('/Reports/SubscriptionDefaulter', [App\Http\Controllers\SubscriptionController::class, 'SubscriptionDefaulterReport'])->name('SubscriptionDefaulter.reports');

Route::group(['prefix' => 'political/category'], function () {

    Route::get('/list', [App\Http\Controllers\PoliticalCategoryController::class, 'listCategory'])->name('list.political.category');

    Route::get('/Parliament/Add', [App\Http\Controllers\PoliticalCategoryController::class, 'AddParliament'])->name('add.Parliament');

    Route::post('/Parliament/Save', [App\Http\Controllers\PoliticalCategoryController::class, 'SaveParliament'])->name('Save.Parliament');

    Route::get('/Parliament/Edit/{ParliamentId}', [App\Http\Controllers\PoliticalCategoryController::class, 'EditParliament'])->name('Edit.Parliament');

    Route::post('/Parliament/Update', [App\Http\Controllers\PoliticalCategoryController::class, 'UpdateParliament'])->name('Update.Parliament');

    Route::get('/Parliament/Delete', [App\Http\Controllers\PoliticalCategoryController::class, 'DeleteParliament'])->name('Delete.Parliament');

    Route::get('/LoadWard', [App\Http\Controllers\PoliticalCategoryController::class, 'LoadWard'])->name('LoadWard');

    /*  Assembly routes ******/

    Route::get('/Assembly/Add', [App\Http\Controllers\PoliticalCategoryController::class, 'AddAssembly'])->name('add.Assembly');

    Route::post('/Assembly/Save', [App\Http\Controllers\PoliticalCategoryController::class, 'SaveAssembly'])->name('Save.Assembly');

    Route::get('/Assembly/Edit/{AssemblyId}', [App\Http\Controllers\PoliticalCategoryController::class, 'EditAssembly'])->name('Edit.Assembly');

    Route::post('/Assembly/Update', [App\Http\Controllers\PoliticalCategoryController::class, 'UpdateAssembly'])->name('Update.Assembly');

    Route::get('/Assembly/Delete', [App\Http\Controllers\PoliticalCategoryController::class, 'DeleteAssembly'])->name('Delete.Assembly');

    /*  Ward routes ******/

    Route::get('/Ward/Add', [App\Http\Controllers\PoliticalCategoryController::class, 'AddWard'])->name('add.Ward');

    Route::post('/Ward/Save', [App\Http\Controllers\PoliticalCategoryController::class, 'SaveWard'])->name('Save.Ward');

    Route::get('/Ward/Edit/{WardId}', [App\Http\Controllers\PoliticalCategoryController::class, 'EditWard'])->name('Edit.Ward');

    Route::post('/Ward/Update', [App\Http\Controllers\PoliticalCategoryController::class, 'UpdateWard'])->name('Update.Ward');

    Route::get('/Ward/Delete', [App\Http\Controllers\PoliticalCategoryController::class, 'DeleteWard'])->name('Delete.Ward');

    /*  Booth Agent routes ******/

    Route::get('/BoothAgent/Add', [App\Http\Controllers\PoliticalCategoryController::class, 'AddBoothAgent'])->name('add.BoothAgent');

    Route::post('/BoothAgent/Save', [App\Http\Controllers\PoliticalCategoryController::class, 'SaveBoothAgent'])->name('Save.BoothAgent');

    Route::get('/BoothAgent/Edit/{BoothAgentId}', [App\Http\Controllers\PoliticalCategoryController::class, 'EditBoothAgent'])->name('Edit.BoothAgent');

    Route::post('/BoothAgent/Update', [App\Http\Controllers\PoliticalCategoryController::class, 'UpdateBoothAgent'])->name('Update.BoothAgent');

    Route::get('/BoothAgent/Delete', [App\Http\Controllers\PoliticalCategoryController::class, 'DeleteBoothAgent'])->name('Delete.BoothAgent');

    /*  Booth routes ******/

    Route::get('/Booth/Add', [App\Http\Controllers\PoliticalCategoryController::class, 'AddBooth'])->name('add.Booth');

    Route::post('/Booth/Save', [App\Http\Controllers\PoliticalCategoryController::class, 'SaveBooth'])->name('Save.Booth');

    Route::get('/Booth/Edit/{BoothId}', [App\Http\Controllers\PoliticalCategoryController::class, 'EditBooth'])->name('Edit.Booth');

    Route::post('/Booth/Update', [App\Http\Controllers\PoliticalCategoryController::class, 'UpdateBooth'])->name('Update.Booth');

    Route::get('/Booth/Delete', [App\Http\Controllers\PoliticalCategoryController::class, 'DeleteBooth'])->name('Delete.Booth');

});

Route::group(['prefix' => 'religious'], function () {

    Route::get('/', [App\Http\Controllers\ReligiousController::class, 'listReligiousLeader'])->name('list.Religious');

    Route::get('/Add', [App\Http\Controllers\ReligiousController::class, 'AddReligiousLeader'])->name('add.Religious');

    Route::post('/Save', [App\Http\Controllers\ReligiousController::class, 'SaveReligiousLeader'])->name('Save.Religious');

    Route::get('/Edit/{ReligiousId}', [App\Http\Controllers\ReligiousController::class, 'EditReligiousLeader'])->name('Edit.Religious');

    Route::post('/Update', [App\Http\Controllers\ReligiousController::class, 'UpdateReligiousLeader'])->name('Update.Religious');

    Route::get('/Delete', [App\Http\Controllers\ReligiousController::class, 'DeleteReligiousLeader'])->name('Delete.Religious');

});

Route::group(['prefix' => 'caste'], function () {

    Route::get('/', [App\Http\Controllers\CasteController::class, 'listCasteLeader'])->name('list.Caste');

    Route::get('/Add', [App\Http\Controllers\CasteController::class, 'AddCasteLeader'])->name('add.Caste');

    Route::post('/Save', [App\Http\Controllers\CasteController::class, 'SaveCasteLeader'])->name('Save.Caste');

    Route::get('/Edit/{CasteId}', [App\Http\Controllers\CasteController::class, 'EditCasteLeader'])->name('Edit.Caste');

    Route::post('/Update', [App\Http\Controllers\CasteController::class, 'UpdateCasteLeader'])->name('Update.Caste');

    Route::get('/Delete', [App\Http\Controllers\CasteController::class, 'DeleteCasteLeader'])->name('Delete.Caste');

});

Route::group(['prefix' => 'party'], function () {

    Route::get('/', [App\Http\Controllers\PartyLeaderController::class, 'listPartyLeader'])->name('list.Party');

    Route::get('/Add', [App\Http\Controllers\PartyLeaderController::class, 'AddPartyLeader'])->name('add.Party');

    Route::post('/Save', [App\Http\Controllers\PartyLeaderController::class, 'SavePartyLeader'])->name('Save.Party');

    Route::get('/Edit/{PartyId}', [App\Http\Controllers\PartyLeaderController::class, 'EditPartyLeader'])->name('Edit.Party');

    Route::post('/Update', [App\Http\Controllers\PartyLeaderController::class, 'UpdatePartyLeader'])->name('Update.Party');

    Route::get('/Delete', [App\Http\Controllers\PartyLeaderController::class, 'DeletePartyLeader'])->name('Delete.Party');

});
=======

Route::get('/clear', function () {
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
echo "done";
});
// MEMBER Restriction

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Auth::routes();

//reports section
//last year
Route::get('/home', 'HomeControllers@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    
 Route::get('totalMembers/{type}', 'XlsxController@total_members');   
 
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

// AOS
Route::get('/aos_details', 'AosController@index');
Route::get('/add_aos', 'AosController@show');
Route::post('/add_aos', 'AosController@store');

Route::get('/aos_edit/{id}', 'AosController@edit');
Route::post('/aos_update','AosController@update');
Route::get('/aos_delete/{id}','AosController@destroy');

Route::get('/feedback_details', 'ZoneController@feedback');


// Notification Receipient 
Route::get('/add_nreceipt', 'NreceiptController@show');
Route::post('/add_nreceipt', 'NreceiptController@store');

Route::get('/notification_receipt_edit/{id}', 'NreceiptController@edit');
Route::post('/notification_receipt_update','NreceiptController@update');

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


// Polls Receipient
Route::get('/add_pollreceipt', 'PollreceiptController@show');
Route::post('/add_pollreceipt', 'PollreceiptController@store');

Route::get('/poll_receipt_edit/{id}', 'PollreceiptController@edit');
Route::post('/poll_receipt_update','PollreceiptController@update');

//Referral reports
Route::get('/reports', 'ReportsController@index');
Route::get('/referral_reports','ReportsController@referral_reports');


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


// Get active member list for volunteer assignment

Route::get('getMember', 'ZoneController@getMember');
Route::get('getMemberByMobile', 'RolesController@getMemberByMobile');
Route::get('getMemberByMemberId', 'RolesController@getMemberByMemberId');

Route::get('/user_roles_assign', 'MemberController@user_roles_assign');
Route::post('/roll_assignment', 'MemberController@roll_assignment');
Route::get('/member_details', 'MemberController@member_details');
Route::get('/membersearch', 'MemberController@membersearch');
Route::get('/notification_mass_delete', 'NotificationController@notification_mass_delete_index');
Route::post('/notification_mass_delete', 'NotificationController@notification_mass_delete');

Route::get('/advertisement_mass_delete', 'AdvertisementController@advertisement_mass_delete_index');
Route::post('/advertisement_mass_delete', 'AdvertisementController@advertisement_mass_delete');

Route::get('/poll_mass_delete', 'PollquestionController@poll_mass_delete_index');
Route::post('/poll_mass_delete', 'PollquestionController@poll_mass_delete');

Route::get('/aos_mass_delete', 'AosController@aos_mass_delete_index');
Route::post('/aos_mass_delete', 'AosController@aos_mass_delete');

Route::get('/volunteer_approval/{id}', 'ZoneController@volunteer_approval');
Route::post('/volunteer_approval_update', 'ZoneController@volunteer_approval_update');
Route::get('/volunteer_destroy/{id}','ZoneController@volunteer_destroy');

//xlsx file export
Route::get('/lastmonth_ads_xlsx','XlsxController@lastmonth_ads');
Route::get('/lastmonth_members_xlsx','XlsxController@lastmonth_members');
Route::get('/lastmonth_notifications_xlsx','XlsxController@lastmonth_notifications');
Route::get('/lastmonth_polls_xlsx','XlsxController@lastmonth_polls');

Route::get('/lastyear_ads_xlsx','XlsxController@lastyear_ads');
Route::get('/lastyear_members_xlsx','XlsxController@lastyear_members');
Route::get('/lastyear_notifications_xlsx','XlsxController@lastyear_notifications');
Route::get('/lastyear_polls_xlsx','XlsxController@lastyear_polls');

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

Route::get('getMemberByMobile1', 'MemberController@getMemberByMobile1');
Route::get('getMemberByMemberId1', 'MemberController@getMemberByMemberId1');



Route::get('/userAdd', 'ImportController@userAdd');
Route::post('/userAdd', 'ImportController@userAddPost');


// Donations
Route::get('/donation_details', 'DonationController@index');
Route::get('/add_donation', 'DonationController@show');
Route::post('/add_donation', 'DonationController@store');
Route::get('/donation_edit/{id}', 'DonationController@edit');
Route::post('/donation_update','DonationController@update');
Route::get('/donation_delete/{id}','DonationController@destroy');
Route::get('/getkeyvalue','DonationController@getkeyvalue');



// Sanadhanam
Route::get('/sanadhanam_details', 'SanadhanamController@index');
Route::get('/add_sanadhanam', 'SanadhanamController@show');
Route::post('/add_sanadhanam', 'SanadhanamController@store');
Route::get('/sanadhanam_edit/{id}', 'SanadhanamController@edit');
Route::post('/sanadhanam_update','SanadhanamController@update');
Route::get('/sanadhanam_delete/{id}','SanadhanamController@destroy');


// Shopping
Route::get('/shopping_details', 'ShoppingController@index');
Route::get('/add_shopping', 'ShoppingController@show');
Route::post('/add_shopping', 'ShoppingController@store');
Route::get('/shopping_edit/{id}', 'ShoppingController@edit');
Route::post('/shopping_update','ShoppingController@update');
Route::get('/shopping_delete/{id}','ShoppingController@destroy');



Route::get('/memberIdFormat','MemberIdFormatController@index');
Route::get('/memberIdFormatEdit/{id}','MemberIdFormatController@edit');
Route::post('/memberIdFormatPost','MemberIdFormatController@update');



Route::get('/category','DonationController@category');
Route::get('/addCategory','DonationController@addCategory');
Route::get('/addSubCategory','DonationController@addSubCategory');
Route::post('/addCategory','DonationController@addCategoryPost');
Route::post('/addSubCategory','DonationController@addSubCategoryPost');


Route::get('/categoryDelete/{id}','DonationController@categoryDelete');


Route::get('/categoryEdit/{id}', 'DonationController@categoryEdit');
Route::post('/categoryUpdate','DonationController@categoryUpdate');









Route::post('/AjaxApproveNotif/{id}', 'NotificationController@AjaxApprove');

Route::post('/AjaxApproveAdver/{id}', 'AdvertisementController@AjaxApprove');

Route::post('/AjaxApproveAos/{id}', 'AosController@AjaxApprove');








});
>>>>>>> main
