<?= $this->extend("layout/template"); ?>


<?= $this->section("content"); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <table class="table">
        <h1 class="mt-2">Daftar Komik</h1>
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Sampul</th>
            <th scope="col">Judul</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; ?>
          <?php foreach ($responKomik as $field) : ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><img src="/assets/img/<?= $field["sampul"]; ?>" class="sampul" alt="naruto"></td>
              <td><?= $field["judul"]; ?></td>
              <td><a href="" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>