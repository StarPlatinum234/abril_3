<?php
class GruposController {
    private $database;

    public function __construct() {
        require_once 'config/database.php';
        $this->database = new Database();
    }

    public function mostrarGrupos() {
        // Recoger parámetros de solicitud
        $semestre = filter_input(INPUT_GET, 'semestre', FILTER_VALIDATE_INT);
        $grupo = filter_input(INPUT_GET, 'grupo', FILTER_VALIDATE_INT);

        // Datos para la vista
        $viewData = [
            'semestres' => Semestre::obtenerListaSemestres(),
            'semestreSeleccionado' => $semestre,
            'grupoSeleccionado' => $grupo,
            'grupos' => [],
            'alumnos' => []
        ];

        // Obtener grupos si se seleccionó semestre
        if ($semestre) {
            $viewData['grupos'] = $this->database->obtenerGrupos($semestre);
        }

        // Obtener alumnos si se seleccionó grupo
        if ($grupo) {
            $viewData['alumnos'] = $this->database->obtenerAlumnos($grupo);
        }

        // Cargar la vista
        $this->cargarVista($viewData);
    }

    private function cargarVista($datos) {
        // Extraer variables para usar en la vista
        extract($datos);
        
        // Incluir archivo de vista
        require 'view/grupos_view.php';
    }
}
?>