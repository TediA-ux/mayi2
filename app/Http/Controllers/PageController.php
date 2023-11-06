<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
        public function about()
        {
    
            return view('pages.about');
        }
    
        public function archive()
        {
    
            return view('pages.archive');
        }
    
        public function contact()
        {
    
            return view('pages.contact');
        }
        
        public function contact_form()
        {
    
            return view('pages.contact_form');
        }
    

}