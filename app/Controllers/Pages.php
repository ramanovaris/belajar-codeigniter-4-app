<?php

namespace App\Controllers;

class Pages extends BaseController
{
  public function index()
  {
    $data = [
      "title" => "Home",
      "tes" => ["satu", "dua", "tiga"]
    ];

    return view('pages/home', $data);
  }

  public function about()
  {
    $data = [
      "title" => "About Me"
    ];

    return view('pages/about', $data);
  }

  public function contact()
  {
    $data = [
      "title" => "Contact US",
      "alamat" => [
        [
          "tipe" => "Rumah",
          "alamat" => "Jalan A.Yani KM 7",
          "kota" => "Pelaihari"
        ],
        [
          "tipe" => "Kantor",
          "alamat" => "Matah",
          "kota" => "Pelaihari"
        ]
      ]
    ];

    return view('pages/contact', $data);
  }
}
