<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pertanyaan = $_POST['pertanyaan'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $jawaban = strtoupper($_POST['jawaban']);

    $stmt = $conn->prepare("INSERT INTO soal (pertanyaan, a, b, c, d, jawaban) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $pertanyaan, $a, $b, $c, $d, $jawaban);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<form method="post" style="padding: 30px;">
  <h2>Tambah Soal</h2>
  <p><textarea name="pertanyaan" rows="3" cols="60" required></textarea></p>
  <p>A: <input type="text" name="a" required></p>
  <p>B: <input type="text" name="b" required></p>
  <p>C: <input type="text" name="c" required></p>
  <p>D: <input type="text" name="d" required></p>
  <p>Jawaban Benar: <input type="text" name="jawaban" maxlength="1" required></p>
  <button type="submit">Simpan</button>
</form>
