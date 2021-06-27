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
if (isset($_POST['height'])) {
    if (validate($_POST['height'], 'Высота')) {
        echo validate($_POST['height'], 'Высота');
    } else {
        $height = $_POST['height'];
    }
}
if (isset($_POST['width'])) {
    if (validate($_POST['width'], 'Ширина')) {
        echo validate($_POST['width'], 'Ширина');
    } else {
        $width = $_POST['width'];
    }
}
if ($height && $width) {
    render_chess($height, $width);
} else {
    render_chess(8, 8);
}
render_form($height, $width);

function render_form($height, $width)
{
    ?>
    <form action="" method="post">
        Высота: <input type="text" name="height" value="<?php echo $height ?>" placeholder="8">
        Ширина: <input type="text" name="width" value="<?php echo $width ?>" placeholder="8">
        <button type="submit">Выполнить</button> 
    </form>
    <br>
    <?php
}

function render_chess($height, $width)
{ 
    $caption_width = array(" ", "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $chess = '<table cellspacing="0px" cellpadding="0px" border="1px">';
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
}

function validate($data, $param)
{
    $errors = '';
    if (is_numeric($data)) {
        if ($data > 0 && $data < 21) {
        } else {
            $errors .= $param.' неправильная. Можно вводить только числа от 1 до 20!<br>';
        }
    } else {
        $errors .= $param.' неправильная. Можно вводить только числа!<br>';
    }
    return $errors;
}

function debug($arr) 
{
    echo "<pre>" . print_r($arr, true) . "</pre>";
}
?>
</table>
</body>
</html>