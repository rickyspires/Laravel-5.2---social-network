<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    //this must be in "web" for Token to work
    Route::get('/', function () {

        // Retrieve a piece of data from the session...
        $value = session('key');

        // Store a piece of data in the session...
        session(['key' => 'value']);
        
        return view('home');
    })->name('home');


     //User sign up
    Route::post('/signup', [
    	'uses'=>'UserController@postSignUp',
    	'as'=>'signup'
    ]);
    //User sign up
    Route::post('/signin', [
        'uses'=>'UserController@postSignIn',
        'as'=>'signin'
    ]);
    //User logout
    Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'logout'
    ]);
    //User account
    Route::get('/account', [
        'uses' => 'UserController@getAccount',
        'as' => 'account'
    ]);
    //Update Account
    Route::post('/updateaccount', [
        'uses' => 'UserController@postSaveAccount',
        'as' => 'account.save'
    ]);

    Route::get('/userimage/{filename}', [
        'uses' => 'UserController@getUserImage',
        'as' => 'account.image'
    ]);
    
    //After signup or signin redirect to the dashboard
    Route::get('/dashboard', [
        'uses'=>'PostController@getDashboard',
        'as'=>'dashboard',
        'middleware' => 'auth' //auth is Authenticate - set in the kernal
    ]);

    Route::post('/createpost', [
        'uses' => 'PostController@postCreatePost',
        'as' => 'post.create',
        'middleware' => 'auth'
    ]);

    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware' => 'auth'
    ]);

    ////test ajax call for post/edit - returms json
    // Route::post('/edit', function(\Illuminate\Http\Request $request){
    //     return response()->json(['message' => $request['body']]);
    // })->name('edit'); // edit comes from var urlEdit = '{{ route('edit') }}'; in the dashboard
   
    Route::post('/edit', [
        'uses' => 'PostController@postEditPost',
        'as' => 'edit'
    ]);

    Route::post('/like', [
       'uses' => 'PostController@postLikePost',
        'as' => 'like'
    ]);

    
});
