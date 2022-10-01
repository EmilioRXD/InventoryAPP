<body class="<?php echo THEME ?> sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>

        <div class="row visible-print-block">
            <h1 class="text-center">Reporte sobre ventas</h1><br>
            <h4 class="text-center">Precio Dolar: Bs. <?php echo $precio_dolar;?></h2>
        </div>

        <div class="content-wrapper" style="margin: 0;" id="quitar">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- Inventario -->
                    <div class="col-xs-12" id="inventory">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="form-group">
                                    <div class="col-xs-12 col-sm-9" style="margin-bottom:1em;">
                                        <input type="text" id="buscar_producto" class="form-control" placeholder="Buscar producto por id o nombre">
                                    </div>
                                    <div class="col-xs-12 col-sm-3">
                                        <button id="agregar_producto" class="btn btn-success btn-block" style="overflow: hidden;"><i class="fa fa-plus"></i> Agregar Producto</button>
                                    </div>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="alert alert-success alert-dismissable hidden" id="alertsuccess">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h4><i class="icon fa fa-check"></i> Alert!</h4>
                                    Producto agregado satisfactoriamente
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Productos</th>
                                            <th style='width: 8em;'>N° Productos</th>
                                            <th>Total Bs</th>
                                            <th>Total $</th>
                                            <th>Metodo Pago</th>
                                            <th class="text-center" style="width: 10em;">Usuario</th>
                                            <th class="text-center" style="width: 10em;">Pagar</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cuerpo_tabla_productos">
                                        </tbody>
                                    </table>
                                </div>                             
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                    <div class="btn-group btn-group-justified">
                                        <div class="btn-group">
                                            <button id="cargar_productos_nuevos" type="button" class="btn btn-success"><i
                                                    class="fa fa-arrow-left"></i> Productos nuevos
                                            </button>
                                        </div>
                                        <div class="btn-group">
                                            <button id="cargar_productos_antiguos" type="button" class="btn btn-info">Productos
                                                anteriores <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                            </div>
                        </div><!-- /.box -->
                    </div>
                    <!-- Inventario -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- jQuery 2.1.3 -->
    <script src="./public/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="./public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="./public/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='./public/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="./public/dist/js/app.min.js" type="text/javascript"></script>

    <script src="./js/creditos.js"></script>