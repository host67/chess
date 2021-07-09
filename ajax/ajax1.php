<?php
$arrSize = array('width'=>$_POST['width'], 'height'=>$_POST['height']);
$objValidator = new Validator(array('maxWidth'=>20, 'maxHeight'=>20));

switch ($_POST['type-board']) {
    case 'chess':
        $obj = new Chess();
        break;
    case 'horizontal':
        $obj = new HorizontalStripes();
        break;
    case 'vertical':
        $obj = new VerticalStripes();
        break;
}

$obj->setValidator($objValidator); // Удалить для отключения валидатора
$obj->setSize($arrSize);
$errors = $objValidator->getErrors();

if (empty($errors)) {
    echo $obj->generateBoard();
} else {
    print_r($errors);
}

abstract class Board
{
    private $width  = 8;
    private $height = 8;
    private $objValidator;
    private $horizontTitle = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T");
    
    public function setSize($arrSize)
    {
        if ($arrSize['width']) $this->width = $arrSize['width'];
        if ($arrSize['height']) $this->height = $arrSize['height'];
        if ($this->objValidator) {
            $this->objValidator->validate($arrSize);
        }
    }

    public function setValidator($objValidator)
    {
        $this->objValidator =  $objValidator;
    }

    public function getSize()
    {
        return array('width'=>$this->width, 'height'=>$this->height, 'horizontTitle'=>$this->horizontTitle);
    }
}

class Chess extends Board
{
    public function generateBoard()
    {
        $arrSize = $this->getSize();
        array_unshift($arrSize['horizontTitle'], " ");
        $board = '<table cellspacing="0px" cellpadding="0px" border="1px">';
        for($row=1;$row<=$arrSize['height'];$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$arrSize['width'];$col++) {
                $total = $row+$col;
                if($total%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        $board .= '<tr>';
        for($col2=0;$col2<=$arrSize['width'];$col2++) {
            if ($col2 == 0) {
                $board .= '<td class="no-border"></td>';
            } else {
                $board .= '<td class="no-border">'.$arrSize['horizontTitle'][$col2].'</td>';
            }
        }
        $board .= '</tr></table>';
        return $board;
    }
}

class HorizontalStripes extends Board
{
    public function generateBoard()
    {
        $arrSize = $this->getSize();
        array_unshift($arrSize['horizontTitle'], " ");
        $board = '<table cellspacing="0px" cellpadding="0px" border="1px">';
        for($row=1;$row<=$arrSize['height'];$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$arrSize['width'];$col++) {
                if($row%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        $board .= '<tr>';
        for($col2=0;$col2<=$arrSize['width'];$col2++) {
            if ($col2 == 0) {
                $board .= '<td class="no-border"></td>';
            } else {
                $board .= '<td class="no-border">'.$arrSize['horizontTitle'][$col2].'</td>';
            }
        }
        $board .= '</tr></table>';
        return $board;
    }
}

class VerticalStripes extends Board
{
    public function generateBoard()
    {
        $arrSize = $this->getSize();
        array_unshift($arrSize['horizontTitle'], " ");
        $board = '<table cellspacing="0px" cellpadding="0px" border="1px">';
        for($row=1;$row<=$arrSize['height'];$row++) {
            $board .= '<tr><td class="caption-height">'.$row.'</td>';
            for($col=1;$col<=$arrSize['width'];$col++) {
                if($col%2==0) {
                    $board .= '<td class="td-white"></td>';
                } else {
                    $board .= '<td class="td-black"></td>';
                }
            }
            $board .= '</tr>';
        }
        $board .= '<tr>';
        for($col2=0;$col2<=$arrSize['width'];$col2++) {
            if ($col2 == 0) {
                $board .= '<td class="no-border"></td>';
            } else {
                $board .= '<td class="no-border">'.$arrSize['horizontTitle'][$col2].'</td>';
            }
        }
        $board .= '</tr></table>';
        return $board;
    }
}

class Validator
{
    private $maxWidth  = 40;
    private $maxHeight = 40;
    private $errors    = array();

    public function __construct($arrMaxSize)
    {
        $this->maxWidth  = $arrMaxSize['maxWidth'];
        $this->maxHeight = $arrMaxSize['maxHeight'];
    }

    public function validate($arrSize)
    {
        $res = false;
        if ($arrSize['width']  > $this->maxWidth)  $this->errors[] = 'Ширина больше максимальной!<br>';
        if ($arrSize['height'] > $this->maxHeight) $this->errors[] = 'Высота больше максимальной!<br>';
        if (count($this->errors) == 0) $res = true;
        return $res;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
