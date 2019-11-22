<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"> 
    <title>agenda</title>
</head>
<body>
<?php

include_once 'clases/database.php';
include_once 'clases/agenda.php';

$database = new Database();
$db = $database->getConnection();

$prueba = new Agenda($db);

$stmt = $prueba->leer();
$total = $stmt->rowCount();

$page_title ="agenda";
    
	echo"<div>";
		echo "<a href='leer.php' class='btn btn-default pull-right' >Leer Agenda </a>";
	echo"</div>";	
?>
<?php
    if (isset($_POST['name'])){
       $prueba->name = $_POST['name']; 
       if (empty($_POST['number'])){
            if ($prueba->borrar()){
            echo "<div> datos eliminados</div>";
            }else{
            echo "<div>error en el borrado</div>";
            }   
       }else{
            
            $prueba->number = $_POST['number'];
        if($prueba->comprobar()){
            echo "<div class='alert alert-success'>Valores Añadidos </div>";
        }else{
            echo "<div class='alert alert-danger'>Error al insertar product</div>";
        }
        }
    }
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
 
    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr> 
        <tr>
            <td>Price</td>
            <td><input type='text' name='number' class='form-control' /></td>
        </tr>
        <td>
            <button type="submit" class="btn btn-primary">Ejecutar</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>

