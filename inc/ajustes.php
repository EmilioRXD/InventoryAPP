<body class="<?php echo THEME ?> sidebar-collapse sidebar-open">
    <div class="wrapper">

    <?php
        if (!isset($_SESSION)) exit("<script>window.location.href = '../';</script>");
    ?>
    
        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper" style="margin: 0;">
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <!-- left column -->
                    <div class="col-sm-8">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <!-- Title column -->
                                <div class="col-xs-12">
                                    <h3>
                                        Usuarios
                                        <small></small>
                                    </h3>
                                </div><!-- /.col -->
                                <!-- /Title column -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <table id="tabla-contenedora" class="table table-bordered table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Privilegios</th>
                                            <th style="width:22em;">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <button id="nuevo" class="btn btn-info form-control">Nuevo <i class="fa fa-user-plus"></i></button>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <!-- /left column -->
                    
                    <!-- right column -->
                    <div class="col-sm-4">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <!-- Title column -->
                                <div class="col-xs-12">
                                    <h3>
                                        Divisas
                                        <small></small>
                                    </h3>
                                </div><!-- /.col -->
                                <!-- /Title column -->
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <h4 class="text-center"><strong>Precio Local: </strong>Bs. <?php echo $precio_dolar;?></h4> <br>
                                <form method="POST">
                                    <label for="precio_dolar">Definir Precio Dolar</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" name="precio_dolar" step="0.01" placeholder="Precio Dolar">
                                        <div class="input-group-btn">
                                        <button type="sumit" name="enviar" class="btn btn-danger">Enviar</button>
                                        </div><!-- /btn-group -->
                                    </div>
                                </form>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <h4 class="text-center"><b>¿Bs o $?</b></h4>
                                <div class="form-group">
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                        Bs.
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                        $
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <!-- right column -->

                </div><!-- /.row -->
            </section><!-- /.content -->
        </div>
    </div>
    <!-- MODAL-FORMUARIO -->
    <div id="modal_formulario" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Registrar usuario</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario">Nombre</label>
                        <input type="text" id="usuario" placeholder="Nombre" class="form-control">
                        <span id="mostrar_si_existe">El nombre de usuario debe tener entre <strong>4 y 12</strong><br> carácteres, puede contener letras, números (excepto al inicio) y guiones bajos <strong>(_)</strong>.</span>
                    </div>
                    <div class="form-group">
                        <label for="palabra_secreta">Contraseña</label>
                        <input type="password" id="palabra_secreta" placeholder="Contraseña" class="form-control">
                        <span>La contraseña debe tener entre <strong>8 y 12</strong> carácteres, entre ellos debe haber al menos un dígito <strong>[0-9]</strong>, una letra mayúscula <strong>[A-Z]</strong> y una letra minúscula <strong>[a-z]</strong>.</span>
                    </div>
                    <div class="form-group">
                        <label for="palabra_secreta">Confirmar contraseña</label>
                        <input type="password" id="palabra_secreta_confirm" placeholder="Contraseña" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="checkbox checkbox-warning checkbox-circle">
                            <input checked="false" type="checkbox" id="administrador">
                            <label for="administrador">
                                ¿Administrador?
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-12">
                            <div hidden="hidden" class="alert">
                                <span id="mostrar_resultados">Hola</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <button id="guardar_usuario" class="form-control btn btn-success">Guardar</button>
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

    <div id="modal_formulario_cambiar_pass" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modal_change_password_title">Cambiar contraseña</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usuario">Nueva contraseña</label>
                        <input type="password" id="new_password" placeholder="Nueva contraseña" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="usuario">Repite la nueva contraseña</label>
                        <input type="password" id="confirm_new_password" placeholder="Confirmar contraseña" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-xs-6">
                            <button id="cambiar_pass" class="form-control btn btn-success">Cambiar</button>
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
    <!-- /.MODAL-FORMUARIO -->

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

    <link rel="stylesheet" href="./css/switch.css">
    <script src="./js/usuarios.js"></script>