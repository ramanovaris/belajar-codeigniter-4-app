<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container">
  <div class="row">
    <div class="col">
      <h1>Contact US</h1>

      <?php foreach ($alamat as $field) : ?>
        <ul>
          <li><?= $field["tipe"]; ?></li>
          <li><?= $field["alamat"]; ?></li>
          <li><?= $field["kota"]; ?></li>
        </ul>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>