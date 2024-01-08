<?php
// Se requiere el modelo User
require_once('models/User_model.php');
require_once('models/Propiedades_model.php');
require_once('models/Validaciones_model.php');

class ControllerUser{
    
    public $informacion = [];
    public function pagInicio(){// metodo que nos lleva a la vista index y carga las propiedades en la vista index
        if(isset($_SESSION['usuario'])){
            session_unset();
            session_destroy();
        }   
        $propiedad = new Propiedad();
        $resultados = $propiedad->get_Propiedades();        
        require_once "views/user/index.php";
        exit;
    }
    
    public function inicioSession(){  // metodo que nos lleva a la vista login
        require_once "views/user/login.php";
        exit;
    }
    
    public function login(){// metodo que nos permite loguearnos
        if (isset($_POST['inicioSession'])) {//  se chequea el metodo post que sale por el formulario con clave inicioSession
            $validaciones=new Validaciones();
            $usuario=$validaciones->validarEmail($_POST['email']);//validacion Email
            if($usuario == false){
                $informacion[]="Debe ingresar un Email válido";
                require_once 'views/user/login.php';
                exit;
            }                
            $usuario = new User($_POST['email'],$_POST['contrasenia']);// una vez que existe procedemos a tomar el valor que viene en el array POST
            $usuarioExiste=$usuario->comprobarUsuario($_POST['email']);            
            if (!$usuarioExiste) {
                $informacion[]= "<p>Usuario no existe</p>";
                require_once 'views/user/login.php';
                exit;
            }
            else {// si el usuario existe comprobamos la contraseña que esta en la base de datos                 
                $contraseniaDB = $usuarioExiste['contrasenia'];// con la contraseña que ingresa el usuario y si coinciden se inicia sessión
                $passVerificado=password_verify($_POST['contrasenia'], $contraseniaDB);//!para descifrar
                if ($passVerificado) {                                         
                    $_SESSION['usuario'] = $usuarioExiste['email'];// se crea la clave usuario en el array $_SESSION
                    $_SESSION['id'] = $usuarioExiste['id'];// se crea la clave id en el array $_SESSION
                    
                    if(!isset($_COOKIE['usuario'])){
                    setcookie("usuario", $_POST['email'], time() + 3600);   // definimos la cokies con el usuario qu ha accedido                  
                    }
                    $propiedades= new ControllerPropiedades;
                    $resultados = $propiedades->cargar($_POST['email']);                    
                    require_once "views/propiedad/propiedades.php";                   
                } else {
                    $informacion[]="La contraseña es incorrecta.";
                    require_once 'views/user/login.php';
                    exit;
                }
            }
        }
    }
    
    public function registro(){// metodo que nos lleva a la vista registro
        require_once "views/user/registro.php";
    }

    public function registrar(){      // metodo que nos resgistra al usuario  
        if (isset($_POST['registrar'])) {
            $validaciones=new Validaciones();
            $usuario=$validaciones->validarEmail($_POST['email']);//validacion Email
            if($usuario == false){
                $informacion[]="Debe ingresar un Email válido";
                require_once 'views/user/registro.php';
                exit;
            }
            if($_POST['contrasenia']!==$_POST['conContrasenia']){//validacion que las contraseñas introducidas sean iguales
                $informacion[]="Las contraseñas no coinciden";
                require_once 'views/user/registro.php';
                exit;
            }
            $contrasenia=$validaciones->validarContrasenia($_POST['contrasenia']);//validacion Contraseña
            if($contrasenia!==true){
                $informacion=$contrasenia;
                require_once 'views/user/registro.php';
                exit;
            }

            $usuario = new User($_POST['email'],$_POST['contrasenia']);// una vez que existe procedemos a tomar el valor que viene en el array POST
            $usuarioExiste=$usuario->comprobarUsuario($_POST['email']);            
            if ($usuarioExiste) {
                $informacion[]= "Este Usuario ya existe";
                require_once 'views/user/registro.php';
                exit;
            }else{
                $contraseniaReg=$_POST['contrasenia'];//!cifrar la contraseña
                $contraseniaReg = password_hash($contraseniaReg, PASSWORD_DEFAULT);
                $usuario = new User($_POST['email'],$contraseniaReg);
                $resul=$usuario->set_Registrar($_POST['email'], $contraseniaReg);//registro de usuario
                $resul ?  $usuarioRegistrado = "Usuario registrado con éxito!!!": $informacion[]="ocurrio un error durante el registro";
                require_once 'views/user/registro.php';
                exit;
                
            }             
        }
        
    }
    
}

?>