<?php

namespace App\Controllers;

class Coba extends BaseController
{
  public function index()
  {
    // return view('welcome_message');
    echo "Hello World! ini controller coba method index";
  }

  public function about($nama = "")
  {
    // return view('welcome_message');
    echo "
      Hello Nama saya $nama. Ini controller coba method about
    ";
  }
}
