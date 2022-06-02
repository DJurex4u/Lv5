<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $allUsers = DB::table('users')->get();
        $dataUsers = HomeController::arrayDeepCopy($allUsers);

        $allTasks = DB::table('tasks')->get();
        $dataTasks = HomeController::arrayDeepCopy($allTasks);

        $user = DB::table('users')->where('email', Auth::user()->email)->first();
        App::setlocale($user->locale);

        if (Auth::user()->role == '/')
        {
            return view('role_selection');
        }

        return view('home', ['dataUsers' => $dataUsers, 'dataTasks' => $dataTasks]);
    }

    public function changeLocaleToHr(): \Illuminate\Http\RedirectResponse
    {
        $userId = Request::input('user_id');
        $user = DB::table('users')->where('id', $userId)->first();
        if($user->locale == 'hr')
        {
            return Redirect::back();
        }

        DB::table('users')->where('id', $userId)->update(['locale' => 'hr']);
        return Redirect::back();
    }

    public function changeLocaleToEn(): \Illuminate\Http\RedirectResponse
    {
        $userId = Request::input('user_id');
        $user = DB::table('users')->where('id', $userId)->first();

        if(empty($user))
        {

        }

        if($user->locale == 'en')
        {
            return Redirect::back();
        }
        DB::table('users')->where('id', $userId)->update(['locale' => 'en']);
        return Redirect::back();
    }

    private static function arrayDeepCopy($oldArray)
    {
        $newArray = array();
        foreach ($oldArray as $item)
        {
            array_push($newArray, $item);
        }
        return $newArray;
    }
}

