<?php
require 'function.php';

$data = query("SELECT * FROM log");
// var_dump($data);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="table">
    <thead>
        <tr>
        <th scope="col" class="text-center" style="width:5%">#</th>
        <th scope="col" class="text-center">username</th>
        <th scope="col" class="text-center">nama file</th>
        <th scope="col" class="text-center">waktu upload</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $nomor = 1;
        foreach($data as $row) :?>
        <tr>
            <td class="text-center"><?= $nomor++ ?></td>
            <td class="text-center"><?= $row['idUser'] ?></td>
            <td class="text-center"><?= $row['name_file'] ?></td>
            <td class="text-center"><?= $row['timestamp'] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    </table>
</body>
</html>