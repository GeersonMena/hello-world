<?php
    include 'model/OperacionesModel.php';
    $model= new OperacionesModel();
    class OperacionesController{
        function muestraOperaciones($inicioMuestra,$finMuestra){
            global $model;
            $response=$model->consultaOperaciones($inicioMuestra,$finMuestra);
            for ($i=1; $i <count($response); $i++) { 
                ?>
                    <tr>
                        <td rowspan=3 class="pb-3" ><?php echo $response[$i]['referencia']?></td>
                        <?php if ($response[$i]['numCliente']!=$response[$i]['numImportador']){?>
                        <td class="pb-3"><?php echo $response[$i]['nomCliente']." / ".$response[$i]['nomImportador']?></td>
                        <?php }else{?>
                        <td class="pb-3"><?php echo $response[$i]['nomCliente']?></td>
                        <?php }?>
                        <td  class="pb-3"><?php echo 'Estado: '.$response[$i]['nomEstado']?></td>
                        <td rowspan=3 class="pb-3" ><?php echo $response[$i]['comentarios']?></td>
                    </tr>
                    <tr>
                        <td class="pb-1" > Mercancía: <?php echo $response[$i]['mercancia']?></td>
                        <td class="pb-1" > Tipo: <?php if($response[$i]['tipoOperacion']=='E'){echo 'EXPORTACION ';}else{ echo 'IMPORTACION';}?></td>
                    </tr>
                    <tr>
                        <td class="pb-1" ><?php if($response[$i]['tipoOperacion']=='E'){echo 'Cierre: ';}else{ echo 'ETA:';} $etaFinal= new DateTime($response[$i]['ETA']); echo $etaFinal->format('d/m/Y')?></td>
                        <td></td>
                    </tr>
                <?php
            }
            return $response[0]['numRegistros'];
        }
        function muestraNavegaOperaciones($numRegistros){
            global $numFilas;
            $numNavega=ceil($numRegistros/$numFilas);
            for ($i=0; $i <$numNavega; $i++) { 
                ?>
                    <li class="page-item"><a class="page-link bg-light-subtle text-black" href="index.php?nav=<?php echo $i+1?>&<?php echo "fil=$numFilas"?>"><?php echo $i+1?></a></li>
                <?php
            }
            return $numNavega;
        }
    }
?>