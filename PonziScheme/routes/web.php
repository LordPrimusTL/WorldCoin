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

//Database Query
Route::get('truncate/users','DatabaseController@TruncateUsers');

Route::get('/','UtilityController@Home');
Route::get('/signin',['as' => 'login','uses' => 'UtilityController@SignIn']);
Route::get('/signout',['as' => 'logout','uses' => 'UtilityController@SignOut']);
Route::get('/signup','UtilityController@Register');
Route::get('/signup/{refferer}','UtilityController@RRegister');
Route::get('/about','UtilityController@About');
Route::get('/terms-of-service','UtilityController@TOS');


Route::get('/user/reset_password','UtilityController@ResetPassword');
Route::get('/user/reset_password/{token}','UtilityController@ResetPasswordA');
Route::get('/user/activate/{id}','ValidationController@ActivateUser');

//Utilities: Clear before you upload online
Route::get('/others',function ()
{
   //\App\referrals::truncate();
   //\App\transaction::truncate();
   //\App\alert_error::truncate();
   //\App\ref_acct::truncate();
   //\App\main_acct::truncate();
    $timezone = date_default_timezone_get();
    echo "The current server timezone is: " . $timezone;
    echo "<br />".date('m/d/Y h:i:s a', time());


    $dt = \Carbon\Carbon::now();
    $dt->timezone = 'Africa/Lagos';
    var_dump($dt);

    $mytime = Carbon\Carbon::now()->timezone(' 	Africa/Lagos');
    echo "<br />".$mytime->toDateTimeString();
   var_dump('o');
});

Route::get('/error',function()
{
    dd(count(\App\alert_error::all()));
});


//validation
Route::post('/user/signin','ValidationController@SignInV');
Route::post('/user/signup','ValidationController@RegisterV');
Route::post('/user/reset-password','ValidationController@ResetPassword');
Route::post('/user/reset-password/{token}','ValidationController@ResetPasswordA');

Route::post('/user/tickets/comment','CommentsController@PostComment');


//User

Route::group(['middleware'=>['auth','AccActivate','CheckAuthUserRole']], function (){
    Route::get('/user/dashboard','UserController@Dashboard');
    Route::get('/user/profile','UserController@Profile');
    Route::get('/user/change-password','UserController@ChangePassword');
    Route::get('/user/referral','UserController@Referral');
    Route::get('/user/referral/{id}','UserController@Referrals');
    Route::get('user/transactions','UserController@Transactions');
    Route::get('/user/transaction/cancel/{t_id}','UserController@CancelTransaction');
    Route::get('/user/invest','UserController@Invest');
    Route::get('/user/account','UserController@Account');
    Route::get('/user/account/trade','UserController@TradeAccount');
    Route::get('/user/account/referral','UserController@ReferralAccount');
    Route::get('/user/withdrawals','UserController@Withdrawals');
    Route::get('/user/tickets','TicketsController@UserTickets');
    Route::get('/user/tickets/{t_id}','TicketsController@Show');
    Route::get('/user/ticket/create','TicketsController@Create');
    Route::post('/user/ticket/create','TicketsController@Store');
    //Route::post('/user/tickets/comment','CommentsController@PostComment');



    //Logged In User validation
    Route::post('/user/profile/edit','ValidationController@EditProfile');
    Route::post('/user/change-password','ValidationController@PasswordChange');
    Route::post('/user/invest','ValidationController@Invest');
    Route::post('/user/withdraw','ValidationController@Withdrawal');
});

//Admin
Route::group(['middleware'=>['auth','AccActivate','CheckAdmin']], function()
{
    Route::get('/admin/dashboard','AdminController@Dashboard');
    Route::get('/admin/users','AdminController@ListUsers');
    Route::get('/admin/tickets','TicketsController@Index');
    Route::get('/admin/tickets/{t_id}','TicketsController@Show');
    Route::get('/admin/user/view/{id}','AdminController@UserProfile');
    Route::get('/admin/accounts','AdminController@Accounts');
    Route::get('/admin/transactions','AdminController@Transactions');
    Route::get('admin/trade-progress','AdminController@TradeProgress');
    Route::get('/admin/trade/cancel/{t_id}','AdminController@CancelInvestment');
    Route::get('/admin/trade/approve/{t_id}','AdminController@ApproveInvestment');
    Route::get('/admin/withdrawal/approve/{t_id}','AdminController@ApproveWithdrawal');
    Route::get('/admin/withdrawals','AdminController@Withdrawals');
    Route::get('/admin/with-status/{status}','AdminController@WithStatus');
    Route::get('/admin/withdrawal/complete/{t_id]','AdminController@CompleteTransaction');





    //Logged in Admin Validation
    Route::post('/admin/user/edit','ValidationController@EditUser');
    Route::post('admin/user/search','ValidationController@UserSearch');
    Route::post('/admin/trans/search','ValidationController@TransSearch');
    Route::post('/admin/tickets/close/{ticket_id}', 'TicketsController@Close');

    //API Admin
    Route::get('/API/{status}','ApiController@SetWithStatus');
});
