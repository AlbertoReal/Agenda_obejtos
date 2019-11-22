
<?php
include_once 'clases/database.php';
include_once 'clases/agenda.php';


$database = new Database();
$db = $database->getConnection();

$prueba = new Agenda($db);

$stmt = $prueba->leer();
$total = $stmt->rowCount();

    echo"<div class='right-button-margin'>";
        echo "<a href='ini.php' class='btn btn-default pull-right' >Guardar</a>";
    echo"</div>";

if($total>0){
     echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>nombre</th>";
            echo "<th>telefono</th>";
        echo "</tr>";
        while ($filas = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($filas);
            echo "<tr>";
                echo "<td>{$nombre}</td>";
                echo "<td>{$number}</td>";
            echo "</tr>";
        }
    }
echo "</table>";
?>