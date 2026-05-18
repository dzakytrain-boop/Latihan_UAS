<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

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

        <h2>Login PMB</h2>

        <?php if(isset($_SESSION['success'])) : ?>

            <div class="success-message">
                <?= $_SESSION['success']; ?>
            </div>

        <?php
        unset($_SESSION['success']);
        endif;
        ?>

        <form action="proses_login.php"
              method="POST">

            <label>Email</label>

            <input type="email"
                   name="email"
                   required>

            <label>Password</label>

            <input type="password"
                   name="password"
                   required>

            <button type="submit">
                Login
            </button>

        </form>

        <p>
            Belum punya akun?
            <a href="register.php">
                Register
            </a>
        </p>

    </div>

</div>

</body>
</html>