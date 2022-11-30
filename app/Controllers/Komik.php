<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
  protected $komikModel;
  public function __construct()
  {
    $this->komikModel = new KomikModel();
  }

  public function index()
  {
    $data = [
      "title" => "Daftar Komik",
      "responKomik" => $this->komikModel->getKomik()
    ];

    return view("komik/index", $data);
  }

  public function detail($slug)
  {
    $data = [
      "title" => "Daftar Komik",
      "responDetailKomik" =>  $this->komikModel->getKomik($slug)
    ];

    return view("komik/detail", $data);
  }
}
