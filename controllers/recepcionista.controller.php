<?php

require_once '../models/Recepcionista.php';
require_once '../vendor/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

if (isset($_POST['operacion'])) {
    $recepcionista = new Recepcionista();
    if ($_POST['operacion'] == 'listar') {
        $datosobtenidos = $recepcionista->listarPedidos();

        if ($datosobtenidos) {
            $numeroFila = 1;
            foreach ($datosobtenidos as $recepcionista) {
                echo "
                <tr>
                    <td>{$numeroFila}</td>
                    <td>{$recepcionista['nombre']}</td>
                    <td>{$recepcionista['entrada']}</td>
                    <td>{$recepcionista['menu']}</td>
                    <td>{$recepcionista['descripcion']}</td>
                    <td>{$recepcionista['total']}</td>
                    <td> 
                    <a href='#' data-idrecepcionista='{$recepcionista['idrecepcionista']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
                    <a href='#' data-idrecepcionista='{$recepcionista['idrecepcionista']}' class='btn btn-info btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
                    <a href='#' data-idrecepcionita='{$recepcionista['idrecepcionista']}' class='btn btn-warning btn-sm imprimir' onclick='imprimirTicket({$recepcionista['idrecepcionista']})'><i class='bi bi-printer'></i></a>
                    </td>
                    </tr>
                ";
                $numeroFila++;
            }
        }
    }

    if ($_POST['operacion'] == 'registrar') {
        $datosForm = [
            "nombre"         => $_POST['nombre'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $recepcionista->registrarPedidos($datosForm);
    }

    if ($_POST['operacion'] == 'actualizar') {
        $datosForm = [
            "idrecepcionista"        => $_POST['idrecepcionista'],
            "nombre"         => $_POST['nombre'],
            "entrada"       => $_POST['entrada'],
            "menu"          => $_POST['menu'],
            "descripcion"   => $_POST['descripcion'],
            "total"         => $_POST['total']
        ];

        $recepcionista->actualizarPedido($datosForm);
    }

    if($_POST['operacion'] == 'obtenerpedido'){
        $registro = $recepcionista->getPedido($_POST['idrecepcionista']);
        echo json_encode($registro);
      }

    if($_POST['operacion'] == 'eliminar'){
        $recepcionista->eliminarPedido($_POST['idrecepcionista']);
    }

    if ($_POST['operacion'] == 'imprimirTicket') {
        $idrecepcionista = $_POST['idrecepcionista'];
    
        // Obtener los detalles del pedido con el ID proporcionado
        $pedido = $recepcionista->getPedido($idrecepcionista);

        try {
        
            if ($pedido) {
                $nombre = $pedido['nombre'];
                $entrada = $pedido['entrada'];
                $menu = $pedido['menu'];
                $descripcion = $pedido['descripcion'];
                $total = $pedido['total'];
                $fecha_registro = $pedido['fecha_registro']; // Obtener la fecha de registro desde la base de datos
                
        
                // Crear instancia de Printer y conectar con la impresora
                $connector = new NetworkPrintConnector('localhost',3306);
                $printer = new Printer($connector);
        
                // Enviar contenido del ticket a imprimir
                $printer->text("¡Bienvenido a nuestro restaurante!\n");
                $printer->text("Fecha de registro: {$fecha_registro}\n"); // Mostrar la fecha de registro
                $printer->text("Nombre: {$nombre}\n");
                $printer->text("Entrada: {$entrada}\n");
                $printer->text("Menú: {$menu}\n");
                $printer->text("Descripción: {$descripcion}\n");
                $printer->text("Total: {$total}\n");
        
                // Cortar el papel
                $printer->cut();
        
                // Cerrar la conexión con la impresora
                $printer->close();
        
                // Respuesta de éxito
                echo json_encode(["success" => true]);
            } else {
                // Respuesta de error
                echo json_encode(["success" => false, "message" => "No se encontró el pedido"]);
            }
        } catch (Exception $e) {
            // Respuesta de error en caso de excepción
            echo json_encode(["success" => false, "message" => "Error al generar el ticket: " . $e->getMessage()]);
        }
    }
}

