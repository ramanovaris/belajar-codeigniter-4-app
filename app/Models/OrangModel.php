<?php

namespace App\Models;

use CodeIgniter\Model;

class OrangModel extends Model
{
  protected $table      = "orang";
  protected $useTimestamps = true;
  protected $allowedFields = ["alamat", "nama"];

  public function search($keyword)
  {
    // $builder = $this->table("orang");
    // $builder->like("nama", $keyword);
    // return $builder;

    return $this->table("orang")->like("nama", $keyword)->orLike("alamat", $keyword);
  }
}
