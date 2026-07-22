<?php

declare(strict_types=1);

session_start();

if (!isset($_SESSION["auth"])) {
    header("Location: login.php");
    exit;
}

require_once "data.php";

if (!isset($_SESSION["orders"])) {
    $_SESSION["orders"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sku = trim($_POST["sku"] ?? "");
    $qty = (int)($_POST["qty"] ?? 0);

    if ($sku !== "" && $qty > 0) {

        $_SESSION["orders"][] = [
            "sku" => $sku,
            "qty" => $qty
        ];
    }

    header("Location: dashboard.php");
    exit;
}

function h(string $str): string
{
    return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>

<body>

<h2>MiniShop Dashboard</h2>

<p>
Xin chào:
<b><?= h($_SESSION["username"]) ?></b>
</p>

<p>
<a href="logout.php">Đăng xuất</a>
</p>

<h3>
Tổng kho:
<?= $totalInventory ?>
</h3>

<table border="1" cellpadding="5" cellspacing="0">

    <tr>
        <th>SKU</th>
        <th>Tên</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
        <th>Mức tồn</th>
    </tr>

    <?php foreach ($productObjects as $p): ?>

    <tr>

        <td><?= h($p->sku) ?></td>

        <td><?= h($p->name) ?></td>

        <td><?= h($categoryMap[$p->categoryId]) ?></td>

        <td><?= $p->price ?></td>

        <td><?= $p->qty ?></td>

        <td><?= $p->lineTotal() ?></td>

        <td><?= h($p->stockLevel()) ?></td>

    </tr>

    <?php endforeach; ?>

</table>

<hr>

<h3>Đặt hàng</h3>

<form method="post">

    <select name="sku">

        <?php foreach ($productObjects as $p): ?>

            <option value="<?= h($p->sku) ?>">
                <?= h($p->sku) ?> - <?= h($p->name) ?>
            </option>

        <?php endforeach; ?>

    </select>

    <input
        type="number"
        name="qty"
        value="1"
        min="1"
        required
    >

    <button type="submit">
        Thêm
    </button>

</form>

<hr>

<h3>Danh sách Order</h3>

<table border="1" cellpadding="5">

    <tr>
        <th>SKU</th>
        <th>Số lượng</th>
    </tr>

    <?php foreach ($_SESSION["orders"] as $order): ?>

    <tr>

        <td><?= h($order["sku"]) ?></td>

        <td><?= $order["qty"] ?></td>

    </tr>

    <?php endforeach; ?>

</table>

</body>
</html>