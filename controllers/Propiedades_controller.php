<?php

// requiere el modelo siguiente
require_once('models/User_model.php');
require_once('models/Propiedades_model.php');

// clase accion controller que es requerida por el index del proyecto
class ControllerPropiedades{

    public $informacion=[];
    public function cargar($usuario){// metodo cargar
        $propiedad = new Propiedad();
        $resultados = $propiedad->get_Cargar($usuario); // cargar propiedades por usuario 
        $contador = new Propiedad();
        $contador = $contador->contarPropiedades($usuario);
        if(isset($_COOKIE['contador'])){// con un condicional veo si la cookie existe o no, y sino se crea 
            $_COOKIE['contador']=$contador;  //la cookie almacena el valor de la funcion.
        }else{
            setcookie('contador',$contador,time() + 3600);
        }        
        require_once 'views/propiedad/propiedades.php';
        exit;        
    }
    
    public function agregar(){// metodo agregar para facilitarnos el formulario
        require_once "views/propiedad/agregar.php";
    }

    public function addPropiedad(){// metodo para agregar a la bbdd una propiedad
        try{
            if(isset($_GET['accion']) && $_POST['addPropiedad']=='salvar'){
                $validacion = new Validaciones();
                $correcto = $validacion->validarNombre($_POST['nombre']);//validaciones
                if(!$correcto){
                    $informacion[]="Debe ingresar un nombre válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarTamanio($_POST['tamanio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tamanio válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }
                $correcto = $validacion->validarDormitorios($_POST['dormitorios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de dormitorios válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarBanios($_POST['banios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de baños válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarPrecio($_POST['precio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un precio válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }               
                $correcto = $validacion->validarTipo($_POST['tipo']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tipo válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }
                $correcto = $validacion->validarImg($_FILES['img']);                
                if($correcto){
                    $imagen = new Propiedad();
                    $imagen = $imagen->crearImagenes($_FILES['img']);
                }                
                $correcto = $validacion->validarDireccion($_POST['direccion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una direccion válida";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }              
                $correcto = $validacion->validarDescripcion($_POST['descripcion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una descripcion válida";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                } 
                $idVendedor = $_SESSION['id'];            
                $propiedad = new Propiedad();
                $resultados=$propiedad->set_CrearPropiedad($_POST['nombre'],$_POST['tamanio'],$_POST['dormitorios'],$_POST['banios'],$_POST['precio'],$_POST['tipo'],$imagen,$_POST['direccion'],$_POST['descripcion'],$idVendedor);
                if($resultados=true){                   
                    $propiedades= new ControllerPropiedades;
                    $resultados = $propiedades->cargar($_SESSION['usuario']);// se pueden cargar las propiedades por el id y se reutiliza el codigo
                    //pero para efectos de los requisitos en el metodo cargar se hace un join                    
                    require_once "views/propiedad/propiedades.php";
                    exit;
                }
            }else{echo "Datos de producto faltantes o inválidos";}
        }catch (Exception $e) { 
            throw new Exception("Error al obtener propiedades del usuario: " . $e->getMessage());
                error_log("Error al obtener propiedades del usuario". $e->getMessage());
            }

    }
    
    public function editar(){//Metodo que muestra los datos de la propiedad para ser editados
        try{
            if(isset($_GET['accion'])&& $_GET['accion']=='editar'){
                $id = $_GET['id'];
                $propiedad = new Propiedad();
                $resultados = $propiedad->get_PropiedadesById_pro($id);
                require_once "views/propiedad/editar.php";
                exit;
            }
        }
        catch (Exception $e) {
            throw new Exception("Error al editar propiedad: " . $e->getMessage());
            error_log("Error al editar propiedad: ". $e->getMessage());
        }
    }
    
    public function actualizar(){// metodo actualizar
        try{   
            if(isset($_POST['accion'])&& $_POST['accion']=='Editar'){
                $id = $_POST['id_pro'];
                $validacion = new Validaciones();
                $correcto = $validacion->validarNombre($_POST['nombre']);//validaciones
                if(!$correcto){
                    $informacion[]="Debe ingresar un nombre válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarTamanio($_POST['tamanio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tamanio válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }
                $correcto = $validacion->validarDormitorios($_POST['dormitorios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de dormitorios válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarBanios($_POST['banios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de baños válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $correcto = $validacion->validarPrecio($_POST['precio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un precio válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }               
                $correcto = $validacion->validarTipo($_POST['tipo']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tipo válido";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }
                $correcto = $validacion->validarImg($_FILES['img']);                
                if($correcto){
                    $imagen = new Propiedad();
                    $imagen = $imagen->crearImagenes($_FILES['img']);
                }                
                $correcto = $validacion->validarDireccion($_POST['direccion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una direccion válida";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }              
                $correcto = $validacion->validarDescripcion($_POST['descripcion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una descripcion válida";
                    require_once 'views/propiedad/agregar.php';
                    exit;
                }                
                $idVendedor = $_POST['id_vendedor'];            
                $propiedad = new Propiedad();
                $propiedad->set_PropiedadesById($id, $nombre,$tamanio,$dormitorios,$banios, $precio,$tipo,$img,$direccion, $descripcion, $idVendedor);
                $propiedades= new ControllerPropiedades;
                $resultados = $propiedades->cargar($_SESSION['usuario']);
                require_once "views/propiedad/propiedades.php";
                exit;
            }else{echo "Datos de producto faltantes o inválidos";}
        }catch (Exception $e) {
            throw new Exception("Error al actualizar propiedad: " . $e->getMessage());
            error_log("Error al actualizar propiedad: ". $e->getMessage());
        }
    }

    public function corroborar(){//metodo que llama la propiedad que se va a eliminar            
            if(isset($_GET['accion'])&& $_GET['accion']=='corroborar'){
                $id_pro = $_GET['id'];
                $propiedad = new Propiedad();
                $resultado = $propiedad->get_PropiedadesById_pro($id_pro);                
                require_once 'views/propiedad/eliminar.php'; 
                exit;               
            }
    }
    
    public function eliminar(){// metodo eliminar
        try{
            if(isset($_GET['accion'])&& $_GET['accion']=='eliminar'){            
                $id = $_GET['id'];  
                $propiedad = new Propiedad();
                $resul = $propiedad->delete_PropiedadesById_pro($id);
                $_SESSION["eliminada"] = "La propiedad ha sido eliminada con exito!!!";
                $propiedades= new ControllerPropiedades;
                $propiedades->cargar($_SESSION['usuario']);
            }else{$informacion[]="Datos de producto faltantes o inválidos";}
        }
        catch (Exception $e) {
            throw new Exception("Error al eliminar propiedad: " . $e->getMessage());
            error_log("Error al eliminar propiedad: ". $e->getMessage());
        }
    }
    
    public function cerrarSession(){// metodo que nos permite cerrar la session
        session_unset(); //elimina las variables de sesión
        session_destroy();//destruye las variables de sesión
        header('Location: index.php');
    exit;
    }

    public function atras(){// metodo que nos permite ir hacia atras en las vistas de producto
        $propiedades= new ControllerPropiedades;
        $resultados = $propiedades->cargar($_SESSION['usuario']);
        require_once "views/propiedad/propiedades.php";
    }

    public function filtrar(){//metodo para filtrar pos tres campos precio, tipo, nombre
        if($_POST['realizar']==="filtro"){
            $filtro = $_POST['filtro'];
            $idVendedor = $_SESSION['id'];
            $propiedad = new Propiedad();
            $resultados = $propiedad->get_PropiedadesByFiltro($filtro,$idVendedor);
            require_once "views/propiedad/propiedades.php";
        }
    }

    public function ver(){//Metodo para Visualizar la propiedad seleccionada
        if(isset($_GET['accion'])&& $_GET['accion']=='ver'){
            $id = $_GET['id'];
            $propiedad = new Propiedad();
            $resultados = $propiedad->get_PropiedadesById_pro($id);
            require_once "views/propiedad/ver.php";
        }
    }

    public function no(){//Metodo para ir atras cuando no se quiere eliminar la propiedad
        $propiedades= new ControllerPropiedades;
        $propiedades->cargar($_SESSION['usuario']);
        require_once "views/propiedad/propiedades.php";
    }
    

}
?>