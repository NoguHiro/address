<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h2><?= $address['name'] ?>さんの詳細</h2>

<a href="./">戻る</a>
<table style="width:980px;margin:0 auto;">
    <tr>
        <th>名前</th>
        <th>住所</th>
        <th>電話番号</th>
    </tr>
        <tr>
            <td><?= $address['name'] ?></td>
            <td><?= $address['address'] ?></td>
            <td><?= $address['tel'] ?></td>
        </tr>
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