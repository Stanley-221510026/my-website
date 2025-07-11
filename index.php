<?php
include "config.php"; // sudah ada session_start()

// Proteksi: hanya siswa yang boleh akses
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'siswa') {
    header("Location: auth.php");
    exit();
}

// Ambil semua soal
$soal = $conn->query("SELECT * FROM soal");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ujian Online - Siswa</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f2f2f2; padding: 20px; }
    .container { max-width: 700px; margin: auto; background: #fff; padding: 30px; border-radius: 8px; }
    .logout { text-align: right; margin-bottom: 10px; }
    .logout a { color: red; text-decoration: none; }
    .soal { margin-bottom: 20px; }
    .soal p { font-weight: bold; }
    button { padding: 10px 15px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
  </style>
</head>
<body>
  <div class="container">
    <div class="logout">
      <a href="logout.php">Logout</a>
    </div>

    <h2>Halo, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</h2>
    <form method="post" action="nilai.php">
      <?php
      $no = 1;
      while ($row = $soal->fetch_assoc()) {
      ?>
        <div class="soal">
          <p><?= $no++ ?>. <?= htmlspecialchars($row['pertanyaan']) ?></p>
          <label><input type="radio" name="jawaban[<?= $row['id'] ?>]" value="A"> A. <?= htmlspecialchars($row['a']) ?></label><br>
          <label><input type="radio" name="jawaban[<?= $row['id'] ?>]" value="B"> B. <?= htmlspecialchars($row['b']) ?></label><br>
          <label><input type="radio" name="jawaban[<?= $row['id'] ?>]" value="C"> C. <?= htmlspecialchars($row['c']) ?></label><br>
          <label><input type="radio" name="jawaban[<?= $row['id'] ?>]" value="D"> D. <?= htmlspecialchars($row['d']) ?></label>
        </div>
      <?php
      } // end while
      ?>
      <button type="submit" name="submit">Kumpulkan Jawaban</button>
    </form>
  </div>
</body>
</html>
