<?php

use App\UsersModel;

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

Route::get('/', 'FrontEndController@index');
Route::get('/about', 'FrontEndController@about');
Route::get('/faq', 'FrontEndController@faq');
Route::get('/contact', 'FrontEndController@contact');
Route::get('/listall', 'FrontEndController@all');
Route::get('/listfeatured', 'FrontEndController@featured');
Route::get('/services/{category}', 'FrontEndController@category');
Route::get('/services/order/{id}', 'FrontEndController@order');
Route::post('/subscribe', 'FrontEndController@subscribe');
Route::post('/profile/email', 'FrontEndController@usermail');
Route::post('/contact/email', 'FrontEndController@contactmail');
Route::get('/profile/{id}/{name}', 'FrontEndController@viewprofile')
;
Route::post('/payaferservice', 'FrontEndController@payaferservice')->name('cash.submit');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.login');


Route::get('/login', function () {
    return view('admin.login');
});

Auth::routes();

Route::get('/admin/dashboard', 'HomeController@index');

Route::post('admin/settings/title', 'SettingsController@title');
Route::post('admin/settings/payment', 'SettingsController@payment');
Route::post('admin/settings/about', 'SettingsController@about');
Route::post('admin/settings/address', 'SettingsController@address');
Route::post('admin/settings/footer', 'SettingsController@footer');
Route::post('admin/settings/logo', 'SettingsController@logo');
Route::post('admin/settings/favicon', 'SettingsController@favicon');
Route::post('admin/settings/background', 'SettingsController@background');
Route::resource('/admin/settings', 'SettingsController');

Route::resource('/admin/sliders', 'SliderController');

Route::post('/admin/service/titles', 'ServiceSectionController@titles');
Route::resource('/admin/service', 'ServiceSectionController');

Route::post('/admin/testimonial/titles', 'TestimonialController@titles');
Route::resource('/admin/testimonial', 'TestimonialController');

Route::post('/admin/pricing/titles', 'PricingTableController@titles');
Route::resource('/admin/pricing', 'PricingTableController');

Route::post('/admin/portfolio/titles', 'PortfolioController@titles');
Route::resource('/admin/portfolio', 'PortfolioController');

Route::resource('/admin/services', 'ServiceController');
Route::resource('/admin/category', 'CategoryController');
Route::resource('/admin/counter', 'CounterController');

Route::post('admin/pagesettings/about', 'PageSettingsController@about');
Route::post('admin/pagesettings/faq', 'PageSettingsController@faq');
Route::post('admin/pagesettings/contact', 'PageSettingsController@contact');
Route::resource('/admin/pagesettings', 'PageSettingsController');

Route::get('admin/ads/status/{id}/{status}', 'AdvertiseController@status');

Route::resource('/admin/ads', 'AdvertiseController');
Route::resource('/admin/social', 'SocialLinkController');
Route::resource('/admin/tools', 'SeoToolsController');
Route::get('admin/subscribers/download', 'SubscriberController@download');

Route::resource('/admin/subscribers', 'SubscriberController');
Route::post('/admin/adminpassword/change/{id}', 'AdminProfileController@changepass');
Route::get('/admin/adminpassword', 'AdminProfileController@password');
Route::resource('/admin/adminprofile', 'AdminProfileController');

Route::get('/admin/orders/status/{id}', 'OrderController@status');
Route::get('/admin/orders/email/{id}', 'OrderController@email');
Route::post('/admin/orders/emailsend', 'OrderController@sendemail');
Route::resource('/admin/transactions', 'TransactionController');

Route::get('/admin/customers/email/{id}', 'CustomerController@email');
Route::get('/admin/customers/status/{id}/{status}', 'CustomerController@status');
Route::post('/admin/customers/emailsend', 'CustomerController@sendemail');
Route::resource('/admin/customers', 'CustomerController');

Route::get('/admin/withdraws/accept/{id}', 'WithdrawController@accept');
Route::get('/admin/withdraws/reject/{id}', 'WithdrawController@reject');
Route::resource('/admin/withdraws', 'WithdrawController');

Route::post('/payment', 'PaymentController@store')->name('payment.submit');
Route::get('/payment/cancle', 'PaymentController@paycancle')->name('payment.cancle');
Route::get('/payment/return', 'PaymentController@payreturn')->name('payment.return');
Route::post('/payment/notify', 'PaymentController@notify')->name('payment.notify');

Route::post('/stripe-submit', 'StripeController@store')->name('stripe.submit');

Route::get('/account/login', 'Auth\ProfileLoginController@showLoginFrom')->name('user.login');
Route::post('/account/login', 'Auth\ProfileLoginController@login')->name('user.login.submit');
Route::get('/account/registration', 'Auth\ProfileRegistrationController@showRegistrationForm')->name('user.reg');
Route::post('/account/registration', 'Auth\ProfileRegistrationController@register')->name('user.reg.submit');

Route::get('/account/forgot', 'Auth\ProfileResetPassController@showForgotForm')->name('user.forgotpass');
Route::post('/account/forgot', 'Auth\ProfileResetPassController@resetPass')->name('user.forgotpass.submit');

Route::post('account/update/{id}', 'UserAccountController@update')->name('account.update');
Route::post('account/passchange/{id}', 'UserAccountController@passchange')->name('account.passchange');

Route::get('/checkacc/{email}', 'FrontEndController@checkacc');
Route::get('/account/dashboard', 'UserAccountController@index')->name('user.account');
Route::get('/account/send', 'UserAccountController@send')->name('account.send');
Route::get('/account/transactions', 'UserAccountController@transactions')->name('account.transactions');
Route::get('/account/request', 'UserAccountController@request')->name('account.request');
Route::get('/account/deposit', 'UserAccountController@deposit')->name('account.deposit');
Route::get('/account/settings', 'UserAccountController@accountsettings')->name('account.settings');
Route::get('/account/security', 'UserAccountController@accountsecurity')->name('account.security');
Route::get('/account/withdraw', 'UserAccountController@withdraw')->name('account.withdraw');
Route::get('/account/requests', 'UserAccountController@pendingreqs')->name('account.requests');
Route::get('/account/withdraws', 'UserAccountController@pendingwithdraws')->name('account.withdraws');
Route::get('/account/requestsdetails/{id}', 'UserAccountController@reqdetails')->name('account.requests.details');
Route::get('/account/transdetail/{id}', 'UserAccountController@transdetail')->name('account.transaction.details');

Route::post('/account/sendsubmit', 'UserAccountController@sendsubmit')->name('account.send.submit');
Route::post('/account/requestsubmit', 'UserAccountController@requestsubmit')->name('account.request.submit');
Route::post('/account/withdrawsubmit', 'UserAccountController@withdrawsubmit')->name('account.withdraw.submit');
Route::post('/account/acceptrequest/{id}', 'UserAccountController@acceptrequest')->name('account.request.accept');
Route::get('/account/rejectrequest/{id}', 'UserAccountController@rejectrequest')->name('account.request.reject');