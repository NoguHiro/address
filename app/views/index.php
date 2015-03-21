<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h2>超適当なアドレス帳</h2>

<table style="width:980px;margin:0 auto;">
    <tr>
        <th>名前</th>
        <th>住所</th>
        <th>電話番号</th>
        <th>操作</th>
    </tr>
    <?php foreach($addresses as $row): ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['tel'] ?></td>
            <td>
                <a href="?c=address&m=detail&page=<?= $row['id'] ?>">詳細</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>

<style>
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }
    table th {
        background:#EEE;
    }
    table th,
    table td {
        border:1px solid #ccc;
    }
</style>
</body>
</html>