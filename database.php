<?php
class Database {
    private $conexion;

    public function __construct() {
        try {
            $this->conexion = new mysqli('localhost', 'root', '', 'proyecto3');
            
            if ($this->conexion->connect_error) {
                throw new Exception("Error de conexión: " . $this->conexion->connect_error);
            }
            
            $this->conexion->set_charset("utf8");
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw $e;
        }
    }

    public function obtenerGrupos($semestre) {
        $consulta = "SELECT g.idgrupo, g.grupo, g.turno, e.carrera 
                     FROM grupos g 
                     JOIN especialidad e ON g.idespecialidad = e.idespecialidad 
                     WHERE g.semestre = ?";
        
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('i', $semestre);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerAlumnos($grupo) {
        $consulta = "SELECT nocontrol, nombre, appat, apmat, curp 
                     FROM alumnos 
                     WHERE idgrupo = ?";
        
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param('i', $grupo);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>