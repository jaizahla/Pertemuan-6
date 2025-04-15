<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Rute Penerbangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    .card { border-radius: 15px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
    .form-control, .form-select { border-radius: 8px; padding: 10px 15px; }
    .btn-submit { transition: all 0.3s; }
    .btn-submit:hover { transform: translateY(-2px); }
  </style>
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-success">
          <div class="card-header bg-success text-white">
            <h4 class="mb-0"><i class="bi bi-airplane-fill me-2"></i>Pendaftaran Rute Penerbangan</h4>
          </div>
          <div class="card-body p-4">
            <form action="proses.php" method="post" id="flightForm">
              <div class="mb-3">
                <label class="form-label fw-bold">Nama Maskapai</label>
                <input type="text" name="maskapai" class="form-control" placeholder="Contoh: Garuda Indonesia" required>
              </div>

              <div class="mb-3">
        <label class="form-label">Tanggal Penerbangan</label>
        <input type="date" name="tanggal" class="form-control" required>
      </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Bandara Asal</label>
                <select name="asal" class="form-select" required>
                  <?php
                  $bandara_asal = [
                      "Soekarno Hatta" => 65000,
                      "Huscin Sastranegara" => 50000,
                      "Abdul Rachman Saleh" => 40000,
                      "Juanda" => 30000
                  ];
                  ksort($bandara_asal);
                  foreach ($bandara_asal as $nama => $pajak) {
                      echo "<option value='$nama'>$nama</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="form-label fw-bold">Bandara Tujuan</label>
                <select name="tujuan" class="form-select" required>
                  <?php
                  $bandara_tujuan = [
                      "Ngurah Rai" => 85000,
                      "Hasanuddin" => 70000,
                      "Inanwatan" => 90000,
                      "Sultan Iskandar Muda" => 60000
                  ];
                  ksort($bandara_tujuan);
                  foreach ($bandara_tujuan as $nama => $pajak) {
                      echo "<option value='$nama'>$nama</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="mb-4">
                <label class="form-label fw-bold">Harga Tiket (Rp)</label>
                <input type="number" name="harga" class="form-control" min="0" placeholder="Contoh: 1500000" required>
              </div>

              <button type="submit" class="btn btn-success btn-submit w-100 py-2 fw-bold">
                <i class="bi bi-send-fill me-2"></i>Hitung Total Biaya
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('flightForm').addEventListener('submit', function() {
      const harga = document.querySelector('input[name="harga"]').value;
      if (harga < 0) {
        alert('Harga tiket tidak boleh negatif!');
        event.preventDefault();
      }
    });
  </script>
</body>
</html>