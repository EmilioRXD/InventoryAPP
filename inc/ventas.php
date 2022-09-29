<body class="<?php echo THEME ?> sidebar-collapse sidebar-open">
    <div class="wrapper">
    
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
                                    <button id="quitar_ultimo_producto" type="button" class="btn btn-warning btn-block">
                                        <i class="fa-minus fa visible-xs"></i>
                                        <span class="hidden-xs"><kbd>-</kbd> Quitar último producto</span>
                                    </button>
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
                                <div class="form-group">
                                    <label class="col-form-label" for="codigo_producto">
                                        <i class="fa fa-barcode fs-6"></i>
                                        <span class="small">Productos</span>
                                    </label>
                                    <input
                                        class="form-control form-control-sm"
                                        type="text"
                                        id="codigo_producto"
                                        placeholder="Ingrese el código de barras o el nombre del producto"
                                    />
                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 hidden="hidden"><strong>Total: </strong><span id="contenedor_total"></span></h2>
                                </div>
                                <div class="col-sm-6 text-center">
                                    <h2 hidden="hidden"><strong>Total: </strong><span id="contenedor_total_verde"></span></h2><br>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 table-responsive" id="contenedor_tabla" style="border: none;">

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
    <div id="modal_procesar_venta" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Realizar venta</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-6 text-center">
                        <h2 hidden="hidden"><strong>Total: </strong><span id="contenedor_total_modal"></span></h2>
                    </div>
                    <div class="col-sm-6 text-center">
                        <h2 hidden="hidden"><strong>Total: </strong><span id="contenedor_total_modal_verde"></span></h2><br>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="metodo_pago">Selecione el meotodo de pago</label>
                                <select class="form-control" id="metodo_pago">
                                    <option value="0">&nbsp; $ &nbsp;&nbsp;&nbsp; Efectivo</option>
                                    <option value="1">Bs. &nbsp; Efectivo</option>
                                    <option value="2" selected="true">Bs. &nbsp; Tarjeta</option>
                                    <option value="3">Bs. &nbsp; Pago Movil</option>
                                    <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Credito</option>
                                </select>
                            </div>
                            <div class="credito form-group">
                                <label for="pago_usuario">Moto Recibido</label>
                                <input class="form-control" type="number" step="0.01" placeholder="Cantidad de efectivo recibido" id="pago_usuario">
                            </div>
                            <div class="credito checkbox">
                                <label>
                                <input type="checkbox" id="chkEfectivoExacto"> Monto Exacto
                                </label>
                            </div>
                            <!-- TICKET -->
                            <div class="checkbox hidden">
                                <label for="imprimir_ticket">
                                    <input type="checkbox" id="imprimir_ticket">
                                    <i class="fa fa-ticket"></i> Ticket
                                </label>
                            </div>
                            <!-- TICKET -->
                        </div>
                    </div>
                    <div class="col-sm-6 text-center">
                        <h2 hidden="hidden">Cambio: <span class="contenedor_cambio" id="contenedor_cambio_bs"></span></h2>
                    </div>
                    <div class="col-sm-6 text-center">
                        <h2 hidden="hidden">Cambio: <span class="contenedor_cambio" id="contenedor_cambio_verde"></span></h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <div hidden="hidden" class="alert">
                                <span id="mostrar_resultados_eliminar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button id="realizar_venta" class="form-control btn btn-info">Realizar venta</button>
                        </div>
                    </div>
                </div>
            </div>
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

    <link rel="stylesheet" href="./css/eac.css">
    <script src="./js/ventas.js"></script>
    <script src="./lib/eac.js"></script>

    </div>