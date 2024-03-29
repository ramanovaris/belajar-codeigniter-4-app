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
    // session();

    $data = [
      "title" => "Form Tambah Data Komik",
      "validation" => \Config\Services::validation()
    ];

    return view("komik/create", $data);
  }

  public function save()
  {
    // validasi input
    if (!$this->validate([
      "judul" => [
        "rules" => "required|is_unique[komik.judul]",
        "errors" => [
          "required" => "{field} komik harus diisi",
          "is_unique" => "{field} komik sudah terdaftar"
        ]
      ],
      "sampul" => [
        "rules" =>  "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
        "errors" => [
          "max_size" => "Ukuran gambar terlalu besar",
          "is_image" => "Yang anda pilih bukan gambar",
          "mime_in" => "Yang anda pilih bukan gambar"
        ]
      ]
    ])) {
      return redirect()->to("/komik/create")->withInput();
    };

    // ambil gambar
    $fileSampul = $this->request->getFile("sampul");

    // apakah tidak ada gambar yang diupload
    if ($fileSampul->getError() == 4) {
      $namaSampul = "default.png";
    } else {
      // generate nama sampul random
      $namaSampul = $fileSampul->getRandomName();

      // pindahkan file ke public/assset/img
      $fileSampul->move("assets/img", $namaSampul);

      // ambil nama file sampul
      // $namaSampul = $fileSampul->getName();
    }


    $slug = url_title($this->request->getVar("judul"), "-", true);

    $this->komikModel->save([
      "judul" => $this->request->getVar("judul"),
      "slug" => $slug,
      "penulis" => $this->request->getVar("penulis"),
      "penerbit" => $this->request->getVar("penerbit"),
      "sampul" => $namaSampul
    ]);

    session()->setFlashdata("pesan", "Data Telah Berhasil Ditambahkan!");

    return redirect()->to("/komik");
  }

  public function delete($id)
  {
    // cari gambar berdasarkan id
    $komik = $this->komikModel->find($id);

    // cek jika file gambarnya default.png
    if ($komik["sampul"] != "default.png") {
      // hapus gambar
      unlink("assets/img/" . $komik["sampul"]);
    }

    $this->komikModel->delete($id);
    session()->setFlashdata("pesan", "Data Telah Berhasil Dihapus!");
    return redirect()->to("/komik");
  }

  public function edit($slug)
  {
    $data = [
      "title" => "Form Ubah Data Komik",
      "validation" => \Config\Services::validation(),
      "komik" => $this->komikModel->getKomik($slug)
    ];

    return view("komik/edit", $data);
  }

  public function update($id)
  {
    // cek judul
    $komikLama = $this->komikModel->getKomik($this->request->getVar("slug"));
    if ($komikLama["judul"] == $this->request->getVar("judul")) {
      $rule_judul = "required";
    } else {
      $rule_judul = "required|is_unique[komik.judul]";
    }


    // validasi input
    if (!$this->validate([
      "judul" => [
        "rules" => $rule_judul,
        "errors" => [
          "required" => "{field} komik harus diisi",
          "is_unique" => "{field} komik sudah terdaftar"
        ]
      ],
      "sampul" => [
        "rules" =>  "max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]",
        "errors" => [
          "max_size" => "Ukuran gambar terlalu besar",
          "is_image" => "Yang anda pilih bukan gambar",
          "mime_in" => "Yang anda pilih bukan gambar"
        ]
      ]
    ])) {
      return redirect()->to("/komik/edit/" . $this->request->getVar("slug"))->withInput();
    };

    $fileSampul = $this->request->getFile("sampul");

    // cek apakah gambar dirubah atau tidak
    if ($fileSampul->getError() == 4) {
      $namaSampul = $this->request->getVar("sampulLama");
    } else {
      // generate nama file random
      $namaSampul = $fileSampul->getRandomName();

      // pindahkan gambar
      $fileSampul->move("assets/img", $namaSampul);

      // hapus file yanga sama
      unlink("assets/img/" . $this->request->getVar("sampulLama"));
    }

    $slug = url_title($this->request->getVar("judul"), "-", true);

    $this->komikModel->save([
      "id" => $id,
      "judul" => $this->request->getVar("judul"),
      "slug" => $slug,
      "penulis" => $this->request->getVar("penulis"),
      "penerbit" => $this->request->getVar("penerbit"),
      "sampul" => $namaSampul
    ]);

    session()->setFlashdata("pesan", "Data Telah Berhasil Diubah!");

    return redirect()->to("/komik");
  }
}
