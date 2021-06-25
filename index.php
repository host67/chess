<!DOCTYPE html>
<html> 
<head> 
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body> 
<h3>Шахматная доска с использованием цикла For</h3>
<form action="" method="post">
    Высота: <input type="text" name="height" placeholder="8">
    Ширина: <input type="text" name="widht" placeholder="8">
    <button type="submit">Выполнить</button> 
</form>
<br>
<table style="max-width:100%;text-align:center" cellspacing="0px" cellpadding="0px" border="1px">
<?php
$height = $width = 8;
if ($_POST['height']) $height = $_POST['height'];
if ($_POST['widht']) $width = $_POST['widht'];

$alfabet = array("A","B","C","D","E","F","G","H","I","J", "K", "L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
$caption_width = [];

while (count($caption_width) < $width) {
    $caption_width = array_merge($caption_width, $alfabet);
}

array_unshift( $caption_width, "");

for($row=1;$row<=$height;$row++) {
    echo '<tr><td style="border:none;width:25px">'.$row.'</td>';
    for($col=1;$col<=$width;$col++) {
        $total = $row+$col;
        if($total%2==0) {
            echo "<td height=25px width=25px bgcolor=#FFFFFF></td>";
        } else {
        echo "<td height=25px width=25px bgcolor=#000000></td>";
        }
    }
    echo "</tr>";
}

echo '<tr>';

for($col2=0;$col2<=$width;$col2++) {
    if ($col2 == 0) {
        echo '<td style="border:none;"></td>';
    } else {
        echo '<td style="border:none;">'.$caption_width[$col2].'</td>';
    }
}

echo '</tr>';

function debug($arr) {
    echo "<pre>" . print_r($arr, true) . "</pre>";
}
?>
</table>
</body>
</html>