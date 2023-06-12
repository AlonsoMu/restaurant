<?php
session_start();
if (!isset($_SESSION["login"])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: iniciar.php");
    exit(); // Asegura que el script se detenga después de la redirección
}

$nombreusuario="";
if (isset($_SESSION['nombreusuario'])){
    $nombreusuario = $_SESSION['nombreusuario'];
}
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistema Gustitos</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

        <!-- Íconos de Bootstrap-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

        <link rel="shortcut icon" href="../../images/gustitos.jpg">

        <style>
        .centered-text {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        font-family: "Arial", sans-serif; /* Cambia el tipo de letra según tus necesidades */
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            width: 50px; /* Ajusta el tamaño del logo según tus necesidades */
            margin-right: 10px; /* Ajusta el margen derecho del logo según tus necesidades */
        }
        </style>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="nose.php">Gustitos</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item"><span class="nav-link">Bienvenido(a), <?php echo $nombreusuario; ?></span></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../../controllers/usuario.controller.php?operacion=finalizar">Cerrar Sesión</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Panel de Control</div>
                            <a class="nav-link" href="nose.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                ADMINISTRADOR
                            </a>
                            <div class="sb-sidenav-menu-heading">Interfaz</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Registros
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="registro_mozos.php">Formulario Mozos</a>
                                    <a class="nav-link" href="registro_recepcionistas.php">Formulario Recepcionistas</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link" href="contabilidad.php">Contabilidad</a>

                                </nav>
                            </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Pedidos por Mesa</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="nose.php">Principal</a></li>
                            <li class="breadcrumb-item active">Formulario de Mozos</li>
                        </ol>
                        <div class="container mt-3">
                            <div class="card table-responsive">
                            <div class="card-header bg-primary text-light">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="logo">
                                            <img src="../../images/gustitos.jpg" alt="Logo Gustitos">
                                            <strong class="centered-text">GUSTITOS</strong>
                                        </div>
                                    </div>
                                <div class="col-md-6 text-end">
                                    <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-registro-pedidos"><i class="bi bi-plus-square-fill"></i> Agregar pedido</button>

                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-sm table-striped" id="tabla-pedidos">
                                <colgroup> <!-- Permite ordenar las tablas-->
                                    <col width = "5%">
                                    <col width = "10%">
                                    <col width = "15%">
                                    <col width = "20%">
                                    <col width = "20%">
                                    <col width = "10%">
                                    <col width = "10%">
                                    
                                </colgroup>
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>N° Mesa</th>
                                    <th>Entrada</th>
                                    <th>Menú</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Operaciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                </table>
                            </div>
                            </div>
                                
                            </div>
                        </div>


        <!--Modales-->
        <!-- Modal trigger button -->


        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modal-registro-pedidos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-light">
                        <h5 class="modal-title" id="modal-titulo">Registro de Pedidos</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formulario-pedidos" autocomplete="off">
                            <div class="mb-3">
                                    <label for="mesa" class="form-label">Mesa:</label>
                                    <input type="text" class="form-control form-control-sm" id="mesa" name="mesa">
                                </div>
                            <div class="mb 3">
                                <label for="entrada" class="form-label">Entrada:</label>
                                <input type="text" class="form-control form-control-sm" id="entrada" name="entrada">
                            </div>
                            <div class="mb-3">
                                <label for="menu" class="form-label">Menu:</label>
                                <input type="text" class="form-control form-control-sm" id="menu" name="menu">
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripcion:</label>
                                <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion">
                            </div>
                            <div class="mb-3">
                                <label for="total">Precio:</label>
                                <input type="text" class="form-control form-control-sm" id="total" name="total" required>
                            </div>

                            <script>
                                // Obtener el campo de entrada de precio
                                var precioInput = document.getElementById("total");

                                // Agregar un controlador de eventos para validar la entrada de usuario
                                precioInput.addEventListener("input", function() {
                                    // Obtener el valor actual del campo de entrada
                                    var valor = this.value;

                                    // Eliminar cualquier caracter que no sea número del valor
                                    valor = valor.replace(/[^0-9]/g, "");

                                    // Establecer el nuevo valor en el campo de entrada
                                    this.value = valor;
                                });
                            </script>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-outline-success" id="guardar-pedido">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
            </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <!-- jQuery-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

        <script src="../../controllers/mozo.controller.php"></script>

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>

    $(document).ready(function (){

        let datosNuevos = true;
        let idmozoactualizar = -1;

    function mostrarPedidos(){
        $.ajax({
            url: '../../controllers/mozo.controller.php',
            type: 'POST',
            data: {operacion: 'listar'},
            dataType: 'text',
            success: function(result){
                $("#tabla-pedidos tbody").html(result);
            }
        });
    }   

    mostrarPedidos();

    

    function registrarPedido() {
        Swal.fire({
            title: "¿Está seguro de registrar un pedido?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "Cancelar",
            customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger",
            },
            iconHtml: '<i class="bi bi-question-circle"></i>',
        }).then((result) => {
            if (result.isConfirmed) {
            // El usuario hizo clic en "Sí"
            let datos = {
                operacion: 'registrar',
                idmozo: idmozoactualizar,
                mesa: $("#mesa").val(),
                entrada: $("#entrada").val(),
                menu: $("#menu").val(),
                descripcion: $("#descripcion").val(),
                total: $("#total").val()
            };

            if (!datosNuevos) {
                datos["operacion"] = "actualizar";
            }

            $.ajax({
                url: '../../controllers/mozo.controller.php',
                type: 'POST',
                data: datos,
                success: function(result) {
                if (result == "") {
                    $("#formulario-pedidos")[0].reset();
                    mostrarPedidos();
                    $("#modal-registro-pedidos").modal('hide'); // Cerrar el modal
                    location.reload();

                    Swal.fire({
                    title: "¡Pedido registrado correctamente!",
                    icon: "success",
                    customClass: {
                        confirmButton: "btn btn-success",
                        
                    },
                    });
                }
                }
            });
            }
        });
    }

    

    function abrirModal(){
        datosNuevos = true;
        $("#modal-titulo").html("Registro de pedidos");
        $("#formulario-pedidos")[0].reset();
      }

      $("#guardar-pedido").click(registrarPedido);
      $("#abrir-modal").click(abrirModal);
    
      //EDITAR

      $("#tabla-pedidos tbody").on("click", ".editar", function() {
        const idpedidoeditar = $(this).data("idmozo");
        
        Swal.fire({
            title: '¿Está seguro de editar el pedido?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, editar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controllers/mozo.controller.php',
                    type: 'POST',
                    data: {
                        operacion: 'obtenerpedido',
                        idmozo: idpedidoeditar
                    },
                    dataType: 'JSON',
                    success: function(result) {
                        console.log(result);
        
                        datosNuevos = false;
        
                        idmozoactualizar = result["idmozo"];
                        $("#mesa").val(result["mesa"]);
                        $("#entrada").val(result["entrada"]);
                        $("#menu").val(result["menu"]);
                        $("#descripcion").val(result["descripcion"]);
                        $("#total").val(result["total"]);
        
                        $("#modal-titulo").html("Actualizar datos de pedido");
        
                        // Ponemos al modal en pantalla
                        $("#modal-registro-pedidos").modal("show");
                    }
                });
            }
        });
    });


     $("#tabla-pedidos tbody").on("click", ".eliminar", function() {
        const idpedidoEliminar = $(this).data("idmozo");

        Swal.fire({
            title: '¿Está seguro de eliminar el pedido?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../../controllers/mozo.controller.php',
                    type: 'POST',
                    data: {
                        operacion: 'eliminar',
                        idmozo: idpedidoEliminar
                    },
                    success: function(result) {
                        if (result == "") {
                            mostrarPedidos();
                            Swal.fire({
                                title: '¡Pedido eliminado correctamente!',
                                icon: 'success',
                                confirmButtonClass: 'btn btn-success'
                            });
                        }
                    }
                });
            }
        });
    });


     

     
    

    // Ejecución automática
     mostrarPedidos();




    });

    function imprimirTicket(idmozo) {
    // Realizar la solicitud AJAX para imprimir el ticket
    $.ajax({
        url: '../../controllers/mozo.controller.php',
        type: 'POST',
        data: {
        operacion: 'imprimirTicket',
        idmozo: idmozo
        },
        dataType: 'json',
        success: function(response) {
        if (response.success) {
            // Imprimir ticket exitoso, puedes realizar alguna acción adicional si es necesario
            console.log('Ticket impreso correctamente');
        } else {
            // Mostrar mensaje de error en caso de fallo en la impresión
            console.log('Error al imprimir el ticket:', response.message);
        }
        },
        error: function(xhr, status, error) {
            if (xhr.responseText) {
                console.log('Error en la solicitud AJAX:', xhr.responseText);
            } else {
                console.log('Error en la solicitud AJAX:', error);
            }
        }
    });


    }

    
    </script>
    </body>
</html>
