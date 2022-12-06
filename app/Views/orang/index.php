<?= $this->extend("layout/template"); ?>


<?= $this->section("content"); ?>
<div class="container">
  <div class="row">
    <div class="col-6">
      <h1 class="mt-2">Daftar Orang</h1>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="keyword" class="form-control" placeholder="Masukkan Keyword Pencarian.." aria-label="Recipient's username" aria-describedby="button-addon2">
          <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1 + (6 * ($currentPage - 1)); ?>
          <?php foreach ($responOrang as $orang) : ?>
            <tr>
              <th scope="row"><?= $no++; ?></th>
              <td><?= $orang["nama"]; ?></td>
              <td><?= $orang["alamat"]; ?></td>
              <td><a href="" class="btn btn-success">Detail</a></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <?= $responPager->links("orang", "orang_pagination"); ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>