<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return \inertia()->render('Home/Index');
    }
}
