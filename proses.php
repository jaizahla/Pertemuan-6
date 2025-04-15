<?php
session_start();

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}

$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Huscin Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

$maskapai = htmlspecialchars($_POST['maskapai']);
$asal = $_POST['asal'];
$tujuan = $_POST['tujuan'];
$harga = (int)$_POST['harga'];
$tanggal_keberangkatan = $_POST['tanggal_keberangkatan'];

if ($harga < 0) {
    die('<div class="alert alert-danger">Error: Harga tiket tidak boleh negatif!</div>');
}

$pajak_asal = $bandara_asal[$asal];
$pajak_tujuan = $bandara_tujuan[$tujuan];
$total_pajak = $pajak_asal + $pajak_tujuan;
$total_harga = $harga + $total_pajak;

function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

$tanggal_input = date('d/m/Y H:i:s');
$nomor = $_SESSION['counter'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hasil Pendaftaran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    .result-card { border-radius: 15px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
    .table th { background-color: #f8f9fa; }
    .total-row { font-weight: 600; }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="card result-card border-success">
          <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-check-circle-fill me-2"></i>Detail Penerbangan</h4>
          </div>
          <div class="card-body p-4">
            <div class="table-responsive">
              <table class="table table-bordered">
                <tr>
                  <th class="w-25">Nomor</th>
                  <td><?= $nomor ?></td>
                </tr>
                <tr>
                  <th>Tanggal Input</th>
                  <td><?= $tanggal_input ?></td>
                </tr>
                <tr>
                  <th>Tanggal Keberangkatan</th>
                  <td><?= date('d/m/Y', strtotime($tanggal_keberangkatan)) ?></td>
                </tr>
                <tr>
                  <th>Nama Maskapai</th>
                  <td><?= $maskapai ?></td>
                </tr>
                <tr>
                  <th>Bandara Asal</th>
                  <td><?= $asal ?> (Pajak: <?= formatRupiah($pajak_asal) ?>)</td>
                </tr>
                <tr>
                  <th>Bandara Tujuan</th>
                  <td><?= $tujuan ?> (Pajak: <?= formatRupiah($pajak_tujuan) ?>)</td>
                </tr>
                <tr>
                  <th>Harga Tiket</th>
                  <td><?= formatRupiah($harga) ?></td>
                </tr>
                <tr class="table-warning">
                  <th>Total Pajak</th>
                  <td><?= formatRupiah($total_pajak) ?></td>
                </tr>
                <tr class="table-success total-row">
                  <th>Total Harga</th>
                  <td><?= formatRupiah($total_harga) ?></td>
                </tr>
              </table>
            </div>

            <div class="d-flex justify-content-start mt-4">
              <a href="index.php" class="btn btn-outline-success">
                <i class="bi bi-arrow-left-circle me-2"></i>Kembali ke Form
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>