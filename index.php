<!DOCTYPE html>
<html> 
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body> 
<h3>Шахматная доска с использованием цикла For</h3>
<form action="" method="post">
    <input type="text" name="height" placeholder="Высота" required>
    <input type="text" name="widht" placeholder="Ширина" required>
    <button type="submit">Выполнить</button> 
</form>
<br>
<table width="225px" cellspacing="0px" cellpadding="0px" border="1px">
<?php
for($row=1;$row<=$_POST['height'];$row++) {
    echo "<tr>";
    for($col=1;$col<=$_POST['widht'];$col++) {
        $total = $row+$col;
        if($total%2==0) {
            echo "<td height=25px width=25px bgcolor=#FFFFFF></td>";
        } else {
        echo "<td height=25px width=25px bgcolor=#000000></td>";
        }
    }
    echo "</tr>";
}
?>
</table>
</body>
</html>


