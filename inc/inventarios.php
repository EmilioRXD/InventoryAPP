<body class="skin-green sidebar-collapse sidebar-open">
    <div class="wrapper">

<?php
if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
?>
<?php if ($_SESSION["administrador"] !== 1) exit('<h1 class="text-center">Lo sentimos, solamente el administrador puede ver esta sección<br><br><i class="fa fa-hand-paper-o fa-4x"></i></h1>'); ?>    
        
        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper" style="margin: 0;">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-3">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h4 class="text-center">Registrar nuevo producto</h4>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="id_producto">Id del producto</label>
                                    <input data-requerido="true" class="form-control" type="text" id="id_producto"
                                        placeholder="Id del producto">
                                </div>
                                <div class="form-group">
                                    <label for="nombre_producto">Nombre del producto</label>
                                    <input data-requerido="true" class="form-control" type="text" id="nombre_producto"
                                        placeholder="Nombre del producto">
                                </div>
                                <div class="form-group">
                                    <label for="precio_compra">Precio de compra</label>
                                    <input data-requerido="true" class="form-control" type="number" id="precio_compra"
                                        placeholder="Precio de compra">
                                </div>
                                <div class="form-group">
                                    <label for="precio_venta">Precio de venta</label>
                                    <input data-toggle="tooltip" title="El precio de venta no puede ser menor que el precio de compra."
                                        data-placement="top" data-requerido="true" class="form-control" type="number" id="precio_venta"
                                        placeholder="Precio de venta">
                                </div>
                                <div class="form-group">
                                    <p hidden="hidden" class="h5"><strong>Utilidad: </strong>$<span id="mostrar_utilidad"></span></p>
                                </div>
                                <div class="form-group">
                                    <label for="inventario">Inventario inicial</label>
                                    <input data-requerido="true" class="form-control" type="number" id="inventario"
                                        placeholder="Inventario inicial">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Cantidad en stock</label>
                                    <input data-requerido="true" class="form-control" type="number" id="stock"
                                        placeholder="Cantidad mínima que puede existir">
                                </div>
                                <div class="form-group">
                                    <label for="stock">Familia o proveedor</label>
                                    <input data-requerido="true" class="form-control" type="text" id="familia"
                                        placeholder="Proveedor">
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div hidden="hidden" class="text-center alert alert-success">
                                            <p id="mostrar_resultados"></p>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <button id="guardar_producto" class="form-control btn btn-info">Guardar</button>
                                    </div>
                                    <div class="col-xs-6" hidden="hidden">
                                        <button id="cancelar_producto_editado" class="form-control btn btn-warning">Cancelar</button>
                                    </div>
                                </div>
                                <br>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
                    <div class="col-xs-12 col-sm-9">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="form-group">
                                    <input type="text" id="buscar_producto" class="form-control"
                                        placeholder="Buscar producto por id o nombre">
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">P.Compra</th>
                                            <th class="text-center">P.Venta</th>
                                            <th class="text-center">Utilidad</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Min</th>
                                            <th class="text-center">Familia</th>
                                            <th class="text-center" style="width: 10em;">Opciones</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cuerpo_tabla_productos">
                                        </tbody>
                                    </table>
                                </div>
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
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div>
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
                <p class="h5">¿Realmente deseas eliminar el producto? Esta opción no se puede deshacer.</p>
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


<div id="modal_agregar_piezas" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar piezas</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="numero_piezas_agregar">Ingresa el número de piezas que quieres agregar</label>
                    <input class="form-control" placeholder="Ingresa el número de piezas que quieres agregar"
                           type="number" id="numero_piezas_agregar">
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div hidden="hidden" class="alert text-center">
                            <span id="mostrar_resultados_agregar_piezas"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button id="agregar_piezas" class="form-control btn btn-success">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_dar_baja" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Dar de baja</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="numero_piezas_baja">Ingresa el número de piezas que quieres dar de baja</label>
                    <input class="form-control" placeholder="Ingresa el número de piezas que quieres dar de baja"
                           type="number" id="numero_piezas_baja">
                </div>
                <div class="form-group">
                    <label for="motivo_baja">Razón de baja</label>
                    <textarea style="resize: none;" class="form-control" placeholder="Razón de baja" type="number"
                              id="motivo_baja"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div hidden="hidden" class="alert text-center">
                            <span id="mostrar_resultados_dar_baja"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button id="dar_baja" class="form-control btn btn-warning">Dar de baja</button>
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


<script type="text/javascript" src="./js/inventarios.js"></script>
<script type="text/javascript" src="./lib/np.js"></script>
<script>

    // Show the progress bar 
    NProgress.start();

    // Increase randomly
    var interval = setInterval(function () {
        NProgress.inc();
    }, 1000);

    // Trigger finish when page fully loaded
    jQuery(window).load(function () {
        clearInterval(interval);
        NProgress.done();
    });

    // Trigger bar when exiting the page
    jQuery(window).unload(function () {
        NProgress.start();
    });

</script>