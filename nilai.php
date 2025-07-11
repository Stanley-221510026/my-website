<?php
include "config.php";

// Cek login siswa
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'siswa') {
    header("Location: login.php");
    exit();
}

// Cek kiriman jawaban
if (isset($_POST['submit'])) {
    $jawaban_user = $_POST['jawaban']; // array soal_id => jawaban
    $benar = 0;
    $salah = 0;

    $username = $_SESSION['user']['username'];

    foreach ($jawaban_user as $id_soal => $jawaban_siswa) {
        // Ambil kunci jawaban dari DB
        $query = $conn->query("SELECT jawaban FROM soal WHERE id = $id_soal");
        $data = $query->fetch_assoc();

        // Cek apakah benar
        $is_benar = strtoupper($jawaban_siswa) === strtoupper($data['jawaban']) ? 1 : 0;
        if ($is_benar) {
            $benar++;
        } else {
            $salah++;
        }

        // Simpan ke tabel jawaban_siswa
        $stmt = $conn->prepare("INSERT INTO jawaban_siswa (username, soal_id, jawaban, benar) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisi", $username, $id_soal, $jawaban_siswa, $is_benar);
        $stmt->execute();
    }

    $total = $benar + $salah;
    $nilai = $total > 0 ? round(($benar / $total) * 100) : 0;
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hasil Ujian</title>
    <style>
        body { font-family: Arial; background: #f4f6f9; padding: 40px; }
        .box {
            max-width: 400px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .nilai {
            font-size: 48px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="box">
        <h2>Hasil Ujian Anda</h2>
        <p>Benar: <strong><?php echo $benar; ?></strong></p>
        <p>Salah: <strong><?php echo $salah; ?></strong></p>
        <p class="nilai"><?php echo $nilai; ?>%</p>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>

