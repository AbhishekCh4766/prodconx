<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/clear-cache', function() {
    //$exitCode = Artisan::call('cache:clear');
    // return what you want
    dd(env('MAIL_HOST'));
});


Route::get('/', 'UserController@login');
Route::get('/register','UserController@register');

/****** Admin ********/

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/admin', 'HomeController@index');
Route::get('/logout', 'HomeController@logout');
Route::post('check', 'HomeController@check');
/********** Gender ************/

Route::get('/Gender', 'HomeController@Gender');
Route::get('/addGender', 'HomeController@addGender');
Route::post('/storeGender', 'AdminGenderController@store');
Route::post('/updateGender/{id}', 'AdminGenderController@update');
Route::get('/showGender/{id}', 'AdminGenderController@show');

/******************* Gender End Here **************/

/*************** User ******************/

Route::get('/usersList', 'HomeController@userList');
Route::get('/deleteUser/{id}', 'HomeController@deleteUser');
Route::get('/usersType', 'HomeController@usersType');
Route::get('/showUser/{id}', 'HomeController@show');
Route::post('/updateUser/{id}', 'HomeController@update');
Route::post('/myProfile', 'UserController@MyProfile');
Route::get('/getMyProfile', 'UserController@getMyProfile');

/********* User End Here ************/


/************* Email Templates ********/

Route::resource('emailTemplates','EmailController');
/* Route::get('/emailTemplates', 'EmailController@index');

Route::get('/addEmailTemplate', 'EmailController@create');

Route::get('/storeEmailTemplate','EmailController@store');*/
Route::get('/showEmailTemplate/{id}','EmailController@show');
Route::post('/editEmailTemplate/{id}','EmailController@update'); 

/********* Email Templates End Here ************/

/************* Content ********/

Route::resource('contents','ContentController');
Route::get('/content', 'ContentController@index');
Route::get('/addContent', 'ContentController@create');
Route::post('/storContent','ContentController@store'); 
Route::get('/showContent/{id}','ContentController@show'); 
Route::post('/editContent/{id}','ContentController@update'); 

/********* Content End Here ************/

/********* Settings Start Here ***********/

Route::get('/Settings', 'SettingsController@index');
Route::post('/editSettings', 'SettingsController@store'); 
Route::get('/mailSettings', 'SettingsController@mailMethod');
Route::post('/editmailSettings', 'SettingsController@mailstore'); 
Route::get('/socialSettings', 'SettingsController@social');
Route::post('/editsocialSettings', 'SettingsController@socialstore'); 
Route::get('/imageSettings', 'SettingsController@image');
Route::post('/editimageSettings', 'SettingsController@imagestore'); 
/********* Settings Ends Here ***********/ 


/*********** Membership Start Here *********/

Route::get('/membership', 'MembershipController@index');
Route::get('/addMembership', 'MembershipController@create');
Route::post('/storMembership','MembershipController@store'); 
Route::get('/showMembership/{id}','MembershipController@show'); 
Route::post('/editMembership/{id}','MembershipController@update'); 

/************ Membership Ends Here *********/

/********* DepartmentController start here **********/

Route::get('/department', 'DepartmentController@index');
Route::get('showDepartment/{id}','DepartmentController@show');
Route::post('updateDepartment','DepartmentController@update');
Route::get('addDepartments','DepartmentController@add');
Route::post('createDepartment','DepartmentController@createDepartment');
Route::get('departmentRoles','DepartmentController@departmentRoles');
Route::get('addRoles','DepartmentController@addRoles');
Route::post('createDepartmentRoles','DepartmentController@createDepartmentRoles');
Route::get('editDepartmentRole/{id}','DepartmentController@editDepartmentRole');
Route::post('updateDepartmentRoles','DepartmentController@updateDepartmentRoles');


/********* DepartmentController ends here **********/

Route::get('/login', 'UserController@login');
Route::post('/store', 'UserController@store');
Route::get('/userPanel/{id}', 'UserController@show');
Route::get('/userLogout', 'UserController@logout');
Route::get('/signup', 'UserController@signup');
Route::post('/UserDashboard', 'UserController@check_user');
Route::any('/userDashboard', 'UserController@dashboard');
Route::get('user/{username}', 'UserController@userProfile');
Route::get('/plans', 'UserController@index');
Route::get('/getservice/{username}/{id}', 'UserController@showService');
/***** User Payment Start Here *********/

Route::get('/checkout/{id}', 'UserController@checkout');
Route::get('cancelUrl', 'PaymentController@cancelUrl');
Route::get('returnUrl', 'PaymentController@getSuccessPayment');
Route::get('payment/{id}', 'PaymentController@postPayment');

