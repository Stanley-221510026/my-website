<?php
include "config.php";

$error = "";
$success = "";

// LOGIN
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        $hashOk = password_verify($password, $user['password']);
        $md5Ok  = (strlen($user['password']) === 32 && md5($password) === $user['password']);

        if ($hashOk || $md5Ok) {
            $_SESSION['user'] = $user;

            // Optional: jika berhasil login via MD5, upgrade password ke password_hash
            if ($md5Ok) {
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
                $stmt->bind_param("si", $newHash, $user['id']);
                $stmt->execute();
            }

            $redirect = ($user['role'] === 'admin') ? "admin/index.php" : "index.php";
            header("Location: $redirect");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}


// SIGNUP
if (isset($_POST['signup'])) {
    $username = trim($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $cek = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($cek->num_rows > 0) {
        $error = "Username sudah digunakan.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'siswa')");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        // Auto login setelah daftar
        $_SESSION['user'] = [
            'username' => $username,
            'role' => 'siswa'
        ];
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login & Daftar</title>
  <style>
    body {
      font-family: sans-serif;
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .box {
      background: white;
      padding: 30px;
      border-radius: 10px;
      width: 360px;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    input[type="text"], input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      width: 100%;
      background: #007bff;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .toggle {
      margin-top: 10px;
      text-align: center;
    }
    .toggle a {
      color: #007bff;
      cursor: pointer;
      text-decoration: none;
    }
    .msg {
      text-align: center;
      color: red;
      margin-bottom: 10px;
    }
    .success {
      color: green;
    }
  </style>
</head>
<body>

<div class="box">
  <h2 id="formTitle">Login</h2>

  <?php if ($error) echo "<div class='msg'>$error</div>"; ?>
  <?php if ($success) echo "<div class='msg success'>$success</div>"; ?>

  <!-- Login Form -->
  <form method="post" id="formLogin">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button name="login" type="submit">Login</button>
  </form>

  <!-- Signup Form -->
  <form method="post" id="formSignup" style="display:none;">
    <input type="text" name="username" placeholder="Username Baru" required>
    <input type="password" name="password" placeholder="Password Baru" required>
    <button name="signup" type="submit">Daftar</button>
  </form>

  <div class="toggle">
    <a onclick="toggleForm()">Belum punya akun? Daftar</a>
  </div>
</div>

<script>
  const loginForm = document.getElementById("formLogin");
  const signupForm = document.getElementById("formSignup");
  const toggleLink = document.querySelector(".toggle a");
  const formTitle = document.getElementById("formTitle");

  function toggleForm() {
    if (signupForm.style.display === "none") {
      signupForm.style.display = "block";
      loginForm.style.display = "none";
      toggleLink.innerText = "Sudah punya akun? Login";
      formTitle.innerText = "Daftar";
    } else {
      signupForm.style.display = "none";
      loginForm.style.display = "block";
      toggleLink.innerText = "Belum punya akun? Daftar";
      formTitle.innerText = "Login";
    }
  }
</script>

</body>
</html>
