<?php

declare(strict_types=1);

session_start();

if (!empty($_SESSION['auth'])) {
    header("Location: dashboard.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($username == "admin" && $password == "MiniShop@03") {

        $_SESSION["auth"] = true;
        $_SESSION["username"] = $username;

        header("Location: dashboard.php");
        exit;

    } else {

        $error = "Sai tên đăng nhập hoặc mật khẩu";

    }
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
</head>
<body>

<h2>Đăng nhập</h2>

<?php if($error != ""): ?>
<p style="color:red"><?= h($error) ?></p>
<?php endif; ?>

<form method="post">

    Username:
    <input type="text" name="username" required>

    <br><br>

    Password:
    <input type="password" name="password" required>

    <br><br>

    <button type="submit">
        Đăng nhập
    </button>

</form>

</body>
</html>