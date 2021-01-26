<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(0);
include 'head.php';
include 'function/function.php';
$json =  getJadwalDokter();
$obj  = json_decode($json);
$jadwalDokter = $obj->_embedded->jadwalDokterDisplays;
// echo $json;
// die;
?>

<body>
  <div class="p-3 d-flex bg-header p-fixed" style="background-color: #537909;" id="table">
    <div>
      <img width="70" src="assets/icon/logo.png" alt="Logo rsa bojonegoro">
    </div>
    <div class="ml-4">
      <h4 class="text-uppercase text-center header">Rumah sakit `aisyiyah bojonegoro</h4>
      <h6 class="text-uppercase text-center text-white">jadwal praktek dokter hari senin tanggal <?= date('d M Y'); ?></h6>
    </div>
    <div class="ml-5 alert alert-warning text-center">
      Data terakhir di update
      <h5><?= date('H:i:s'); ?></h5>
    </div>
  </div>
  <div class="content">
    <table class="table table-striped" style="border: none;">
      <thead class="bg-success text-white head-jadwal">
        <tr class="w-100">
          <th width="120"></th>
          <th width="390">DOKTER</th>
          <th width="100" class="text-center">STATUS</th>
          <th width="250" class="text-center">KLINIK</th>
          <th width="100" class="text-center">PRAKTEK</th>
          <th width="250" class="text-center">JAM PRAKTEK</th>
          <th width="150" class="text-center">ANTRIAN</th>
        </tr>
      </thead>
      <tbody id="dataJadwal" class="body-jadwal">
        <?php foreach ($jadwalDokter as $value) : ?>
          <tr class="alert alert-success mt-5">
            <td width="150" class="text-center"><img width="50" class="img-fluid rounded-circle" src="<?= getImgDokter($value->dr); ?>" alt=""></td>
            <td width="400" style="vertical-align: center;">
              <h5><?= $value->dokter; ?></h5>
            </td>
            <td width="100" class="text-center">
              <h3><?= getLiburAlert($value->libur, $value->tgllibur); ?></h3>
            </td>
            <td width="250" class="text-center">
              <h5 class="text-dark center-cell">Klinik <?= $value->spesialis; ?></h5>
            </td>
            <td width="100" class="text-center">
              <h3><?= getPrakAlert($value->prak) ?></h3>
            </td>
            <td width="300" class="text-center">
              <h5 class="text-primary"><?= substr($value->buka, 0, 5); ?>
                <span style="font-weight: normal;" class="text-dark">s/d</span>
                <?= substr($value->tutup, 0, 5); ?>
              </h5>
            </td>
            <td width="150" class="text-center">
              <?php if ($value->libur == 1) : ?>
                <h5><?= $value->allpx ?> Pasien, <?= $value->finishpx; ?> Terlayani</h5>
              <?php endif ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>

</body>
<?php include 'script.php' ?>
<script src="script/jadwalHariIni.js"></script>

</html>