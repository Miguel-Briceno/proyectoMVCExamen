<?php
require_once "views/templates/header.php"; //? template header
require_once "views/templates/navPropiedad.php"; //? template navUser 
?>

<div class="contenedor">
    <div class="contenedor-form">
        <form action="index.php?accion=addPropiedad" method="POST" enctype="multipart/form-data">
            <div class="titulo">
                <h2>Agregar producto</h2>
            </div>
            <div class="contenedor-input">
                <label for="nombre">Nombre: </label><br />
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la propiedad" required><br />
            </div>
            <div class="contenedor-input">
                <label for="tamanio">Metros Cuadrados: </label><br />
                <input type="number" name="tamanio" id="tamanio" placeholder="Metros Cuadrados" min="0" max="100000" required><br />
            </div>
            <div class="contenedor-input">
                <label for="dormitorios">Dormitorios: </label><br />
                <input type="number" name="dormitorios" id="dormitorios" placeholder="Nº de dormitorios" min="1" max="10" required><br />
            </div>
            <div class="contenedor-input">
                <label for="banios">Servicios: </label><br />
                <input type="number" name="banios" id="banios" placeholder="Nº de servicios" min="1" max="10" required><br />
            </div>
            <div class="contenedor-input">
                <label for="precio">Precio: </label><br />
                <input type="number" name="precio" id="precio" placeholder="Escribe el precio de la propiedad" min="0" max="100000000" required><br />
            </div>
            <div class="contenedor-input">
                <label for="tipo">Propiedad:</label><br />
                <select name="tipo" id="tipo" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option value="chalet">Chalet</option>
                    <option value="piso">Piso</option>
                </select><br />
            </div>
            <div class="contenedor-input">
                <label for="img">Imagen:</label><br />
                <input type="file" name="img" id="img" alt="foto propiedad" required><br />
            </div>
            <div class="contenedor-input">
                <label for="direccion">Dirección: </label><br />
                <input type="text" name="direccion" id="direccion" placeholder="Dirección de la propiedad" required><br />
            </div>
            <div>
                <label for="descripcion">Descripción: </label><br />
                <textarea name="descripcion" id="descripcion" cols="32" rows="4" placeholder="Descripción de la propiedad" required></textarea><br />
            </div>
            <input class="btn btn--primario" type="submit" value="Agregar" name="agregar">
            <input type="hidden" name="addPropiedad" value="salvar">
    </div>
    
    </form>
    
</div>
<div class="atras">
        <a href="index.php?accion=atras"><img src="asset/img/atras.png" alt="Regresar"></a>
    </div>
</div>
<?php
require_once "views/templates/footer.php"; //? template footer    
?>