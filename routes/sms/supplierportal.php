<?php


Route::get('approval-progress', 'SupplierPortal\FrontController@checkApprovalProgress');
Route::post('validate-email', 'SupplierPortal\FrontController@validateEmail')->name('validate.email');
Route::post('validate-vendor', 'SupplierPortal\FrontController@validateVendor')->name('validate.vendor');

Route::prefix('sp')->group(function () {

	Route::get('/', function(){
		return redirect(route('sp.login'));
	});

	Route::get('/supplier-portal', function() {
       return redirect(route('sp.login'));
   	});

   	Route::get('/becoming-a-supplier', function() {
       return redirect(route('sp.login'));
   	});

    Route::get('/register', 'SupplierPortal\FrontController@register')->name('sp.register');
    Route::get('/login', 'SupplierPortal\FrontController@login')->name('sp.login');
    
    Route::post('/submit-registration', 'SupplierPortal\FrontController@submit_registration')->name('sp.submit-registration');

	Route::group(['middleware' => 'authenticated' ], function() {    

	    Route::get('/update-profile', 'SupplierPortal\Supplier\SupplierProfileController@edit')->name('sms.auth.profile.edit');
		Route::get('/permanent-supplier-form', 'SupplierPortal\Supplier\SupplierProfileController@permanentProfile')->name('sms.auth.profile.permanent');

	    Route::patch('/update-profile', 'SupplierPortal\Supplier\SupplierProfileController@update')->name('sms.auth.profile.update');    
	    Route::get('/submit-to-approver/{supplier}', 'SupplierPortal\Supplier\SupplierProfileController@submit_to_approver')->name('sms.auth.profile.submit');

	    Route::post('/request-update-sections', 'SupplierPortal\Supplier\SupplierProfileController@requestUpdateSection')
	    	->name('request-update-sections');

	    Route::get('/request-for-update/{id}', 'SupplierPortal\Supplier\SupplierProfileController@updateRequest')
	    	->name('update-request');

	    Route::post('/approve-supplier', 'SupplierPortal\Supplier\ApproverController@approve_supplier')->name('sms.approver.supplier.approve');  
	    Route::post('/disapprove-supplier', 'SupplierPortal\Supplier\ApproverController@disapprove_supplier')->name('sms.approver.supplier.disapprove');  
	    //Route::patch('/profile/{id}', 'SupplierPortal\Supplier\SupplierProfileController@profile')->name('sms.auth.profile.view');
		
		Route::post('upload-files', 'SupplierPortal\Supplier\SupplierProfileController@upload')->name('uploaded-files');

		Route::get('/profile/{email?}', 'SupplierPortal\Supplier\SupplierProfileController@profile')->name('sms.auth.profile.view');   

		Route::get('/print/profile/{email?}', 'SupplierPortal\Supplier\SupplierProfileController@printProfile')->name('sms.auth.print-profile.view');   

		Route::post('/send-message', 'SupplierPortal\Supplier\SupplierProfileController@sendMessage')->name('sms.message');

		Route::get('/messages', 'SupplierPortal\Supplier\SupplierProfileController@messages')->name('sms.messages');   
		Route::get('/message/{to}/convo', 'SupplierPortal\Supplier\SupplierProfileController@getConvo')->name('sms.convo');  


		Route::get('/change-password', 'SupplierPortal\FrontController@passwordReset')->name('sms.password-reset');
		Route::post('/change-password', 'SupplierPortal\FrontController@passwordUpdate')->name('sms.password-update');

		Route::post('/remove-attachment', 'SupplierPortal\Supplier\SupplierProfileController@removeUploadedFile')->name('sms.remove-attachment');

	});

    Route::get('/{any}', 'SupplierPortal\FrontController@page')->where('any', '.*');

});


