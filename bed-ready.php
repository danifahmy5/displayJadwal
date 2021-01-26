<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(0);

include 'head.php';
include 'function/function.php';

$json       = getBedReady();
$obj        = json_decode($json);
$paviliun   = uniqPaviliun($obj->_embedded->bedReadies);
$pavKhusus  =  ['ICU', 'NEONATUS'];
?>

<body>
  <div class="p-3 d-flex bg-header bg-dark" style="background-color:#392272;" id="table">
    <div>
      <img width="70" src="assets/icon/logo.png" alt="Logo rsa bojonegoro">
    </div>
    <div class="ml-4">
      <h4 class="text-uppercase text-center header">Rumah sakit `aisyiyah bojonegoro</h4>
      <h5 class="text-uppercase text-center text-white">Ketersediaan kamar tidur <?= date('d M Y'); ?></h5>
    </div>
  </div>
  <div class="content-bedReady">
    <div class="mx-3">
      <div class="row">
        <div class="col-lg-9">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="false">
            <ol class="carousel-indicators">
              <?php $i = 0 ?>
              <?php foreach ($paviliun as $key => $value) : ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>" class="<?= $i < 1 ? 'active' : null; ?>"></li>
              <?php $i++;
              endforeach ?>

              <?php foreach ($pavKhusus as $key => $value) : ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i; ?>"></li>
              <?php $i++;
              endforeach ?>
            </ol>
            <div class="carousel-inner">
              <?php foreach ($paviliun as $key => $value) : ?>
                <div class="carousel-item <?= $key < 1 ? 'active' : null; ?>">
                  <div class="container bg-white rounded shadow border p-3 pb-4">
                    <h5 class="bg-secondary text-white p-2"><?= strtoupper($value) ?></h5>
                    <?php $bedReady = searchBedReady($value, $obj) ?>
                    <table class="table table-striped">
                      <tbody>
                        <tr class="bg-dark text-white">
                          <th class="text-center">
                            <h5>KELAS</h5>
                          </th>
                          <th></th>
                          <th class="text-center ">
                            <h5>JUMLAH TT</h5>
                          </th>
                          <th class="text-center ">
                            <h5>TERPAKAI</h5>
                          </th>
                          <th class="text-center ">
                            <h5>TERSEDIA</h5>
                          </th>
                        </tr>
                        <?php foreach ($bedReady as $value) : ?>
                          <?php $ready    = $value['ready'] < 1 ? 0 : $value['ready']; ?>
                          <tr class="bg-secondary rounded">
                            <th scope="row" class="text-center text-white" width="200">
                              <h3><?= $value['kelas'] == "HCU- Bi'rali" ? 'HCU' :  $value['kelas']; ?></h3>
                            </th>
                            <td class="text-left">
                              <h3>:</h3>
                            </td>
                            <td class="text-center badge badge-primary d-table-cell">
                              <h1><?= $value['jumlah'] < 1 ? 0 : $value['jumlah']; ?></h1>
                            </td>
                            <td class="text-center badge badge-warning d-table-cell">
                              <h1><?= $value['jumlah'] - $ready ?></h1>
                            </td>
                            <td class="text-center badge badge-success d-table-cell">
                              <h1><?= $ready; ?></h1>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php endforeach ?>
              <?php foreach ($pavKhusus as $key => $value) : ?>
                <div class="carousel-item">
                  <div class="container bg-white mt-3 rounded shadow border p-3 pb-4">
                    <h3 class="bg-secondary text-white p-2"><?= strtoupper($value) ?></h3>
                    <?php $bedReady = searchBedKhusus("BI'RALI- 2", $value, $obj) ?>
                    <table class="table table-striped">
                      <tbody>
                        <tr class="bg-dark text-white">
                          <th class="text-center">
                            <h5>KELAS</h5>
                          </th>
                          <th></th>
                          <th class="text-center ">
                            <h5>JUMLAH TT</h5>
                          </th>
                          <th class="text-center ">
                            <h5>TERPAKAI</h5>
                          </th>
                          <th class="text-center ">
                            <h5>TERSEDIA</h5>
                          </th>
                        </tr>
                        <?php foreach ($bedReady as $value) : ?>
                          <?php $ready    = $value['ready'] < 1 ? 0 : $value['ready']; ?>
                          <tr class="bg-secondary">
                            <th scope="row" class="text-center text-white" width="200">
                              <h3><?= $value['kelas'] == "HCU- Bi'rali" ? 'HCU' :  $value['kelas']; ?></h3>
                            </th>
                            <td class="text-left">
                              <h3>:</h3>
                            </td>
                            <td class="text-center badge badge-primary d-table-cell">
                              <h1><?= $value['jumlah'] < 1 ? 0 : $value['jumlah']; ?></h1>
                            </td>
                            <td class="text-center badge badge-warning d-table-cell">
                              <h1><?= $value['jumlah'] - $ready ?></h1>
                            </td>
                            <td class="text-center badge badge-success d-table-cell">
                              <h1><?= $ready; ?></h1>
                            </td>
                          </tr>
                        <?php endforeach ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <h4 class="text-center" style="font-size: 21pt;"></h4>
          <div class="alert alert-danger text-center">
            Data terkhir di update
            <h3><?= date('H:i:s'); ?></h3>
          </div>
          <div class="alert alert-info">
            <p><strong>Keterangan :</strong> Angka di samping menunjukan jumlah seluruh tempat tidur, jumlah tempat tidur yang terpakai, dan tembat tidur yang tersedia, Jika angka menunjukaan 0 maka tempat tidur / bed sudah penuh</p>
            <span class="text-danger font-italic font-weight-bold">Data di samping update otomastis setiap 2 menit</span>
            <ul class="pl-3">
              <li><strong>Arofah :</strong>Ruang Perawatan Umum</li>
              <li><strong>Birali 1 :</strong>Ruang Perawatan Dewasa</li>
              <li><strong>Birali 3 :</strong>Ruang Perawatan Kandungan</li>
              <li><strong>Birali 4 :</strong>Ruang Perawatan Anak</li>
              <li><strong>Mina :</strong>Ruang Perawatan Dewasa</li>
              <li><strong>Musdalifah :</strong>Ruang Perawatan Dewasa</li>
              <li><strong>Neonatus :</strong>Ruang Perawatan Bayi</li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>
<?php include 'script.php' ?>

<script>
  addEventListener("click", function() {
    var el = document.documentElement,
      rfs = el.requestFullscreen ||
      el.webkitRequestFullScreen ||
      el.mozRequestFullScreen ||
      el.msRequestFullscreen;

    rfs.call(el);
  });
  setTimeout(function() {
    window.location.reload()
  }, 100000)
</script>

</html>