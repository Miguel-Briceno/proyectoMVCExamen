<!-- Se hace el requerimiento de el template header-->
<?php
require_once "views/templates/header.php"; //? template header
require_once "views/templates/navPropiedad.php"; //? template navUser 
?>

<!-- Titulo-->
<div class="titulo">
    <h2>Estamos Editando una Propiedad</h2>
</div>
<!-- formulario -->
<div class="contenedor-form">
    <?php if (!empty($resultados)) : ?>
        <?php foreach ($resultados as $resultado => $valor) : ?>
            <form action="index.php?accion=actualizar" method="POST">
                <div class="contenedor-input">
                    <label for="id">Id:</label>
                    <input type="text" name="id_pro" id="id" value="<?= $valor['id_pro'] ?>" readonly>
                </div>
                <div class="contenedor-input">
                    <label for="nombre_pro">Nombre:</label>
                    <input type="text" name="nombre_pro" id="nombre_pro" value="<?= $valor['nombre_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="tamanio_pro">Tamaño:</label>
                    <input type="number" name="tamanio_pro" id="tamanio_pro" value="<?= $valor['tamanio_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="dormitorios_pro">Dormitorios:</label>
                    <input type="number" name="dormitorios_pro" id="dormitorios_pro" value="<?= $valor['dormitorios_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="banios_pro">Baños:</label>
                    <input type="number" name="banios_pro" id="banios_pro" value="<?= $valor['banios_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="precio_pro">Precio:</label>
                    <input type="number" name="precio_pro" id="precio_pro" value="<?= $valor['precio_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="tipo_pro">Tipo:</label>
                    <?php if($_valor['tipo_pro']='chalet'): ?>
                    <select name="tipo_pro" id="tipo_pro">
                        <option value="chalet" selected>Chalet</option>
                    <?php else: ?>
                        <option value="Piso" selected>Piso</option>                        
                    </select>
                    <?php endif; ?>
                </div><br><br>                                
                <div class="contenedor-input">
                    <div class="imagen"><label for="img_pro"><?php echo '<img  src="asset/img/'.$valor["img_pro"].' " alt="foto '.$valor["nombre_pro"].' ">'?></label></div>
                    <input type="file" name="img_pro" id="img_pro" value="<?php $valor["nombre_pro"];?>">
                </div>
                <div class="contenedor-input">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion_pro" id="direccion" value="<?= $valor['direccion_pro'] ?>">
                </div>
                <div class="contenedor-input">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion_pro" id="descripcion" cols="30" rows="10"><?= $valor['descripcion_pro'] ?></textarea>
                </div>
                <div class="contenedor-input">
                    <label for="idvendedor">Id Vendedor:</label>
                    <input type="number" name="id_vendedor" id="idvendedor" value="<?= $valor['id_vendedor'] ?>" readonly>
                </div>
                <div class="contenedor-input">
                    <input class="btn btn-tabla btn-tabla--secundario" type="submit" name="accion" value="Editar">

                </div>
                <div class="atras">
                    <a href="index.php?accion=atras"><img src="asset/img/atras.png" alt="Regresar"></a>
                </div>
            </form>
        <?php endforeach; ?>
        <!-- Si no existen productos en la bbdd se muestra el mensaje -->
    <?php else : ?>
        <tr>
            <td colspan="6">"No hay propiedades"</td>
        </tr>
    <?php endif; ?>
</div>
<!-- Se hace el requerimiento de el template footer-->
<?php require_once 'views/templates/footer.php'; ?>