<?php
require_once 'config/DBconfig.php';
class ConexionDB
{
    // atributo de la clase    
    private $conexion;
    // metodo contructor de la clase se ejecuta cada vez que se cree un nuevo objeto
    // se declaran las variables dentro del metodo constructor porque no va a ser utilizadas en otro metodos.
    public function __construct()
    {
        // variable que guarda la cadena de conexion a la base de datos
        $host = HOST;
        $user = USER;
        $password = PASSWORD;
        $dbname = DBNAME;
        // Metodo try cacth para tratar las distintas exepciones
        try {
            // variable conexion que guarda el nuevo obejo de conexion a la base datos
            $this->conexion = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $password);
            // configuracion de los valores de los atributos para el manejo de errores 
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // desactiva la emulacion de preparacion de consultas los errores son capturados
            // por el bloque cacth
            $this->conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            error_log("error en la conexion a la BBDD");
        } catch (PDOException $e) {
            throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }
    // metodo de la clase para conectarse
    public function get_ObtenerConexion()
    {
        return $this->conexion;
    }
    // metodo de la clase para cerrar la conexion
    public function cerrarConexion()
    {
        $this->conexion = null;
    }
    //metodo para cerrar la conexion cuando el objeto ya no este usando la bbdd
    public function __destruct()
    {
        $this->cerrarConexion();
    }
}
?>