/******** User Payment Ends Here ********/


/******** User order Start Here ******/


Route::get('userOrder', 'UserOrderController@index');
Route::get('userOrderCancel', 'UserOrderController@cancel');

/***************** User Order End here **********/


/****** Order **********/

Route::get('/order', 'OrderController@index');
Route::get('/showOrder/{id}', 'OrderController@show');

/******** Friend request ***********/

Route::get('/request', 'FriendRequestController@index');
Route::post('/searchResult', 'FriendController@getSearchData');
Route::get('/searchResult', 'FriendController@index');
Route::get('/friendRequest/{id}', 'FriendRequestController@sendFriendrequest');
Route::post('genre', 'FriendRequestController@sendFriendrequest');
Route::get('getFriend', 'FriendRequestController@getFriendList');
Route::get('getPendingFriend', 'FriendRequestController@getPendingList');
Route::get('getBlockFriend', 'FriendRequestController@getBlockList');
Route::get('getDeclineFriend', 'FriendRequestController@getDeclineList');
Route::post('pending', 'FriendRequestController@pendingActive');
Route::post('block', 'FriendRequestController@blockActive');
Route::post('againFriend', 'FriendRequestController@friendActive');

/******** Post Controller *************/

Route::post('post', 'PostController@store');
Route::post('postData', 'PostController@postData');
Route::post('postComment', 'PostController@postComment');
Route::post('postLike', 'PostController@postLike');
Route::post('allLikePost', 'PostController@allLikePost');

/*********** Project Controller ************/

Route::get('projects', 'ProjectController@index')->middleware('loggedin');
Route::post('addprojects', 'ProjectController@store');
Route::post('geteditProject', 'ProjectController@geteditProject');
Route::post('editprojects/{id}', 'ProjectController@editprojects');
Route::post('deleteProject', 'ProjectController@deleteProject');
Route::post('deleteprojects/{id}', 'ProjectController@deleteprojects');

/****** Profile ***********/

Route::get('profile', 'ProfileController@index')->middleware('loggedin')->name('user.profile');
Route::get('profile_experience', 'ProfileController@experience')->middleware('loggedin')->name('user.experience');
Route::get('profile_education', 'ProfileController@education')->middleware('loggedin')->name('user.education');
Route::get('profile_skills', 'ProfileController@skills')->middleware('loggedin')->name('user.skills');
Route::get('edit_service/{id}','ProfileController@editService')->name('user.editservice');
Route::get('delete_exp/{id}','ProfileController@deleteExp');
Route::get('edit_exp/{id}','ProfileController@editExp');

Route::get('delete_education/{id}','ProfileController@deleteEducation');
Route::get('edit_education/{id}','ProfileController@editEducation');
Route::get('edit_skills/{id}','ProfileController@editSkills');

Route::get('delete_skills/{id}','ProfileController@deleteSkills');
Route::get('delete_service/{id}','ProfileController@deleteService');
Route::get('profile_services','ProfileController@profileServices')->middleware('loggedin')->name('user.services');
Route::post('updateService','ProfileController@updateService');
Route::post('addService','ProfileController@storeService');
Route::post('updateProfile', 'ProfileController@store');
Route::post('addExperience', 'ProfileController@addexperience');
Route::post('editExperience/{id}', 'ProfileController@editExperience');
Route::post('editEducation/{id}', 'ProfileController@editEducationdata');

Route::post('addEducation', 'ProfileController@addeducation');
Route::post('addSkills', 'ProfileController@addskills');
Route::post('editSkill/{id}', 'ProfileController@editskilldata');


/********* Friend ***************/

Route::get('friend', 'FriendController@index')->middleware('loggedin');
/********** Project Contact **************/

Route::get('team/{id}', 'ProjectController@addContact')->middleware('loggedin');
Route::post('/savemember','ProjectController@savemember'); 
Route::post('/deleteContact','ProjectController@deleteContact'); 
Route::post('deletecontact/{id}', 'ProjectController@deletecontactval');
Route::post('/geteditcontact','ProjectController@geteditcontact'); 
Route::post('editcontact/{id}', 'ProjectController@editcontact');
Route::post('editprojectDetails', 'ProjectController@editprojectDetails');
Route::get('projectContacts/{id}','ProjectController@projectContacts')->middleware('loggedin');
Route::post('projectContacts/getContact','ProjectController@getContact')->middleware('loggedin');

Route::any('deleteprojectcontact/{id?}/{pro_id?}','ProjectController@deleteprojectcontact');

/*********** Role **************/

