<?php
    include 'BDSQL.php';
    $bdsql= new BaseDatosSAGA();
    class OperacionesModel{
        function consultaOperaciones($inicioConsulta, $finConsulta){
            global $bdsql; 
            $varSCon=$bdsql->Conexion('SagaWin');
            $consulta="SELECT 
            r.RefNum AS Referencia,
            r.RefFen AS ETA,
            r.RefOpe AS TipoOperacion,
            r.ImpNum AS NumeroImportador,
            imp.CliNom AS NombreImportador,
            r.CliNum AS NumeroCliente,
            cli.CliNom AS NombreCliente ,
            r.EjeNum AS NumeroEjecutiva,
            eje.EjeNom AS NombreEjecutiva,
            r.RefEdo AS IdEstado,
            st.EdoDes AS NombreEstado,
            r.RefCau AS Comentarios, 
            r.RefAgeNum AS IdAgente, 
            a.AgeNom AS NombreAgente,
            r.RefMer AS Mercancia, 
            r.RefIniCap
            FROM REFERENC r 
            INNER JOIN AGENTES a ON a.AgeNum=r.RefAgeNum 
            INNER JOIN EDOREF st ON st.EdoCve=r.RefEdo
            INNER JOIN CLIENTES cli ON cli.CliNum=r.CliNum
            INNER JOIN CLIENTES imp ON imp.CliNum=r.ImpNum
            INNER JOIN EJECUTIV eje ON eje.EjeNum=r.EjeNum
            WHERE AgeNum=3 AND RefEdo !='T' AND RefEdo!='1' AND RefEdo!='F'  AND RefEdo!='Y' AND RefEdo!='Z'  AND RefEdo!='N' AND RefIniCap>='2024-01-01 00:00:00'
            ORDER BY RefNum DESC";
            $res=odbc_exec($varSCon,$consulta);
            $numRegistros=odbc_num_rows($res);
            $consulta.=" OFFSET ".$inicioConsulta." ROWS
            FETCH NEXT ".$finConsulta." ROWS ONLY";
            $res=odbc_exec($varSCon,$consulta);
            $operaciones[]=array(
                'numRegistros'=>$numRegistros
            );
            while($row=odbc_fetch_array($res)){
                $operaciones[]=array(
                    'referencia'=>$row['Referencia'],
                    'numCliente'=>$row['NumeroCliente'],
                    'nomCliente'=>$row['NombreCliente'],
                    'numImportador'=>$row['NumeroImportador'],
                    'nomImportador'=>$row['NombreImportador'],
                    'numEjecutiva'=>$row['NumeroEjecutiva'],
                    'nomEjecutiva'=>$row['NombreEjecutiva'],
                    'idEstado'=>$row['IdEstado'],
                    'nomEstado'=>$row['NombreEstado'],
                    'comentarios'=>$row['Comentarios'],
                    'idAgente'=>$row['IdAgente'],
                    'nomAgente'=>$row['NombreAgente'],
                    'fechaRegistro'=>$row['RefIniCap'],
                    'ETA'=>$row['ETA'],
                    'tipoOperacion'=>$row['TipoOperacion'],
                    'mercancia'=>$row['Mercancia'],
                );
            }
            return $operaciones;
        }
    }
?>