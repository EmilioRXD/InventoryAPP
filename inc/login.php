<body class="login-page">
    <div class="login-box">
        <div class="login-logo">
        <b>Admin</b>LTE
        </div><!-- /.login-logo -->
        <div class="login-box-body">
        <p class="login-box-msg">Inicia sesión</p>
            <div class="form-group has-feedback">
                <label for="usuario">Nombre de usuario</label>
                <input
                    type="text"
                    class="form-control"
                    id="usuario"
                    placeholder="Nombre de usuario"
                    autofocus
                />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <label for="palabra_secreta">Contraseña</label>
                <input
                    type="password"
                    class="form-control"
                    id="palabra_secreta"
                    placeholder="Contraseña"
                />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button id="iniciar_sesion" class="btn btn-primary btn-flat btn-block">Iniciar Sesión</button>
                </div><!-- /.col -->
            </div>
        <br>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <script>
        $(document).ready(function () {
            $("#usuario").focus();
            escuchar_elementos();
        });

        function escuchar_elementos() {
            $("#usuario").keyup(function (evento) {
                if (evento.keyCode === 13) $("#palabra_secreta").focus();
            });

            $("#palabra_secreta").keyup(function (evento) {
                if (evento.keyCode === 13) $("#iniciar_sesion").click();
            });

            $("#iniciar_sesion").click(function () {
                var usuario = $("#usuario").val(),
                    palabra_secreta = $("#palabra_secreta").val();
                if (usuario.length <= 0 || palabra_secreta.length <= 0) {
                    $("#usuario").focus();
                    return;
                }
                var html_original = $("#iniciar_sesion").html();
                $("#iniciar_sesion")
                    .html('Comprobando... <i class="fa fa-spin fa-refresh"></i>')
                    .removeClass('btn-success btn-warning btn-danger')
                    .addClass('btn-warning');
                $.post('./modulos/usuarios/comprobar_datos.php', {datos_usuario: [usuario, palabra_secreta]}, function (respuesta) {

                    respuesta = JSON.parse(respuesta);
                    console.log("La respuesta es:", respuesta);
                    if (respuesta === true) {
                        $("#iniciar_sesion")
                            .html('Correcto <i class="fa fa-check-square"></i>')
                            .removeClass('btn-success btn-warning btn-danger')
                            .addClass('btn-success')
                            .animateCss("bounceOut");
                        setTimeout(function () {
                            window.location.reload();
                        }, 200);
                    } else {
                        $("#iniciar_sesion")
                            .html('Datos incorrectos <i class="fa fa-exclamation"></i>')
                            .removeClass('btn-success btn-warning btn-danger')
                            .addClass('btn-danger')
                            .animateCss("shake");
                        $("#usuario").focus();
                    }
                });
            });
        }
    </script>
    <!-- jQuery 2.1.3 -->
    <script src="./public/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="./public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="./public/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
        $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        });
    </script>
