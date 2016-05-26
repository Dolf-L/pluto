<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Таблица</title>
    <style type="text/css">
        table {
            border-collapse: collapse;
        }
        table th,
        table td {
            padding: 0 3px;
        }
        table.brd th,
        table.brd td {
            border: 1px solid #000;
        }
    </style>
</head>
<body>
<table class="brd">
    <tr>
        <th>№</th>
        <th>Name</th>
        <th>surname</th>
        <th>sex</th>
        <th>group</th>
        <th>age</th>
        <th>faculty</th>
    </tr>
    <?php $number = 1;
    foreach($list as $ListItem): ?>
    <tr>
        <td><?php echo $number++ ?></td>
        <td><?php echo $ListItem['name'] ?></td>
        <td><?php echo $ListItem['surname'] ?></td>
        <td><?php echo $ListItem['sex'] ?></td>
        <td><?php echo $ListItem['group'] ?></td>
        <td><?php echo $ListItem['age'] ?></td>
        <td><?php echo $ListItem['faculty'] ?></td>
        <td>
            <a href="/list/UpdateStudent/<?php echo $ListItem['id'];?>">
                <i>update</i>
            </a>
        </td>
        <td>
            <a href="/list/delete/<?php echo $ListItem['id'];?>">
                <i>delete</i>
            </a>
        </td>
    </tr>
    <?php endforeach;?>
</table>
    <a href="/list/addNewStudent">
        <i>add new student</i>
    </a>
</body>
</html>