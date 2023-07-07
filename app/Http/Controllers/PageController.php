<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Home page
     *
     * @return View
     */
    public function index() : View
    {
        return view('index');
    }

    /**
     * Contacts page
     *
     * @return View
     */
    public function contacts() : View
    {
        return view('contacts');
    }
}
