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
                    <div class="col-sm-12">
                        <div class="box box-default">
                            <div class="box-body" style="min-height:40vh;">
                                <h3 class="text-center">General</h3><br>
                                <div id="contenedor_tabla" class="table-responsive">
                                </div>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </div>
    </div>

    <!--
    #####################################################################################Comienzan los modal
    -->
    <div id="modal_confirmar" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirmar</h4>
                </div>
                <div class="modal-body">
                    <p class="h5">¿Realmente deseas eliminar el credito? Esta opción no se puede deshacer.</p>
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
                        <div class="col-xs-6">
                            <button id="eliminar_producto" class="form-control btn btn-danger">Eliminar</button>
                        </div>
                        <div class="col-xs-6">
                            <button id="cancelar_confirmacion_eliminar" data-dismiss="modal"
                                    class="form-control btn btn-warning">Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="modal_abonar" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Abonar Dinero</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <h2><strong>Total: </strong><span id="contenedor_total_verde"></span></h2>
                    </div>
                    <div class="col-sm-5 col-md-offset-2 text-center">
                        <h2><strong>Total: </strong><span id="contenedor_total"></span></h2><br>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center col-xs-12">
                        <h4>Ingrese la cantidad de dinero que desea abonar</h4>
                        <br>
                    </div>
                </div>
                <div class="row">
                    <div class="text-center col-sm-5 form-group">
                        <label for="abono_verde">Ingrese la cantidad en $</label>
                        <input class="form-control" placeholder="Ingrese la cantidad"
                            type="number" step="0.01" id="abono_verde">
                    </div>
                    <div class="text-center col-sm-2">
                        <h2>O</h2>
                    </div>
                    <div class="text-center col-sm-5 form-group">
                        <label for="abono_bs">Ingrese la cantidad en Bs</label>
                        <input class="form-control" placeholder="Ingrese la cantidad"
                            type="number" step="0.01" id="abono_bs">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div hidden="hidden" class="alert text-center">
                            <span id="mostrar_resultados_abonar"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button id="abonar" class="form-control btn btn-success">Abonar</button>
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

    <script src="./js/creditos.js"></script>