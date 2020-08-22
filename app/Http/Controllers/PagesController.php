<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        $title = "This Is HomePage";
        return view('pages/index')->with('title',$title);
    }

    public function about() {
        $title = "About Us";
        return view('pages/about')->with('title',$title);
    }
    public function services() {
        $docs = array(
            'title' => "Services we provide",
            'service' => ["web","Android","ML","DL","Security"]
        );
        return view('pages/services')->with($docs);
    }
}
