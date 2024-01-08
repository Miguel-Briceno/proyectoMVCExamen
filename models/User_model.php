<?php
require_once "Validaciones_model.php";
require_once "ConexionDB_model.php";
// clase usuario para el login y registro 
class User
{
    private $email;
    private $contrasenia;
    private $pdo;
    private $conexion;
    public function __construct($email, $contrasenia)
    {
        $this->email = $email;
        $this->contrasenia = $contrasenia;
        $this->conexion = new ConexionDB;
        $this->pdo = $this->conexion->get_ObtenerConexion();

    }

    
    // Metodo para devolver id
    public function getId($email){
        
        $sentencia = $this->pdo->prepare("SELECT id FROM vendedores WHERE email=?;");
        $sentencia->bindParam(1, $email, PDO::PARAM_STR);
        $sentencia->execute();
        $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
        if ($resultados) {
            return $resultados['id'];
        }
    }

    public function set_registrar(){ // regitrar
        try{           
            $stmt = $this->pdo->prepare("INSERT INTO vendedores(email, contrasenia) VALUES(:email,:contrasenia)");
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":contrasenia", $this->contrasenia);
            $resultado=$stmt->execute();            
            return $resultado;            
        }catch(Exception $e){
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
            error_log("Error al registrar usuario: ". $e->getMessage());
        }
    }

    public function comprobarUsuario($email){// Metodo comprobar usuario y recibe por parametro un $email
        try{
            $sentencia = $this->pdo->prepare("SELECT * FROM vendedores WHERE email=?;");
            $sentencia->bindParam(1, $email, PDO::PARAM_STR);
            $sentencia->execute();
            $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultados;      
            }catch(PDOException $e){
                throw new Exception("Error al comprobar usuario: " . $e->getMessage());
                error_log("Ya esta en la base de datos: ". $e->getMessage());
            }
    }

}
