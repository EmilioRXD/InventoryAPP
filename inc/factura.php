<body class="<?php echo THEME ?> sidebar-collapse sidebar-open">
    <div class="wrapper" style="background-color: #ecf0f5;">

        <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
        ?>

        <div class="content-wrapper" style="margin: 0;" id="quitar">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="box box-default">
                            <div class="box-header with-border hidden-print">
                                <button class="btn btn-info form-control" id="generar_reporte">Generar Nota de Entrega <i class="fa fa-file-pdf-o"></i>
                                </button>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td class="text-right" style="width: 4em;">Cliente:</td>
                                                <td class="text-left input cliente"><input id="cliente" type="text"></td>
                                                <td></td>
                                                <td style="width: 10em;" class="text-right">Nota de Entrega N°:</td>
                                                <td style="width: 10em;" class="text-right" id="numero_venta"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="width: 4em;">C.I:</td>
                                                <td class="text-left input ci"><input id="CI" type="number"></td>
                                                <td></td>
                                                <td style="width: 10em;" class="text-right">Fecha:</td>
                                                <td style="width: 10em;" class="text-right" id="fecha"></td>
                                            </tr>
                                            <tr>
                                                <td class="text-right" style="width: 4em;">Telefono:</td>
                                                <td class="text-left input telefono"><input id="telefono" type="number"></td>
                                                <td></td>
                                                <td style="width: 10em;" class="text-right">Vendedor:</td>
                                                <td style="width: 10em;" class="text-right vendedor" ></td>
                                            </tr>
                                        </tbody>
                                    </table><br>
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr class="factura-header">
                                                <th class="text-right" style="width: 4em;">Cantidad</th>
                                                <th class="text-left">Descripción</th>
                                                <th class="text-right" style="width: 10em;">Ref</th>
                                                <th class="text-right" style="width: 10em;">Precio</th>
                                                <th class="text-right" style="width: 10em;">Precio Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cuerpo_tabla_productos">
                                        </tbody>
                                    </table>
                                    <div class="factura-borde"></div>
                                    <table style="width: 100%;">
                                        <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="width: 10em;" ></td>
                                                <td style="width: 10em;" class="text-right">Total items:</td>
                                                <td style="width: 10em;" class="text-right total_bs"></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="width: 10em;" ></td>
                                                <td style="width: 10em;" class="text-right">Descuento:</td>
                                                <td style="width: 10em;" class=""></td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td style="width: 10em;" ></td>
                                                <td style="width: 10em;" class="text-right">Total Neto:</td>
                                                <td style="width: 10em;" class="text-right total_bs"></td>
                                            </tr>
                                            <tr>
                                                <td>Vendedor: <strong class="vendedor"></strong></td>
                                                <td></td>
                                                <td style="width: 10em;" ></td>
                                                <td style="width: 10em;" class="text-right">Total a Pagar:</td>
                                                <td style="width: 10em;" class="text-right total_bs"></td>
                                            </tr>
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
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->
        </div>
    </div>

    <link rel="stylesheet" href="./public/css/table.css">

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

    <script src="./js/factura.js"></script>