<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>
        <?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>

        <div class="row visible-print-block">
            <h1 class="text-center">Reporte sobre inventarios</h1>
            <h3 class="text-center" id="fecha_hoy">ss</h3>
        </div>

        <div class="content-wrapper" style="margin: 0;" id="quitar">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="box box-primary">
                            <div class="box-header with-border hidden-print ">
                                <p class="h5 text-justify">Elige el lapso de tiempo en el que quieres que se genere el reporte. Lo que veas aquí
                                    es lo mismo que aparecerá en él.
                                </p>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group hidden-print">
                                    <label for="filtro">Ordenar por</label>
                                    <select class="form-control" name="filtro" id="filtro">
                                        <option value="codigo">Código</option>
                                        <option value="nombre">Nombre</option>
                                        <option value="precio_compra">Precio de compra</option>
                                        <option value="precio_venta">Precio de venta</option>
                                        <option value="utilidad">Utilidad</option>
                                        <option value="existencia">Existencia</option>
                                        <option value="familia">Familia</option>
                                    </select>
                                </div>
                                <div class="form-group hidden-print">
                                    <label for="orden">Orden</label>
                                    <select class="form-control" name="orden" id="orden">
                                        <option value="desc">Ascendente</option>
                                        <option value="asc">Descendente</option>
                                    </select>
                                </div>
                                <div class="row text-center">
                                    <div class="col-xs-6">
                                        <h2 hidden="hidden"><strong>Total de productos:</strong> <span id="total_productos"></span></h2>
                                    </div>
                                    <div class="col-xs-6">
                                        <h2 hidden="hidden"><strong>Valor del inventario: </strong><span id="total_dinero"></span></h2>
                                    </div>
                                </div>
                                <div class="row hidden-print">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row"><br>
                                    <div class="col-xs-12">
                                        <div id="contenedor_tabla" class="table-responsive">
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-sm-2"></div>
                    <!-- /left column -->

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

    <script src="./js/reportes-inventarios.js"></script>