<?php
session_start();

$a = rand(1,10);
$b = rand(1,10);

$_SESSION['hasil'] = $a + $b;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link rel="stylesheet"
          href="../assets/css/style.css">

    <style>
        .auth-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-box {
            width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .auth-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .auth-box p {
            text-align: center;
            margin-top: 15px;
        }

        .auth-box a {
            color: #2563eb;
            text-decoration: none;
        }
    </style>

</head>
<body>

<div class="auth-container">

    <div class="auth-box">

        <h2>Register PMB</h2>

        <?php if(isset($_SESSION['error'])) : ?>

            <div class="error-message">
                <?= $_SESSION['error']; ?>
            </div>

        <?php
        unset($_SESSION['error']);
        endif;
        ?>

        <form action="proses_register.php"
              method="POST">

            <label>Nama</label>

            <input type="text"
                   name="nama"
                   required>

            <label>Email</label>

            <input type="email"
                   name="email"
                   required>

            <label>Password</label>

            <input type="password"
                   name="password"
                   required>

            <label>
                Berapa <?= $a ?> + <?= $b ?> ?
            </label>

            <input type="number"
                   name="verifikasi"
                   required>

            <button type="submit">
                Register
            </button>

        </form>

        <p>
            Sudah punya akun?
            <a href="login.php">
                Login
            </a>
        </p>

    </div>

</div>

</body>
</html>