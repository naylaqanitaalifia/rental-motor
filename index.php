<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rental Motor</title>
  <!-- Font Link -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- CSS Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container col-8 p-5 my-5">
      <?php 
      class rentalMotor {
        private $namaPelanggan;
        private $waktuRental;
        private $jenisMotor;
        private $namaMember = array("Meera", "Haksa", "Nirmala", "Ignazio", "Kara");
        private $hargaRental = array(
          "Skuter" => 70000,
          "Cruiser" => 150000,
          "Klasik" => 130000,
          "Matic" => 90000
        );

        private $pajak = 10000;

        function __construct($namaPelanggan, $waktuRental, $jenisMotor) {
          $this->namaPelanggan = $namaPelanggan;
          $this->waktuRental = $waktuRental;
          $this->jenisMotor = $jenisMotor;
        }

        function hitungHarga() {
          $diskon = 0;
          if (in_array($this->namaPelanggan, $this->namaMember)) {
            $diskon = $this->hargaRental[$this->jenisMotor] * 0.05;
          }
          $harga = ($this->hargaRental[$this->jenisMotor] * $this->waktuRental) + $this->pajak;
          $harga = $harga - $diskon;
          return $harga;
        }

        function buktiTransaksi() {
          $member = in_array($this->namaPelanggan, $this->namaMember) ? "Member" : "Non Member";
          $diskon = $member == "Member" ? "mendapatkan diskon sebesar 5%" : "";
          $hargaRental = $this->hargaRental[$this->jenisMotor];
          $totalHarga = $this->hitungHarga();

          return "<b>" . $this->namaPelanggan . " </b>berstatus sebagai <b>" . $member . $diskon . "</b> <br> Jenis motor yang dirental adalah <b>" . $this->jenisMotor . "</b> selama <b>" . $this->waktuRental . " hari </b> <br> Harga rental per harinya <b>Rp" . number_format($hargaRental, 2, ',', '.') . "</b><br><br> Besar yang harus dibayarkan adalah <b>Rp" . number_format($totalHarga, 2, ',', '.') . "</b>";
        }
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $namaPelanggan = $_POST["namaPelanggan"];
        $waktuRental = $_POST["waktuRental"];
        $jenisMotor = $_POST["jenisMotor"];
        $rental = new rentalMotor($namaPelanggan, $waktuRental, $jenisMotor);
      }
      ?>

      <div class="row justify-content-center">
        <div class="col-md-8">
          <h1 class="text-center">Rental Motor</h1>
          <form action="" method="post">
            <div class="form-group mb-3">
              <label for="namaPelanggan" class="form-label">Nama Pelanggan</label>
              <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan" placeholder="Masukkan nama pelanggan" required>
            </div>
            <div class="form-group mb-3">
              <label for="waktuRental" class="form-label">Lama Waktu Rental (per hari)</label>
              <input type="number" class="form-control" id="waktuRental" name="waktuRental" placeholder="Masukkan lama waktu rental" required>
            </div>
            <div class="form-group mb-3">
              <label for="jenisMotor" class="form-label">Jenis Motor</label>
              <select name="jenisMotor" id="jenisMotor" class="form-control" required>
                <option value="" disabled selected hidden>Pilih jenis motor</option>
                <option value="Skuter">Skuter</option>
                <option value="Cruiser">Cruiser</option>
                <option value="Klasik">Klasik</option>
                <option value="Matic">Matic</option>
              </select>
            </div>
              <button type="submit" class="btn btn-custom mb-3 w-100">Kirim</button>
          </form>
        </div>
      </div>
      <?php 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
      ?>
        <div class="row justify-content-center">
          <div class="col-md-8 text-center border custom-border border-2 p-3">
            <p><?php echo $rental->buktiTransaksi(); ?></p>
          </div>
        </div>
      <?php 
  }
  ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>