<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPlaceController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function myPage()
    {
        return 'Hello world!';
    }

    public function about()
    {
        return view('about');
    }

    public function profile()
    {
        return 'This is your profile';
    }

    public function users()
    {
        return 'User list';
    }

    public function gallery()
    {
        return 'Your awesome gallery';
    }

    public function contacts()
    {
        return view('contacts');
    }

    public function posts()
    {
        return 'Post list';
    }

    public function post()
    {
        return 'Single post';
    }

    public function settings()
    {
        return 'Your profile settings';
    }
}