Route::get('role', 'RoleController@index');
Route::get('role/create', 'RoleController@create');
Route::post('roleCreate', 'RoleController@store');
Route::get('editRole/{id}', 'RoleController@show');
Route::post('/editRoleTemplate/{id}','RoleController@update'); 

/*********** Package ***********/
Route::get('package', 'PackageController@index')->middleware('loggedin');
Route::get('history','PackageController@paymentHistory')->middleware('loggedin');

/****** Notification *******/

Route::post('/getnotify', 'NotificationController@index');

/*********** Get Friend List *************/

Route::get('/friends/{id}' , 'FriendListController@index')->middleware('loggedin');
Route::get('/chat' , 'FriendListController@message')->middleware('loggedin');
Route::post('savechat','FriendListController@savechat');
Route::post('getLastmage','FriendListController@getLastmage');

/********* Call Sheet ************/

Route::get('callsheet','CallSheetController@index')->middleware('loggedin');
Route::post('savecallsheet','CallSheetController@savecallsheet');
Route::post('editcallSheetDetails','CallSheetController@editcallSheet');
Route::post('deletecallSheet','CallSheetController@deletecallSheet');
Route::post('deletecallSheetVal/{id}','CallSheetController@deletecallSheetVal');
Route::get('sendPreviewCallsheet','MyEventController@sendPreviewCallsheet');

Route::get('addCallsheet/{id}','CallSheetController@addCallsheet')->middleware('loggedin');
Route::get('addcontacts/{id}/{callsheet_id}','CallSheetController@addContact')->middleware('loggedin');

/* Location  Callsheet */
Route::get('addlocations/{id}/{callsheet_id}','CallSheetController@addlocations')->middleware('loggedin');
Route::post('addlocationCallsheet','CallSheetController@addlocationCallsheet');
Route::get('updateLocationCallsheet/{team_id}/{callsheet_id}','CallSheetController@updateLocationCallsheet');
Route::post('updatelocationCall','CallSheetController@updatelocationCall');


/* New project contact */
Route::post('newprojectcontact','CallSheetController@newprojectcontact');

/*****************/
Route::get('callsheet_notification/{callsheet_id}/{team_id}', 'CallSheetController@callsheet_notification');
Route::get('viewcallsheet/{callsheet_id}/{team_id}', 'CallSheetController@viewcallsheet');
Route::post('addcallsheetdata','CallSheetController@addcallsheetdata')->middleware('loggedin');
Route::get ('getCallsheetDatas/{callsheet_id}/{team_id}','CallSheetController@getCallsheet');
Route::post ('updatecallsheet/{callsheet_id}/{team_id}','CallSheetController@updatecallsheet');
Route::get ('deletegrtcallsheets/{team_id}/{callsheet_id}','CallSheetController@deletegrtcallsheets');

Route::post('addContactCallsheet','CallSheetController@addContactCallsheet');
Route::post('updateContactCallsheet','CallSheetController@updateContactCallsheet');

Route::get('updateCallData/{team_id}/{callsheet_id}','CallSheetController@updateCallData');

Route::get('addScheduleCallsheet/{project_id}/{callsheet_id}','CallSheetController@schedule');
Route::get('updateScheduleCallsheet/{project_id}/{callsheet_id}','CallSheetController@updateSchedule');
Route::post('addScheduleToCallsheet','CallSheetController@scheduleSave');
Route::post('updateScheduleToCallsheet','CallSheetController@updateScheduleToCallsheet');


/********** CallSheet Contacts **********/

Route::get('contacts/{id}','CallSheetController@contacts')->middleware('loggedin');
Route::post('geteditcontactcallsheet','CallSheetController@geteditcontactcallsheet');
Route::post('savecallsheetmember','CallSheetController@savecallsheetmember');
Route::get('project/{id}','ProjectController@project')->middleware('loggedin');
Route::post('deletecallsheetcontactval', 'CallSheetController@deletecallsheetcontactval');
Route::post('deletecallSheetMember', 'CallSheetController@deletecallSheetMember');
Route::get('getfriends', 'ProjectController@getfriends')->middleware('loggedin');
Route::any('/removecallsheetcontact/{id}/{callsheet_id}', 'ProjectController@removecallsheetcontact');

/********** CallSheet mail *************/
Route::get('here', 'MyEventController@test');
Route::post('mailSend', 'MyEventController@sendEmail');
Route::get('confrim/{id}/{user_id}', 'MyEventController@confirmCallsheet')->middleware('loggedin');
Route::get('viewConfirm', 'MyEventController@viewConfirm')->middleware('loggedin');
Route::post('callsheetConfirm', 'MyEventController@callsheetConfirm');
Route::get('pendingCallsheet', 'MyEventController@pendingCallsheet')->middleware('loggedin');
Route::get('confirmCallsheet', 'MyEventController@GetconfirmCallsheet')->middleware('loggedin');
Route::get('viewcallsheet', 'MyEventController@viewcallsheet')->middleware('loggedin');


