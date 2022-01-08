<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = "Hello World :)";
        return view('pages.index')->with('title', $title);
    }
    public function about(){
        $data = array(
            'title' => 'About page',
            'descriptions' => ['Veidoja Indriķis Paiders','Apliecibas numurs - ip18089']
        );
        return view('pages.about')->with($data);
    }
}
