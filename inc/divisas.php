<body class="<?php echo THEME ?> sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

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
                                
                                <!-- left column -->
                                <div class="col-sm-4" style="margin-top: .5em">
                                                                      
                                </div><!-- /.col -->
                                <!-- /left column -->

                                <!-- center column -->
                                <div class="col-sm-4" style="margin-top: .5em">
                                    <button id="preparar_venta" type="button" class="btn btn-success btn-block">
                                        <i class="fa-check-circle-o fa visible-xs"></i>
                                        <span class="hidden-xs"><kbd>F1</kbd> Realizar venta</span>
                                    </button>
                                </div><!-- /.col -->
                                <!-- /center column -->

                                <!-- right column -->
                                <div class="col-sm-4" style="margin-top: .5em">
                                    <button id="cancelar_toda_la_venta" type="button" class="btn btn-danger btn-block">
                                        <i class="fa-ban fa visible-xs"></i>
                                        <span class="hidden-xs"><kbd>F2</kbd> Cancelar toda la venta</span>
                                    </button>
                                </div><!-- /.col -->
                                <!-- /right column -->
                            
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <form method="POST">
                                    <label for="precio_dolar">Precio Dolar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="precio_dolar" step="0.01" placeholder="Precio Dolar">
                                        <div class="input-group-btn">
                                        <button type="sumit" name="enviar" class="btn btn-danger">Enviar</button>
                                        </div><!-- /btn-group -->
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-sm-2"></div>
                    <!-- /left column -->

                </div><!-- /.row -->
            </section><!-- /.content -->
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

    </div>