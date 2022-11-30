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

    /*Juka komik tidak ada ditabel */
    if (empty($data["responDetailKomik"])) {
      throw new \CodeIgniter\Exceptions\PageNotFoundException("Judul komik " . $slug . " tidak ditemukan.");
    }

    return view("komik/detail", $data);
  }

  public function create()
  {
    $data = [
      "title" => "Form Tambah Data Komik"
    ];

    return view("komik/create", $data);
  }

  public function save()
  {
    $slug = url_title($this->request->getVar("judul"), "-", true);

    $this->komikModel->save([
      "judul" => $this->request->getVar("judul"),
      "slug" => $slug,
      "penulis" => $this->request->getVar("penulis"),
      "penerbit" => $this->request->getVar("penerbit"),
      "sampul" => $this->request->getVar("sampul")
    ]);

    session()->setFlashdata("pesan", "Data Telah Berhasil Ditambahkan!");

    return redirect()->to("/komik");
  }
}
