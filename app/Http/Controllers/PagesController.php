<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }





    /**
     * This is the page for the form to create a new notes. (this should probably be a modal on the dashboard page rather than its own page.)
     * @return view new_note form
     */
    public function new_note()
    {
        return view('new_note');
    }



}
