<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<header class="main-header">
    <a href="#" id="marca_del_producto" class="logo"><?php echo NOMBRE_NEGOCIO ?></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            
            <!-- Cierre de Sesión -->
            <li>
                <a href="./modulos/usuarios/cerrar_sesion.php">Cerrar Sesión</a>
            </li>
        </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
        <div class="pull-left image">
            <img src="./public//dist/img/avataroficina1.jpg" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>
                <?php inicia_sesion_segura();
                echo $_SESSION["nombre_de_usuario"] . " ";?>
            </p>
            <a href="">
                <?php inicia_sesion_segura();
                echo (intval($_SESSION["administrador"]) === 1) ? 'Administrador <i class="fa fa-unlock"></i>' : 'Cajero <i class="fa fa-lock"></i>';?>
            </a>
        </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
        <li class="header">MENÚ DE NAVEGACIÓN </li>
        <?php inicia_sesion_segura();
                echo (intval($_SESSION["administrador"]) === 1) ? '<li class="treeview">
                <a href="./ventas"><i class="fa fa-usd"></i> Ventas</a>
            </li>
            <li class="treeview">
                <a href="./inventarios"><i class="fa fa-cubes"></i> Inventarios</a>
            </li>
            <li class="treeview">
                <a href="./gastos"><i class="fa fa-calculator"></i> Gastos</a>
            </li>
            <li class="treeview">
                <a href="./alta-de-inventarios"><i class="fa fa-angle-double-up"></i> Alta de inventarios</a>
            </li>
            <li class="treeview">
                <a href="#">
                <i class="fa fa-file-pdf-o"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                <li><a href="./reportes-inventarios">Inventarios</a></li>
                <li><a href="./reportes-bajas-inventario">Bajas de inventario</a></li>
                <li><a href="./reportes-ventas">Ventas</a></li>
                <li><a href="./reportes-gastos">Gastos</a></li>
                <li><a href="./productos-en-stock">Productos en stock</a></li>
                </ul>
            </li>
            <li><a href="./usuarios"><i class="fa fa-user"></i> Usuarios</a></li>' : '<li class="treeview">
                            <a href="./ventas"><i class="fa fa-usd"></i> Ventas</a>
                        </li>
                        <li class="treeview">
                            <a href="./gastos"><i class="fa fa-calculator"></i> Gastos</a>
                        </li>
                        <li class="treeview">
                            <a href="./alta-de-inventarios"><i class="fa fa-angle-double-up"></i> Alta de inventarios</a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                            <i class="fa fa-file-pdf-o"></i>
                            <span>Reportes</span>
                            <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            <li><a href="./reportes-ventas">Ventas</a></li>
                            <li><a href="./reportes-gastos">Gastos</a></li>
                            </ul>
                        </li>';?>
        
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
<script>
    $(document).ready(function() {
        comprobar_productos_con_existencia_minima();
        var veces_tocado = 0,
            ayudante_timeout;
        $("#marca_del_producto").click(function(e) {
            veces_tocado++;
            if (veces_tocado >= 3) {
                $("#modal_acerca_de").modal("show");
            }
            ayudante_timeout = setTimeout(function() {
                veces_tocado = 0;
                clearTimeout(ayudante_timeout);
            }, 500);
            e.preventDefault();
        });
    });

    function abrir_cajon() {
        console.info("Abriendo cajón...");
        $.get("./modulos/abrir_cajon.php");
    }
</script>

<div id="modal_acerca_de" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Acerca de</h4>
            </div>
            <div class="modal-body">
                <div class="well">
                    <h1>InventoryAPP
                        <small>v2.7</small>
                    </h1>
                    <br>
                    <h2>Desarrollado y mantenido por <a target="_blank" href="https://github.com/EmilioRXD">EmilioRXD</a></h2>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12">
                    <button data-dismiss="modal" class="form-control btn btn-success">Cerrar</button>
                </div>

            </div>
        </div>
    </div>
</div>