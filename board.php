<?php
/**
 * Game Of Life
 *
 * @author     Alejandro Franco Rojas <alejandro.f.rojas@gmail.com>
 */

include 'src/GameOfLife.php';
$gol = new GameOfLife();
$gol->setBoardRequest($_GET['board']);
echo $gol->move();
