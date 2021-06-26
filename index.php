<!DOCTYPE html>
<html> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Шахматная доска</title>
</head>
<body> 
<h3>Шахматная доска</h3>
<?php 
$height = $width = 8;
if ($_POST['height']) $height = $_POST['height'];
if ($_POST['width']) $width = $_POST['width'];
?>
<form action="" method="post">
    Высота: <input type="number" min="1" max="20" step="1" name="height" placeholder="<?php echo $height ?>">
    Ширина: <input type="number" min="1" max="20" step="1" name="width" placeholder="<?php echo $width ?>">
    <button type="submit">Выполнить</button> 
</form>
<br>
<table cellspacing="0px" cellpadding="0px" border="1px">
<?php
$caption_width = array("A","B","C","D","E","F","G","H","I","J", "K", "L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
array_unshift( $caption_width, "");

$chess = '';

for($row=1;$row<=$height;$row++) {
    $chess .= '<tr><td class="caption-height">'.$row.'</td>';
    for($col=1;$col<=$width;$col++) {
        $total = $row+$col;
        if($total%2==0) {
            $chess .= '<td class="td-white"></td>';
        } else {
        $chess .= '<td class="td-black"></td>';
        }
    }
    $chess .= '</tr>';
}

$chess .= '<tr>';

for($col2=0;$col2<=$width;$col2++) {
    if ($col2 == 0) {
        $chess .= '<td class="no-border"></td>';
    } else {
        $chess .= '<td class="no-border">'.$caption_width[$col2].'</td>';
    }
}

$chess .= '</tr>';
echo $chess;

function debug($arr) {
    echo "<pre>" . print_r($arr, true) . "</pre>";
}
?>
</table>
</body>
</html>