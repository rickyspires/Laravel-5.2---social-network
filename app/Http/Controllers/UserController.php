<?php

namespace App\Http\Controllers;

use App\User;
//use App\Http\Requests;
use Illuminate\Http\Request; 
use Illuminate\Http\Response; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    //Register
    public function postSignUp(Request $request){

            //validate
            $this->validate($request, [
                'email' => 'email|unique:users|required',
                'name' => 'max:120|required',
                'password' => 'min:4|required'
            ]);

            //get fields from signup form using $request
            $email = $request['email'];
            $name = $request['name'];
            $password = bcrypt($request['password']);
           

            //create new user - use App\User;
            $user = new User();
            $user->email = $email;
            $user->name = $name;
            $user->password = $password;
            $user->save(); //save to the db.

            Auth::login($user);//login after register

            return redirect()->route('dashboard');

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    //Sing in
    public function postSignIn(Request $request){

            $this->validate($request, [
                'email' => 'required',
                'password' => 'required'
            ]);

            if (Auth::attempt([ 'email' => $request['email'], 'password' => $request['password'] ])){
                return redirect()->route('dashboard');
            }
            return redirect()->back();
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]); 
    }

    public function postSaveAccount(Request $request)
    {
        $this->validate($request, [
           'name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $file = $request->file('image');  
        $filename = $request['name'] . '-' . $user->id . '.jpg'; 

        if ($file) {
            Storage::disk('local')->put($filename, File::get($file)); 
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
