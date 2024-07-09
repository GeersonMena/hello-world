<?php
  include 'controller/operacionesController.php';
  $operController= new OperacionesController();
  class OperacionesView{
    function presentaOperaciones(){
      global $operController;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <style>
      @media (max-width:1920px) {
        #tabla-operaciones{
          font-size: 1vw;
        }
        #titulo-operaciones{
        font-size:1.2vw;
        }
      }
      @media (max-width:1000px) {
        #tabla-operaciones{
          font-size: 2.3vw;
        }
        #titulo-operaciones{
        font-size:2.8vw;
        }
      }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="view/resources/ico.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Tablero de Operaciones Previas al Despacho RODALL-Pintón</title>
  </head>
  <body class="p-3 mb-2 bg-secondary  text-white">
    <nav class="navbar bg-dark rounded">
      <div class="container-fluid bg-dark ">
        <a class="navbar-brand text-white text-truncate" href="">
          <img src="view/resources/logo.png" alt="Logo" width="70" height="24" class="d-inline-block align-text-top">
          Tablero de Operaciones por Despachar RODALL-Pintón
        </a>
      </div>
    </nav>
    <div class="position-relative pb-5 ">
      <div class="position-absolute pt-2 top-0 end-0">
        <nav aria-label="...">
          <ul class="pagination pagination-sm">
            Filas: &nbsp;
            <li class="page-item"><a class="page-link text-black" href="index.php?fil=5">5</a></li>
            <li class="page-item"><a class="page-link text-black" href="index.php?fil=10">10</a></li>
            <li class="page-item"><a class="page-link text-black" href="index.php?fil=15">15</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="table-responsive pt-3 ">
      <table id="tabla-operaciones"  class="table table-dark table-rounded">
        <thead>
          <tr>
            <th scope="col" class="col-1" >Referencia</th>
            <th scope="col">Cliente</th>
            <!-- <th scope="col" style="font-size:1vw;">Ejecutiva</th> -->
            <th scope="col" >Estado</th>
            <th scope="col" >Comentarios</th>
          </tr>
        </thead>
        <tbody>
          <?php
            if (isset($_REQUEST['nav']))
                $nav=$_REQUEST['nav'];
            else 
              $nav=1;
            global $numFilas;
            $inicio=(($nav-1)*$numFilas);
            $fin=($numFilas);
            $response=$operController->muestraOperaciones($inicio,$fin);
          ?>
        </tbody>
      </table>
    </div>
    <div class="fixed-bottom">
      <div class="position-absolute start-50 bottom-0 translate-middle">
      <nav aria-label="Page navigation example ">
        <ul class="pagination">
          <?php
            if ($nav!=1){
          ?>
            <li class="page-item">
              <a class="page-link bg-light-subtle text-black" href="index.php?nav=<?php echo $nav-1?>&but=<&<?php echo "fil=$numFilas"?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
        <?php 
            }
            $maxNav=$operController->muestraNavegaOperaciones($response);
            if ($nav<$maxNav){
        ?>
            <li class="page-item">
              <a class="page-link bg-light-subtle text-black" href="index.php?nav=<?php echo $nav+1?>&but=>&<?php echo "fil=$numFilas"?>" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <?php
            }
        ?>
        </ul>
      </nav>
      </div>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  </body>
</html>
<?php
    }
  }
?>
