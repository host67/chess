<!DOCTYPE html>
<html> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Доска</title>
</head>
<body> 
<h3>Доска</h3>
<h4>Выберите тип доски  и укажите размеры</h4>
<form action="" method="post">
    Тип доски:<br>
    <input type="radio" name="type-board" value="chess" <?php if($type_board == 'chess') echo 'checked' ?>  required> Шахматная клетка<br>
    <input type="radio" name="type-board" value="horizontal" <?php if($type_board == 'horizontal') echo 'checked' ?>>Горизонтальные полоски<br>
    <input type="radio" name="type-board" value="vertical" <?php if($type_board == 'vertical') echo 'checked' ?>>Вертикальные полоски<br>
    Высота: <input type="text" name="height" value="<?php echo $height ?>" placeholder="8">
    Ширина: <input type="text" name="width" value="<?php echo $width ?>" placeholder="8"><br>
    <button id="button" type="submit">Сформировать</button><br><br>
</form>
<div id="result"></div>

<script>
$("form").submit(function(e) {
  e.preventDefault();
  let radios = document.querySelectorAll('input[type="radio"]');
  var typeBoard;
  var width = $('[name="width"]').val();
  var height = $('[name="height"]').val();
  var elem = document.getElementById("result");
  for (let radio of radios) {
    if (radio.checked) {
      typeBoard = radio.value;
    }
  }
  $.ajax({
    url: "http://chess.host67.p-host.in/ajax/ajax1.php",
    method: "POST",
    cache: false,
    dataType: "html",
    data: {"type-board": typeBoard, width: width, height: height},
    beforeSend: function() {
      elem.innerHTML = "";
      $("#result").append('<img src="preloader.gif"/>');
    },
    success: function(data) {
        elem.innerHTML = data;
    }
  });
});
</script>
</body>
</html>