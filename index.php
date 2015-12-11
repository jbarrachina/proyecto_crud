<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Proyecto CRUD</title>
    </head>
    <body> 
        <h1>Listado de Clientes</h1>
        <?php
// incluir la conexión a la base de datos
        include 'conexion.php';

// Elegir los datos que deseamos recuperar de la tabla
        $query = "SELECT nif, nombre, apellido1, apellido2, email, telefono, usuario  "
                . "FROM clientes "
                . "ORDER BY apellido1, apellido2, nombre";
        if ($stmt = $conexion->prepare($query)) {
            if (!$stmt->execute()) {
                die('Error de ejecución de la consulta. ' . $conexion->error);
            }
// recoger los datos
            $stmt->bind_result($nif, $nombre, $apellido1, $apellido2, $email, $telefono, $usuario);

// enlace a alta de cliente
            echo "<div>";
            echo "<a href='alta.php'>Alta cliente</a>";
            echo "</div>";

//cabecera de los datos mostrados
            echo "<table>"; //start table
            //creating our table heading
            echo "<tr>";
            echo "<th>NIF</th>";
            echo "<th>Nombre</th>";
            echo "<th>Apellido 1</th>";
            echo "<th>Apellido 2</th>";
            echo "<th>email</th>";
            echo "<th>telefono</th>";
            echo "<th>usuario</th>";
            echo "</tr>";
//recorrido por el resultado de la consulta
            while ($stmt->fetch()) {
                echo "<tr>";
                echo "<td>$nif</td>";
                echo "<td>$nombre</td>";
                echo "<td>$apellido1</td>";
                echo "<td>$apellido2</td>";
                echo "<td>$email</td>";
                echo "<td>$telefono</td>";
                echo "<td>$usuario</td>";
                echo "<td>";
                // we will use this links on next part of this post
                echo "<a href='edita.php?nif={$nif}'>Edita</a>";
                echo " / ";
                // we will use this links on next part of this post
                echo "<a href='javascript:borra_cliente(\"$nif\")'> Elimina </a>";
                echo "</td>";
                echo "</tr>\n";
            }
            // end table
            echo "</table>";

            $stmt->close();
        } else {
            die('Imposible preparar la consulta. ' . $conexion->error);
        }
        ?>
    </body>
</html>
