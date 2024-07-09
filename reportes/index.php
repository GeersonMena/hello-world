<?php
    ini_set("display_errors", 1);
    $numFilas=5; //Esta linea configura cuantos numeros de filas se veran al llamar el reporte por primera vez.
    if (isset($_REQUEST['fil'])) 
        $numFilas=$_REQUEST['fil'];
    include 'view/operacionesView.php';
    $vista= new OperacionesView();
    $vista->presentaOperaciones();

?>