Route::prefix('approver')->group(function () {

	Route::get('/', function(){
		return redirect(route('approver.login'));
	});

	Route::get('/login', 'SupplierPortal\Approver\ApproverController@login')->name('approver.login');

	Route::group(['middleware' => 'authenticated' ], function() {  
		Route::get('/dashboard', 'SupplierPortal\Approver\ApproverController@dashboard')->name('approver.dashboard');

		Route::post('/send-message', 'SupplierPortal\Approver\ApproverController@sendMessage')->name('approver.message');

		Route::get('/messages', 'SupplierPortal\Approver\ApproverController@messages')->name('approver.messages');
		Route::get('/message/{to}/convo', 'SupplierPortal\Approver\ApproverController@getConvo')->name('approver.convo'); 

		Route::get('/upcoming-approval', 'SupplierPortal\Approver\ApproverController@upcomingApproval')->name('approver.upcoming-approval');
		Route::get('/accredited-suppliers', 'SupplierPortal\Approver\ApproverController@accreditedSuppliers')
			->name('approver.accredited-suppliers');
		Route::get('/rejected-suppliers', 'SupplierPortal\Approver\ApproverController@rejectedSuppliers')
			->name('approver.rejected-suppliers');
		Route::get('/supplier/approval', 'SupplierPortal\Approver\ApproverController@finalApproval')->name('approver.approval');
		Route::get('/pending-applications', 'SupplierPortal\Approver\ApproverController@applicationsPending')->name('approver.applications-pending');
		Route::get('/approved-applications', 'SupplierPortal\Approver\ApproverController@applicationsApproved')->name('approver.applications-approved');
		Route::get('/rejected-applications', 'SupplierPortal\Approver\ApproverController@applicationsRejected')->name('approver.applications-rejected');
		Route::get('/ongoing', 'SupplierPortal\Approver\ApproverController@ongoingSuppliers')->name('approver.ongoing-suppliers');	

		Route::get('/deactivate-user/{id}', 'SupplierPortal\Approver\ApproverController@deactiveUsers')->name('approver.deactivate-user');

		Route::post('/supplier/approval', 'SupplierPortal\Approver\ApproverController@approveFinalApproval')->name('approver.approved');


		Route::get('/notif-approver', 'SupplierPortal\Approver\ApproverController@notifyApprover');


		Route::get('/changes-password', 'SupplierPortal\Approver\ApproverController@passwordReset')->name('approver.password-reset');
		Route::post('/change-password', 'SupplierPortal\Approver\ApproverController@passwordUpdate')->name('approver.password-update');

		Route::get('/settings', 'SupplierPortal\Approver\ApproverController@settings')->name('approver.settings');
		Route::post('/settings', 'SupplierPortal\Approver\ApproverController@postSettings')->name('approver.post-settings');

		//Route::get('/reports', 'SupplierPortal\Approver\ReportsController@index')->name('approver.reports');
		Route::get('/reports-initial-registration', 'SupplierPortal\Approver\ReportsController@getInitialRegistration')->name('approver.reports-initial-registration');
		Route::get('/reports-sis-submission', 'SupplierPortal\Approver\ReportsController@getSISSubmissions')->name('approver.reports-sis-submission');
		Route::get('/reports-for-approval', 'SupplierPortal\Approver\ReportsController@getForApprovals')->name('approver.reports-for-approval');
		Route::get('/reports-approved-suppliers', 'SupplierPortal\Approver\ReportsController@getApprovedSuppliers')->name('approver.reports-approved-suppliers');

		Route::get('/classic-data', 'SupplierPortal\Approver\ClassicController@index')->name('approver.classic-data');
		Route::get('/classics', 'SupplierPortal\Approver\ClassicController@show')->name('approver.classics');

		Route::post('/classic-data', 'SupplierPortal\Approver\ClassicController@upload')->name('approver.classic-post-data');

		Route::get('/show-history', 'SupplierPortal\Approver\ApproverController@showHistory')->name('approver.show-history');

	});

});

Route::prefix('evaluator')->group(function () {

	Route::get('/', function(){
		return redirect(route('evaluator.login'));
	});

	Route::get('/login', 'SupplierPortal\Evaluator\EvaluatorsController@login')->name('evaluator.login');

	Route::group(['middleware' => 'authenticated' ], function() {  
		
		Route::get('/dashboard', 'SupplierPortal\Evaluator\EvaluatorsController@dashboard')->name('evaluator.dashboard');
		Route::get('/accredited-suppliers', 'SupplierPortal\Evaluator\EvaluatorsController@accreditedSuppliers')
			->name('evaluator.accredited-suppliers');
		Route::get('/rejected-suppliers', 'SupplierPortal\Evaluator\EvaluatorsController@rejectedSuppliers')
			->name('evaluator.rejected-suppliers');

		//Route::get('/reports', 'SupplierPortal\Evaluator\ReportsController@index')->name('evaluator.reports');
		Route::get('/reports-initial-registration', 'SupplierPortal\Evaluator\ReportsController@getInitialRegistration')->name('evaluator.reports-initial-registration');
		Route::get('/reports-sis-submission', 'SupplierPortal\Evaluator\ReportsController@getSISSubmissions')->name('evaluator.reports-sis-submission');
		Route::get('/reports-for-approval', 'SupplierPortal\Evaluator\ReportsController@getForApprovals')->name('evaluator.reports-for-approval');
		Route::get('/reports-approved-suppliers', 'SupplierPortal\Evaluator\ReportsController@getApprovedSuppliers')->name('evaluator.reports-approved-suppliers');

		Route::get('/show-history', 'SupplierPortal\Evaluator\EvaluatorsController@showHistory')->name('evaluator.show-history');

		Route::get('/changes-password', 'SupplierPortal\Evaluator\EvaluatorsController@passwordReset')->name('evaluator.password-reset');
		Route::post('/change-password', 'SupplierPortal\Evaluator\EvaluatorsController@passwordUpdate')->name('evaluator.password-update');

	});

});