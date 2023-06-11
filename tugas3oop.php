<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    
    <style>
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        .login-form {
            width: 100%;
            max-width: 550px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: login.php");
        exit();
    }
?>
    <div class="container">
        <div class="row login-container">
            <div class="col-sm-12 login-form">
                <div class="card">
                    <article class="card-body">
                        <h4 class="card-title mb-4 mt-1">Input Nilai</h4>
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Nama</label>
                                <input name="nama" class="form-control" placeholder="Nama" type="text" id="nama">
                            </div> <!-- form-group// -->
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Matematika</label>
                                        <input name="nilai1" class="form-control" placeholder="Nilai" type="number" id="nilai1">
                                    </div> <!-- form-group// -->
                                    <div class="form-group">
                                        <label>Sejarah</label>
                                        <input name="nilai2" class="form-control" placeholder="Nilai" type="number" id="nilai2">
                                    </div> <!-- form-group// -->
                                    <div class="form-group">
                                        <label>DPK</label>
                                        <input name="nilai3" class="form-control" placeholder="Nilai" type="number" id="nilai3">
                                    </div> <!-- form-group// -->
                                </div> <!-- col.// -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>PIPAS</label>
                                        <input name="nilai4" class="form-control" placeholder="Nilai" type="number" id="nilai4">
                                    </div> <!-- form-group// -->
                                    <div class="form-group">
                                        <label>Informatika</label>
                                        <input name="nilai5" class="form-control" placeholder="Nilai" type="number" id="nilai5">
                                    </div> <!-- form-group// -->
                                    <div class="form-group">
                                        <label>B. Inggris</label>
                                        <input name="nilai6" class="form-control" placeholder="Nilai" type="number" id="nilai6">
                                    </div> <!-- form-group// -->
                                </div> <!-- col.// -->
                            </div> <!-- row.// -->
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div> <!-- form-group// -->                                                           
                        </form>
                    </article>
                </div> <!-- card.// -->
            </div> <!-- col.// -->
        </div> <!-- row.// -->
    </div> <!-- container// -->
    <center>
    <?php
    class Nilai {
        private $nama;
        private $nilai1;
        private $nilai2;
        private $nilai3;
        private $nilai4;
        private $nilai5;
        private $nilai6;
    
        public function __construct($nama, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6) {
            $this->nama = $nama;
            $this->nilai1 = $nilai1;
            $this->nilai2 = $nilai2;
            $this->nilai3 = $nilai3;
            $this->nilai4 = $nilai4;
            $this->nilai5 = $nilai5;
            $this->nilai6 = $nilai6;
        }
    
        public function nama() {
            return $this->nama;
        }
    
        public function total() {
            return $this->nilai1 + $this->nilai2 + $this->nilai3 + $this->nilai4 + $this->nilai5 + $this->nilai6;
        }
    
        public function ratarata() {
            $rata = ($this->nilai1 + $this->nilai2 + $this->nilai3 + $this->nilai4 + $this->nilai5 + $this->nilai6)/6;
            return round($rata);
        }
    
        public function nilaimax() {
            return max($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
        }
    
        public function nilaimin() {
            return min($this->nilai1, $this->nilai2, $this->nilai3, $this->nilai4, $this->nilai5, $this->nilai6);
        }
    
        public function grade() {
            $rata = $this->ratarata();
    
            if ($rata > 90) {
                return "A";
            } elseif ($rata > 80) {
                return "B";
            } elseif ($rata > 70) {
                return "C";
            } elseif ($rata > 0) {
                return "D";
            }
        }
    }
    
    include "koneksi.php";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
        $nama = $_POST['nama'];
        $nilai1 = $_POST['nilai1'];
        $nilai2 = $_POST['nilai2'];
        $nilai3 = $_POST['nilai3'];
        $nilai4 = $_POST['nilai4'];
        $nilai5 = $_POST['nilai5'];
        $nilai6 = $_POST['nilai6'];
    
        $nilaihasil = new Nilai($nama, $nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6);
    
        $sql = "INSERT INTO `nilai`(`nama`, `nilai1`, `nilai2`, `nilai3`, `nilai4`, `nilai5`, `nilai6`) VALUES ('$nama','$nilai1','$nilai2','$nilai3','$nilai4','$nilai5','$nilai6')";
        $hasil = mysqli_query($conn, $sql);
    
        if ($hasil) {
            echo "Berhasil";
        } else {
            echo "Gagal";
        }
    
        // Output hasil nilai dalam bentuk card
        echo "<br>";
        echo "<div style='width: 300px; border: 1px solid #ccc; border-radius: 4px; padding: 10px;'>";
        echo "<h2>Hasil Nilai</h2>";
        echo "<p><strong>Nama:</strong> " . $nilaihasil->nama() . "</p>";
        echo "<p><strong>Total:</strong> " . $nilaihasil->total() . "</p>";
        echo "<p><strong>Rata-Rata:</strong> " . $nilaihasil->ratarata() . "</p>";
        echo "<p><strong>Nilai Max:</strong> " . $nilaihasil->nilaimax() . "</p>";
        echo "<p><strong>Nilai Min:</strong> " . $nilaihasil->nilaimin() . "</p>";
        echo "<p><strong>Grade Penilaian:</strong> " . $nilaihasil->grade() . "</p>";
        echo "</div>";
    
        echo "<br>";
        echo "<a href='tampil.php'>Lihat Daftar Nilai</a>";
        echo "<br>";
        echo "<a href='hapus.php?nis=$nama'>Hapus Nilai</a>";
        echo "<br>";
    }
    ?><a href="logout.php">Logout?</a>
</center>
</body>
</html>