<?php
include "../config.php";

$id = $_GET['id'];
$soal = $conn->query("SELECT * FROM soal WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pertanyaan = $_POST['pertanyaan'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $jawaban = strtoupper($_POST['jawaban']);

    $stmt = $conn->prepare("UPDATE soal SET pertanyaan=?, a=?, b=?, c=?, d=?, jawaban=? WHERE id=?");
    $stmt->bind_param("ssssssi", $pertanyaan, $a, $b, $c, $d, $jawaban, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<form method="post" style="padding: 30px;">
  <h2>Edit Soal</h2>
  <p><textarea name="pertanyaan" rows="3" cols="60" required><?php echo $soal['pertanyaan']; ?></textarea></p>
  <p>A: <input type="text" name="a" value="<?php echo $soal['a']; ?>" required></p>
  <p>B: <input type="text" name="b" value="<?php echo $soal['b']; ?>" required></p>
  <p>C: <input type="text" name="c" value="<?php echo $soal['c']; ?>" required></p>
  <p>D: <input type="text" name="d" value="<?php echo $soal['d']; ?>" required></p>
  <p>Jawaban Benar: <input type="text" name="jawaban" value="<?php echo $soal['jawaban']; ?>" maxlength="1" required></p>
  <button type="submit">Update</button>
</form>
