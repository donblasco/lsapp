<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Bienvenidos al mundo LARAVEL';
      //  return view('pages.index', compact('title'));
      return view('pages.index')->with('title',$title);
    }

    public function about(){
        $title = 'Acerca de esta pagina';
        return view('pages.about')->with('title',$title);
    }

    public function services(){
        $data = array(
            'title'=>'Services',
            'services'=>['Diseño Web','Programacion', 'SEO']
        );
        return view('pages.services')->with($data);
    }




}
