<?php

require_once '../models/Mozo.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;



if(isset($_POST['operacion'])){
    $mozo = new Mozo();
    if($_POST['operacion'] == 'listar'){
        $datosobtenidos = $mozo->listarPedidos();

        if($datosobtenidos){
            $numeroFila = 1;
            foreach($datosobtenidos as $mozo){
                echo "
                <tr>
                    <td>{$numeroFila}</td>
                    <td>{$mozo['mesa']}</td>
                    <td>{$mozo['entrada']}</td>
                    <td>{$mozo['menu']}</td>
                    <td>{$mozo['descripcion']}</td>
                    <td>{$mozo['total']}</td>
                    <td> 
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
                    <a href='#' data-idmozo='{$mozo['idmozo']}' class='btn btn-warning btn-sm imprimir' onclick='imprimirTicket({$mozo['idmozo']})'><i class='bi bi-printer'></i></a>
                    </td>
                    </tr>
                ";
                $numeroFila++;
            }
        }
    }

    if($_POST['operacion'] == 'registrar'){
        $datosForm = [
            "mesa"         => $_POST['mesa'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $mozo->registrarPedidos($datosForm);

        // Crear instancia de Printer y conectar con la impresora
        $connector = new FilePrintConnector('TMUSI');
        $printer = new Printer($connector);

        // Enviar contenido del ticket a imprimir
        $printer->text("¡Bienvenido a nuestro restaurante!\n");
        $printer->text("Mesa: {$_POST['mesa']}\n");
        $printer->text("Entrada: {$_POST['entrada']}\n");
        $printer->text("Menú: {$_POST['menu']}\n");
        $printer->text("Descripción: {$_POST['descripcion']}\n");
        $printer->text("Total: {$_POST['total']}\n");

        // Cortar el papel
        $printer->cut();

        // Cerrar la conexión con la impresora
        $printer->close();
        
    }

    if($_POST['operacion'] == 'actualizar'){
        $datosForm = [
            "idmozo"        => $_POST['idmozo'],
            "mesa"         => $_POST['mesa'], //CLAVES // VALORES
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
          ];
      
          //Paso 2: Enviar el arreglo como paramentro del metodo ACTUALIZAR
            $mozo->actualizarPedido($datosForm);
    }

    if($_POST['operacion'] == 'obtenerpedido'){
        $registro = $mozo->getPedido($_POST['idmozo']);
        echo json_encode($registro);
      }

    if($_POST['operacion'] == 'eliminar'){
        $mozo->eliminarPedido($_POST['idmozo']);
    }
}
