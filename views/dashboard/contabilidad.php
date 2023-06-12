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
        <link rel="shortcut icon" href="../../images/gustitos.jpg">
        
        
        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  

        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="nose.php">Restaurante</a>
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
                <li class="nav-item"><span class="nav-link">Bienvenido(a) <?php echo $nombreusuario; ?></span></li>
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
                        <h1 class="mt-4">Monto Total de Pedidos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="nose.php">Principal</a></li>
                            <li class="breadcrumb-item active">Contabilidad</li>
                        </ol>
                        
                        <div class="container">
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h2>Pedidos por día</h2>
                                    <div class="form-group">
                                        <label for="fecha">Fecha:</label>
                                        <input type="date" id="fecha" class="form-control">
                                    </div>
                                    <button type="button" id="btnAbrirModal" class="btn btn-primary" onclick="obtenerPedidos()">Mostrar Pedidos</button>
                                
                                </div>
                            </div>

                            

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h3>Pedidos al Mes: <span id="numeroPedidos"></span></h3>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="fecha-mes">Selecciona un año y mes:</label>
                                    <div class="input-group">
                                        <input type="month" id="fecha-mes" class="form-control">
                                        <button id="calcular-mes-btn" class="btn btn-primary">Calcular</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                                    <div class="d-flex justify-content-left mt-4">
                                        <a href="entrada.php" class="btn btn-warning"><i class="bi bi-arrow-return-left"></i> Volver</a>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Modal para mostrar el precio total del mes -->
                        <div id="modal-mes" class="modal" style="display: none;">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Precio total del mes</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p id="precio-mes"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para mostrar el total de pedidos del día -->
                        <div id="pedidoModal" class="modal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Total de Pedidos</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6>Pedidos de Mozos:</h6>
                                                <p id="totalMozosDia"></p>
                                            </div>
                                            <div class="col">
                                                <h6>Pedidos de Recepcionistas:</h6>
                                                <p id="totalRecepcionistasDia"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h6>Total General de Pedidos:</h6>
                                                <p id="totalGeneralDia"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

        
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

        <!-- JQuery-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="js/scripts.js"></script>

        <script>
            function obtenerPedidos() {
                var fecha = $('#fecha').val();

                if (fecha) {
                    $.ajax({
                        url: '../../controllers/caja.controller.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            fecha: fecha
                        },
                        success: function (response) {
                            mostrarModalPedidos(response.total_mozos_dia, response.total_recepcionistas_dia, response.total_general_dia);
                        },
                        error: function (xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            }

            function mostrarModalPedidos(totalMozosDia, totalRecepcionistasDia, totalGeneralDia) {
                $('#totalMozosDia').text(totalMozosDia);
                $('#totalRecepcionistasDia').text(totalRecepcionistasDia);
                $('#totalGeneralDia').text(totalGeneralDia);

                $('#pedidoModal').modal('show');
            }

            $(document).ready(function() {
                $('#calcular-mes-btn').click(function() {
                    var fechaMes = $('#fecha-mes').val();

                    if (fechaMes) {
                        $.ajax({
                            url: '../../controllers/caja.controller.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                fechaMes: fechaMes
                            },
                            success: function(response) {
                                var precioMes = response.total_general_mes;
                                $('#precio-mes').text("Precio total del mes: " + precioMes);
                                $('#modal-mes').modal('show');
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                });
            });

        </script>
    </body>
</html>
