<?php

require 'classes/Database.php';
require 'classes/Post.php';

$db = new Database();
$conn = $db->getConn();


$sql = "SELECT DATE(post.create_at) as date , HOUR(post.create_at) as hour, COUNT(post.post_id) as count_post
        FROM post
        GROUP BY date , hour; ";

$results = $conn->query($sql);

$array =  $results->fetchAll(PDO::FETCH_ASSOC);
//  var_dump($array);

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Post Data</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border: 1px solid #dddddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Hour</th>
            <th>Count Post</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($array as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['date']); ?></td>
            <td><?= htmlspecialchars($row['hour']); ?></td>
            <td><?= htmlspecialchars($row['count_post']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="index.php"> Home </a></p>

</body>
</html>
