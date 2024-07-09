<?php
    define ("HOSTSQL", 'BDSERVER');
	define ("USERSQL", 'saga_sisrod');
	define ("PASSWORDSQL",'68<U*811kw$p');
    class BaseDatosSAGA{
        function Conexion($basedatos){
            $sdbuser = USERSQL;
            $sdbpass = PASSWORDSQL;
            $server = HOSTSQL;
            $connection_string = "DRIVER={SQL Server};SERVER=$server;DATABASE=$basedatos"; 
            $sconn = odbc_connect($connection_string,$sdbuser,$sdbpass) or die ('Error al conectarse a ODBC');
            return $sconn;
        }
    }
?>