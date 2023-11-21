<?php

    require_once 'Pieza/pieza.php';
    require_once 'Usuario/usuario.php';
    require_once 'Vehiculo/Vehiculo.php';
    require_once 'Propietario/Propietario.php';
    require_once 'Reparaciones/Reparacion.php';

    class Modelo{
        private $conexion;
        const URL='mysql:host=127.0.0.1;port=3306;dbname=taller';
        const USUARIO='root';
        const PS='';
        

        function __construct()
        {
            try {
                //Establecer conexion con la base de datos
                $this->conexion = new PDO(Modelo::URL, Modelo::USUARIO, Modelo::PS);
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

        }


//----------------------------------------------------------------USUARIO----------------------------------------------------------------\\
        

    function obtenerUsuario(string $us, string $ps)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from usuarios 
                            where dni = ? and ps = sha2(?,512)');
            $params = array($us, $ps);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerUsuarioDni(string $dni){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from usuarios where dni = ?');
            $params = array($dni);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    function obtenerUsuarioId(int $id){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from usuarios where id = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                //Ver si se ha devuelto 1 registro con el usuario
                if ($fila = $consulta->fetch()) {
                    //Se ha encontrado el usuario
                    $resultado = new Usuario(
                        $fila['id'],
                        $fila['dni'],
                        $fila['nombre'],
                        $fila['perfil']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }
    
    function obtenerUsuarios(){
        //Devuelve un array de piezas
        $resultado = array();

        try {
            //Ejecutamos consulta
            $datos = $this->conexion->query('SELECT * from usuarios order by perfil, nombre');  
            if($datos != false){
                //Recorrer los datos para crear onjetos pieza
                while ($fila = $datos->fetch()){
                    $u= new Usuario(
                    $fila['id'],
                    $fila['dni'],
                    $fila['nombre'],
                    $fila['perfil']
                );

                    //Añadir resultado
                    $resultado[] = $u;
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }

        return $resultado;
    }

    function crearUsuario($u){
        $resultado = false;

        try {
            $consulta = $this->conexion->prepare('INSERT into usuarios value(default,?,?,sha2(?,512),?)');
            $param = array($u->getDni(), $u->getNombre(), $u->getDni(), $u->getPerfil());
            if($consulta->execute($param)){
                if($consulta->rowCount()==1){
                    $u->setId($this->conexion->lastInsertId());
                    $resultado=true;
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }

        return $resultado;

    }

    function existenReparacionesU(int $id){
        $resultado = false;

        try {
            $consulta = $this->conexion->prepare('SELECT * from reparacion where usuario= ?');
            $parametro = array($id);
            if($consulta->execute($parametro)){
                if($consulta->fetch()){
                    $resultado = true;
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }

        return $resultado;
    }

    function borrarUsuario(int $id){
        $resultado = false;

        try {
            $consulta = $this->conexion->prepare('DELETE from usuarios where id= ?');
            $parametro = array($id);
            if($consulta->execute($parametro)){
                if($consulta->rowCount() == 1){
                    $resultado = true;
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }

        return $resultado;
    }

    function modificarUsuario(Usuario $u){
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('UPDATE usuarios set dni=?, nombre=?, perfil=? where id=?');
            $param = array($u->getDni(), $u->getNombre(), $u->getPerfil(), $u->getId());
            if($consulta->execute($param)){
                if($consulta->rowCount() == 1){
                    $resultado=true;
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }


//----------------------------------------------------------------PIEZA----------------------------------------------------------------\\


        function insertarPieza(Pieza $p){
            $resultado = false;
            
            try {
                $consulta = $this->conexion->prepare('INSERT into pieza values (?,?,?,?,?)');
                $parms = array($p->getCodigo(), $p->getClase(), $p->getDescripcion(), $p->getPrecio(), $p->getStock());
                if($consulta->execute($parms)){
                    $resultado=true;
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function obtenerPieza($codigo){
            $resultado = null;

            try {
                $consulta = $this->conexion->prepare('SELECT * from pieza where codigo = ?');
                $parms = array($codigo);
                if($consulta->execute($parms)){
                    //recuperar el registro y crear un objeto pieza en resultado
                    if($fila=$consulta->fetch()){
                        $resultado = new Pieza();
                        $resultado->setCodigo($fila['codigo']);
                        $resultado->setClase($fila['clase']);
                        $resultado->setDescripcion($fila['descripcion']);
                        $resultado->setPrecio($fila['precio']);
                        $resultado->setStock($fila['stock']);
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function obtenerPiezas(){
            //Devuelve un array de piezas
            $resultado = array();

            try {
                //Ejecutamos consulta
                $datos = $this->conexion->query('SELECT * from pieza');  
                if($datos != false){
                    //Recorrer los datos para crear onjetos pieza
                    while ($fila = $datos->fetch()){
                        $p= new Pieza();
                        $p->setCodigo($fila['codigo']);
                        $p->setClase($fila['clase']);
                        $p->setDescripcion($fila['descripcion']);
                        $p->setPrecio($fila['precio']);
                        $p->setStock($fila['stock']);

                        $resultado[] = $p;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function existenReparacionesP(string $codigo){
            $resultado = false;

            try {
                $consulta = $this->conexion->prepare('SELECT * from piezareparacion where pieza= ?');
                $parametro = array($codigo);
                if($consulta->execute($parametro)){
                    if($consulta->fetch()){
                        $resultado = true;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function borrarPieza(string $codigo){
            $resultado = false;

            try {
                $consulta = $this->conexion->prepare('DELETE from pieza where codigo= ?');
                $parametro = array($codigo);
                if($consulta->execute($parametro)){
                    //Comprobar si se a borrado al menos un registro
                    //En ese caso devuelve true
                    if($consulta->rowCount() == 1){
                        $resultado = true;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }

            return $resultado;
        }

        function modificarPieza(Pieza $p, string $codigoAntiguo){
            $resultado = false;
            try {
                $consulta = $this->conexion->prepare('UPDATE pieza set codigo=?, clase=?, descripcion=?, precio=?, stock=? where codigo=?');
                $param = array($p->getCodigo(), $p->getClase(), $p->getDescripcion(), $p->getPrecio(), $p->getStock(), $codigoAntiguo);
                if($consulta->execute($param)){
                    if($consulta->rowCount() == 1){
                        $resultado=true;
                    }
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            return $resultado;
        }


//----------------------------------------------------------------Vehiculo----------------------------------------------------------------\\


function obtenerVehiculos($propietario){
    $resultado = array();

    try {
       $consulta = $this->conexion->prepare("SELECT * from vehiculo where propietario = ?");
       $param =array($propietario);
       if($consulta->execute($param)){
        while($fila=$consulta->fetch()){
            $v = new Vehiculo($fila[0], $fila[1], $fila[2], $fila[3]);
            $resultado[]=$v;
        }
       }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

    return $resultado;
}

function obtenerVehiculo($matricula){
    $resultado = null;

    try {
       $consulta = $this->conexion->prepare("SELECT * from vehiculo where matricula = ?");
       $param =array($matricula);
       if($consulta->execute($param)){
        if($fila=$consulta->fetch()){
            $resultado = new Vehiculo($fila[0], $fila[1], $fila[2], $fila[3]);
        }
       }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

    return $resultado;
}

function obtenerVehiculoId($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from vehiculo 
            where codigo = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Vehiculo(
                        $fila['codigo'],
                        $fila['propietario'],
                        $fila['matricula'],
                        $fila['color']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

function crearVehiculo(Vehiculo $v){
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare('INSERT into vehiculo values(default, ?, ?, ?)');
        $param = array($v->getPropietario(), $v->getMatricula(), $v->getColor());
        if($consulta->execute($param)){
            if($consulta->rowCount() == 1);{
                $resultado = true;
            }
        }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
    return $resultado;
}


//----------------------------------------------------------------Propietario----------------------------------------------------------------\\


function obtenerPropietarios(){
    $resultado = array();

    try {
        $datos = $this->conexion->query('SELECT * from propietario order by nombre');
        while($fila = $datos->fetch()){
            $p = new Propietario($fila['codigo'], $fila['dni'], $fila['nombre'], $fila['telefono'], $fila['email']);
            $resultado[] = $p;
        }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

    return $resultado;
}

function obtenerPropietario($dni){
    $resultado = null;

    try {
       $consulta = $this->conexion->prepare("SELECT * from propietario where dni = ?");
       $param =array($dni);
       if($consulta->execute($param)){
        if($fila=$consulta->fetch()){
            $resultado = new Propietario($fila[0], $fila[1], $fila[2], $fila[3], $fila[4]);
        }
       }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

    return $resultado;
}
        

function crearPropietario(Propietario $p){
    $resultado = false;
    try {
        $consulta = $this->conexion->prepare('INSERT into propietario values(default, ?, ?, ?, ?)');
        $param = array($p->getDni(), $p->getNombre(), $p->getTelefono(), $p->getEmail());
        if($consulta->execute($param)){
            if($consulta->rowCount() == 1);{
                $resultado = true;
                $p->setId($this->conexion->lastInsertId());
            }
        }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }
    return $resultado;
}

//----------------------------------------------------------------Reparaciones----------------------------------------------------------------\\


function obtenerReparaciones($idV){
    $resultado = null;

    try {
       $consulta = $this->conexion->prepare("SELECT * from reparacion where coche = ? order by fechaHora desc");
       $param =array($idV);
       if($consulta->execute($param)){
        while($fila=$consulta->fetch()){
            $r= new Reparacion($fila['id'], $fila['coche'], $fila['fechaHora'], $fila['tiempo'], $fila['pagado'], $fila['usuario'], $fila['precioH']);
            $resultado[] = $r;
        }
       }
    } catch (PDOException $th) {
        echo $th->getMessage();
    }

    return $resultado;
}

function crearReparacion(Reparacion $r){
    $resultado = false;

    try {
        $consulta = $this->conexion-> prepare('INSERT into reparacion values (default, ?, now(), 0, false, ?, 0)');
        $param = array($r->getCoche(), $r->getUsuario());
        if($consulta->execute($param)){
            if ($consulta->rowCount()==1){
                $resultado= true;
                $r->setId($this->conexion->lastInsertId());
            }
        }
     } catch (PDOException $th) {
         echo $th->getMessage();
     }

    return $resultado;
}



//----------------------------------------------------------------Getter & Setter----------------------------------------------------------------\\

        /**
         * Get the value of conexion
         */ 
        public function getConexion()
        {
                return $this->conexion;
        }

        /**
         * Set the value of conexion
         *
         * @return  self
         */ 
        public function setConexion($conexion)
        {
                $this->conexion = $conexion;

                return $this;
        }
    }

?>