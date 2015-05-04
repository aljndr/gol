<?php
/**
 * Game Of Life
 *
 * @author     Alejandro Franco Rojas <alejandro.f.rojas@gmail.com>
 */
?>
<?php include 'gol.php';?>
<!DOCTYPE html>
<html>
    <head>
        <title>Game Of Life</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/main.js"></script>    
    </head>
    <body tyle="background-color:#4D484B;">
        <div class="header">
          <div class="header-content">Game of life</div>
        </div>
        <div class="container">
          <div class="board">
           <?php 
              $a = new GameOfLife();
              echo $a->move();
           ?>
          </div>
          <div class="controls">
            <div class="step" >Paso Adelante</div>
            <div class="reset">Reiniciar</div>
          </div>
        </div>
        <div class="footer"></div>
    </body>
</html>