<?= $this->extend("layout/template"); ?>


<?= $this->section("content"); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h2>Detail Komik</h2>
      <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
          <div class="col-md-4">
            <img src="/assets/img/<?= $responDetailKomik["sampul"]; ?>" class="img-fluid rounded-start" alt="...">
          </div>
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title"><?= $responDetailKomik["judul"]; ?></h5>
              <p class="card-text"><b>Penulis : </b><?= $responDetailKomik["penulis"]; ?></p>
              <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $responDetailKomik["penerbit"]; ?></small></p>

              <a href="/komik/edit/<?= $responDetailKomik["slug"]; ?>" class="btn btn-warning">Edit</a>

              <form action="/komik/<?= $responDetailKomik["id"]; ?>" method="post" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Apakah Anda yakin ingin menghapus data?`)">Delete</button>
              </form>

              <br><br>
              <a href="/komik">Kembali ke Daftar Komik</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>