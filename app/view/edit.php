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
<form action= "#" method= "POST">
<table class="brd">
    <tr>
        <td>Name: </td>
        <td><input type= "text" name= "name"<td>
    </tr>
    <tr>
        <td>Surname: </td>
        <td><input type= "text" name= "surname"></td>
    </tr>
    <tr>
        <td>sex: </td>
        <td><input type= "text" name= "sex"></td>
    </tr>
    <tr>
        <td>group: </td>
        <td><input type= "text" name= "group"></td>
    </tr>
    <tr>
        <td>age: </td>
        <td><input type= "text" name= "age"></td>
    </tr>
    <tr>
        <td>faculty: </td>
        <td><input type= "text" name= "faculty"></td>
    </tr>
</table>
    <input type= "submit" value= "save">
    <a href="/list">Back</a>
</form>
</body>
</html>

