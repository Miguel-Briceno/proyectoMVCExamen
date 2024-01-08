<?php
require_once "views/templates/header.php"; //? template header
require_once "views/templates/navUser.php"; //? template navUser
?>

<div class="contenedorError">
    <?php if (isset($informacion)): ?>
        <?php foreach ($informacion as $res): ?>
            <p class="error"><?php echo $res; ?> </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div><!-- final Clase errores-->
<div class="titulo">
    <h2>Login Vendedores</h2>
</div><!-- final Clase título -->
<div class="contenedor-form">
    <!--// aqui se encuentra el primer formulario que envia la información de login email y password
            // a traves de la url se para una clave valor a la raiz del proyecto donde se va a procesar
            -->
    <form class="formulario" action="index.php?accion=login" method="POST" >
        <div class="contenedor-input">
            <label class="label" for="email">Correo Electronico:</label><!-- email-->
            <input class="input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" maxlength="45" required>
        </div>
        <div class="contenedor-input">
            <label class="label" for="contrasenia">Contraseña:</label><!-- password-->
            <input class="input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contrasenia"  required>
        </div>
        <input type="hidden" name="inicioSession">
        <input class="btn btn--primario" type="submit" value="Logín">
    </form>
</div><!-- final Clase contenedor-form -->
<div>
    <p>Si aun no estás registrado pulsa <a href="index.php?accion=registro"><b>Aqui.</b></a></p>
</div><!-- fin clase contenedor-enlace -->

<?php
require_once "views/templates/footer.php"; //? template footer
?>