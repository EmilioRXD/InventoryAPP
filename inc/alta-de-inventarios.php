<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper">
        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>
        <link rel="stylesheet" href="./css/eac.css">

        <div class="content-wrapper" style="margin: 0;">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <button class="form-control btn-success btn" id="terminar_alta">Terminar alta</button>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <label for="importe">Importe</label>
                                <input type="text" id="codigo_producto" class="form-control" placeholder="Nombre o código del producto">
                                <br>
                                <div class="table-responsive" id="contenedor_tabla">
                                </div>                                    
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
    
    <script src="./lib/eac.js"></script>
    <script src="./js/alta-de-inventarios.js"></script>