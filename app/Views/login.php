<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 350px;
            padding: 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .login-box label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            background: #28a745;
            border: none;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-box button:hover {
            background: #218838;
        }

        .error-msg {
            text-align: center;
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if (!empty($error)) { ?>
            <p class="error-msg"><?= $error ?></p>
        <?php } ?>
        <form method="POST" action="<?php echo base_url();?>/auth/dologin">
            <label for="email">User name</label>
            <input type="text" id="email" name="username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
<?php if (session()->getFlashdata('message')): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Logged Out',
    text: '<?= session()->getFlashdata('message') ?>',
    timer: 3000,
    showConfirmButton: false
});
</script>
<?php endif; ?>
