<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper">
<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>

    <!-- Right side column. Contains the navbar and content of the page -->
    <div class="content-wrapper" style="margin: 0;">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h4 class="text-center">Registrar nuevo producto</h4>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div id="contenedor_form">
                                    <div class="form-group">
                                        <label for="importe">Importe</label>
                                        <input data-requerido="true" type="number" id="importe" class="form-control" placeholder="Importe">
                                    </div>
                                    <div class="form-group">
                                        <label for="concepto">Concepto</label>
                                        <input data-requerido="true" type="text" id="concepto" class="form-control" placeholder="Concepto">
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Descripción</label>
                                        <input data-requerido="true" type="text" id="descripcion" class="form-control"
                                            placeholder="Descripción">
                                    </div>
                                </div>
                                <button id="guardar_gasto" class="btn btn-success form-control">
                                    Guardar
                                </button>     
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <div class="col-sm-2"></div>
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


    <script src="./js/gastos.js"></script>