/********* User verification *******/

Route::get('verify/{id}', 'MyEventController@verify');

/******* Forgot Password *************/

Route::get('forgotpassword', 'ForgotController@index')->name('user.forget');
Route::post('getPassword','ForgotController@getPassword');
Route::get('newpassword/{random}/{id}','ForgotController@newpassword');
Route::post('updatepassword','ForgotController@updatepassword');

/********** Department For User ****************/

Route::post('getdeptRole','ProjectController@getdeptRole');

/******* Admin job category routes **************/

Route::get('jobCategory', 'JobCatController@index');
Route::get('jobCategory/create', 'JobCatController@create');
Route::post('saveJobCat', 'JobCatController@save');
Route::get('showJobCat/{id}','JobCatController@edit');
Route::post('updateJobCat/{id}','JobCatController@update');
Route::get('joblisting','JobCatController@joblisting');
Route::get('joblistingedit/{id}','JobCatController@joblistingedit');
Route::post('joblisting/{id}','JobCatController@updatejoblisting');
/******** Job Module for front-end ***************/

Route::get('job', 'JobListingController@index')->middleware('loggedin');
Route::get('editjob/{id}', 'JobListingController@editjob')->middleware('loggedin');
Route::post('saveJob','JobListingController@saveJob');
Route::post('updatejob/{id}','JobListingController@updatejob');
Route::get('jobListing','JobListingController@jobListing')->middleware('loggedin');
Route::get('myJobListing','JobListingController@myJobListing')->middleware('loggedin');
Route::post('deleteJob','JobListingController@deleteJob');
Route::post('deleteMyJob','JobListingController@deleteMyJob');
Route::get('viewJob/{id}','JobListingController@viewJob')->middleware('loggedin');
Route::post('searchJobs','JobListingController@searchJobs');
Route::post('searchJobsByCat','JobListingController@searchJobsByCat');
/************ Rental Job *************/

Route::get('rentalJob', 'RentalJobController@rentalJob')->middleware('loggedin');
Route::post('saveRental', 'RentalJobController@saveRental')->middleware('loggedin');
Route::get('RentalJobListing', 'RentalJobController@RentalJobListing')->middleware('loggedin');
Route::get('viewRental/{id}', 'RentalJobController@viewRental')->middleware('loggedin');
Route::get('myRentalJob', 'RentalJobController@myRentalJob')->middleware('loggedin');
Route::post('searchRental','RentalJobController@searchRental');

/************* Company Follow **************/

Route::get('companies', 'FriendController@companies')->middleware('loggedin');
Route::post('/searchCompany', 'FriendController@getSearchCompany');
Route::get('/searchCompany', 'FriendController@companies');
Route::post('companyfollow', 'FriendRequestController@companyfollow');
Route::post('unfollowCompany','FriendRequestController@unfollowCompany');

/******extra *******/

Route::get('form', function(){
 return view('users.file');
});
	
Route::post('/file', 'FileController@index');
Route::get('mail', 'PaymentController@sendEmail');

/*New Routes*/

/************* MyContact **************/
Route::get('contact', 'ContactController@index')->middleware('loggedin');

Route::post('geteditusercontact','ContactController@geteditusercontact');
Route::post('saveUserContact','ContactController@saveUserContact')->middleware('loggedin');
Route::get('deleteUserContact/{id}','ContactController@deleteUserContact')->middleware('loggedin');
Route::post('edituserContact','ContactController@edituserContact')->middleware('loggedin');

/************* Location **************/
Route::get('location/{id}', 'LocationController@index')->middleware('loggedin');
Route::get('location/{id}', 'LocationController@show')->middleware('loggedin');
Route::post('getedituserlocation','LocationController@getedituserlocation');
Route::post('saveUserlocation/{id}','LocationController@saveUserlocation')->middleware('loggedin');
Route::get('deleteUserlocation/{id}','LocationController@deleteUserlocation')->middleware('loggedin');
Route::post('edituserlocation','LocationController@edituserlocation')->middleware('loggedin');
Route::post('location/updateLocationData','LocationController@updateLocationData')->middleware('loggedin');

// Route::get('addlocations/{id}','LocationController@addlocations')->middleware('loggedin');
// Route::get('viewlocations/{id}/{team_id}', 'LocationController@viewlocations');

Route::post('shareJobById','JobListingController@sharejob');
Route::post('jobpostComment','JobListingController@jobpostComment');
Route::post('getnotificationusername','MyEventController@getnotificationusername');