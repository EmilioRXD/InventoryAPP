<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>

        <div class="row visible-print-block">
            <h1 class="text-center">Reporte sobre ventas</h1>
        </div>

        <div class="content-wrapper" style="margin: 0;" id="quitar">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-primary hidden-print">
                            <div class="box-header with-border">
                                <div class="col-sm-12">
                                    <p class="h5 text-center">
                                        Elige el lapso de tiempo en el que quieres que se genere el reporte. Lo que veas aquí
                                        es lo mismo que aparecerá en él.<br>
                                    </p>
                                </div>
                                <div class="col-xs-12 col-sm-4 text-center form-group">
                                    <label for="fecha_inicio">Del</label>
                                    <input id="fecha_inicio" type="datetime-local" class="form-control">
                                </div>
                                <div class="col-xs-12 col-sm-4 text-center form-group">
                                    <label for="fecha_fin">Hasta</label>
                                    <input id="fecha_fin" type="datetime-local" class="form-control">
                                </div>
                                <div class="col-xs-12 col-sm-4 text-center form-group">
                                    <label for="familia">Familia</label>
                                    <select class="form-control" name="familia" id="familia"></select>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <button class="btn btn-info form-control" id="generar_reporte">Generar reporte <i class="fa fa-file-pdf-o"></i>
                                </button>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-sm-12">
                        <div class="box box-default">
                            <div class="box-header with-border hidden-print">
                                <div class="col-sm-6">
                                    <h2 class="text-center" hidden="hidden"><strong>Total:</strong> $<span id="mostrar_total"></span></h2>
                                </div>
                                <div class="col-sm-6">
                                    <h2 class="text-center" hidden="hidden"><strong>Utilidad:</strong> $<span id="mostrar_utilidad"></span></h2>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body" style="min-height:10em;">
                                <div class="table-responsive col-sm-3">
                                    <h3 class="text-center">Por familia</h3>
                                    <table class="table table-condensed table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Familia</th>
                                            <th>Total</th>
                                            <th>Utilidad</th>
                                        </tr>
                                        </thead>
                                        <tbody id="contenedor_tabla_por_familia">
                                        </tbody>
                                    </table>
                                </div>
                                <h3 class="text-center">General</h3>
                                <div id="contenedor_tabla" class="table-responsive">
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
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

    <script src="./js/reporte-ventas.js"></script>