<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>
        <?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>

        <div class="row visible-print-block">
            <h1 class="text-center">Reporte sobre gastos</h1>
        </div>

        <div class="content-wrapper" style="margin: 0;" id="quitar">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="box box-primary">
                            <div class="box-header with-border hidden-print ">
                                <div class="col-sm-12">
                                    <p class="h5 text-center">
                                        Elige el lapso de tiempo en el que quieres que se genere el reporte. Lo que veas aquí
                                        es lo mismo que aparecerá en él.
                                    </p>
                                </div>
                                <div class="col-sm-4 text-center form-group">
                                    <h4>Del</h4>
                                    <input id="fecha_inicio" type="datetime-local" class="form-control">
                                </div>
                                <div class="col-sm-4 text-center form-group">
                                    <h4>Hasta</h4>
                                    <input id="fecha_fin" type="datetime-local" class="form-control">
                                </div>
                                <div class="col-sm-4 text-center form-group">
                                    <h4>Usuario</h4>
                                    <select class="form-control" name="usuarios" id="usuarios">
                                    </select>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="row hidden-print">
                                    <div class="col-xs-12">
                                        <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
                                        </button>
                                    </div>
                                </div>
                                <div id="contenedor_tabla" class="table-responsive" style="margin-top: 2em;">
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

    <script src="./js/reporte-bajas-inventario.js"></script>