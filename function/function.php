<?php
if (!function_exists('base_url')) {
  function base_url()
  {
    return 'http://localhost:8080/';
  }
}

if (!function_exists('getIcon')) {
  function getIcon($klinik)
  {
    switch ($klinik) {
      case 'Bedah':
        return '../assets/clinic/8.png';
      case 'Penyakit Dalam':
        return '../assets/clinic/15.png';
      case 'Bedah Syaraf':
        return '../assets/clinic/27.png';
      case 'Gigi':
        return '../assets/clinic/18.png';
      case 'Umum':
        return '../assets/clinic/14.png';
      case 'Kebidanan dan Kandungan':
        return '../assets/clinic/8.png';
      case 'Anak':
        return '../assets/clinic/8.png';
      case 'Mata':
        return '../assets/clinic/8.png';
      case 'KIA':
        return '../assets/clinic/8.png';
      case 'T H T-KL':
        return '../assets/clinic/8.png';
      case 'Orthopaedi / Bedah Tulang':
        return '../assets/clinic/8.png';
      case 'Psikologi':
        return '../assets/clinic/8.png';
      case 'Rehab Medik':
        return '../assets/clinic/8.png';
      case 'TB DOTS':
        return '../assets/clinic/8.png';
      case 'Paru':
        return '../assets/clinic/8.png';
      case 'Kulit & Kelamin':
        return '../assets/clinic/8.png';
      case 'Gizi':
        return '../assets/clinic/8.png';
      case 'Fisioterapi':
        return '../assets/clinic/8.png';
      case 'Jantung':
        return '../assets/clinic/8.png';
      case 'Syaraf':
        return '../assets/clinic/8.png';
      case 'Urologi':
        return '../assets/clinic/8.png';
    }
  }
}

if (!function_exists('uniqPaviliun')) {
  function uniqPaviliun($array)
  {
    $paviliun = [];

    foreach ($array as $key => $value) {
      if ($value->paviliun != "BI'RALI- 2") {
        $paviliun[] = $value->paviliun;
      }
    }

    return array_unique($paviliun);
  }
}


if (!function_exists('searchBedReady')) {
  function searchBedReady($paviliun, $obj)
  {
    $bedReady     = [];
    $dataBedReady = $obj->_embedded->bedReadies;
    foreach ($dataBedReady as $key => $value) {
      if ($value->paviliun == $paviliun) {
        $bedReady[] = [
          "id"        => $value->id,
          "paviliun"  => $value->paviliun,
          "kelas"     => $value->kelas,
          "jumlah"    => $value->jumlah,
          "ready"     => $value->ready,
          "pavid"     => $value->pavid,
        ];
      }
    }
    return $bedReady;
  }
}

if (!function_exists('searchBedKhusus')) {
  function searchBedKhusus($paviliun, $kelas, $obj)
  {
    $bedReady     = [];
    $dataBedReady = $obj->_embedded->bedReadies;
    foreach ($dataBedReady as $key => $value) {
      if ($kelas == 'NEONATUS') {
        if ($value->kelas == 'II' && $value->paviliun == $paviliun) {
          $bedReady[] = [
            "id"        => $value->id,
            "paviliun"  => $value->paviliun,
            "kelas"     => $value->kelas,
            "jumlah"    => $value->jumlah,
            "ready"     => $value->ready,
            "pavid"     => $value->pavid,
          ];
        }
      }
      if ($value->kelas == $kelas && $value->paviliun == $paviliun) {
        $bedReady[] = [
          "id"        => $value->id,
          "paviliun"  => $value->paviliun,
          "kelas"     => $value->kelas,
          "jumlah"    => $value->jumlah,
          "ready"     => $value->ready,
          "pavid"     => $value->pavid,
        ];
      }
    }
    return $bedReady;
  }
}

if (!function_exists('getBg')) {
  function getBg($kelas)
  {
    switch ($kelas) {
      case 'VIP':
        return 'bg-primary';
        break;
      case 'V VIP':
        return 'bg-success';
        break;
      case 'I':
        return 'bg-danger';
      case 'II':
        return 'bg-warning';
        break;
      case 'III':
        return 'bg-info';
        break;
      case 'NEONATUS':
        return 'bg-pink';
        break;
      case 'ICU':
        return 'bg-secondary';
        break;
      default:
        'bg-pink';
        break;
    }
  }
}

if (!function_exists('getBedReady')) {
  function getBedReady()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.1.200:5000/his/about/bedready',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}

if (!function_exists('getJadwalDokter')) {
  function getJadwalDokter()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://192.168.1.200:5000/his/reg/jadwaldokterdisplay',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
  }
}

if (!function_exists('getLiburAlert')) {
  function getLiburAlert($libur, $tgl)
  {
    if ($tgl) {
      return '<span class="badge badge-danger">Libur</span>';
    } else if ($libur === 2) {
      return '<span class="badge badge-danger">Libur</span>';
    } else {
      return '<span class="badge badge-success">Masuk</span>';
    }
  }
}
if (!function_exists('getPrakAlert')) {
  function getPrakAlert($prak)
  {
    if ($prak == 'Pagi') {
      return '<span class="badge badge-primary">Pagi</span>';
    } else {
      return '<span class="badge badge-warning">Sore</span>';
    }
  }
}

if (!function_exists('getImgDokter')) {
  function getImgDokter($img)
  {
    $dir = 'assets/drw/' . $img . '.jpg';
    if (file_exists($dir)) {
      return $dir;
    } else {
      return 'assets/drw/243.jpg';
    }
  }
}
