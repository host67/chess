<!DOCTYPE html>
<html> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Доска</title>
</head>
<body> 
<h3>Доска</h3>
<h4>Выберите тип доски  и укажите размеры</h4>
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
    render_board($_POST['type-board'], $height, $width);
} else {
    render_board('chess', 8, 8);
}
render_form($_POST['type-board'], $height, $width);

function render_form($type_board, $height, $width)
{
    ?>
    <form action="" method="post">
        Тип доски:<br>
        <input type="radio" name="type-board" value="chess" <?php if($type_board == 'chess') echo 'checked' ?>  required> Шахматная клетка<br>
        <input type="radio" name="type-board" value="vertical" <?php if($type_board == 'vertical') echo 'checked' ?>>Вертикальные полоски<br>
        <input type="radio" name="type-board" value="horizontal" <?php if($type_board == 'horizontal') echo 'checked' ?>>Горизонтальные полоски<br>
        Высота: <input type="text" name="height" value="<?php echo $height ?>" placeholder="8">
        Ширина: <input type="text" name="width" value="<?php echo $width ?>" placeholder="8"><br>
        <button type="submit">Сформировать</button><br><br>
    </form>
    <?php
}

function render_board($type_board, $height, $width)
{
    $caption_width = array(" ", "A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    $board = '<table cellspacing="0px" cellpadding="0px" border="1px">';
    
    switch ($type_board) {
    case 'chess':
        for($row=1;$row<=$height;$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$width;$col++) {
                $total = $row+$col;
                if($total%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        break;
    case 'vertical':
        for($row=1;$row<=$height;$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$width;$col++) {
                if($col%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        break;
    case 'horizontal':
        for($row=1;$row<=$height;$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$width;$col++) {
                if($row%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        break;
}

    $board .= '<tr>';

    for($col2=0;$col2<=$width;$col2++) {
        if ($col2 == 0) {
            $board .= '<td class="no-border"></td>';
        } else {
            $board .= '<td class="no-border">'.$caption_width[$col2].'</td>';
        }
    }

    $board .= '</tr></table>';
    echo $board;
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
</body>
</html>