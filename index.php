<?php
// Incluir archivos necesarios
require_once 'models/Semestre.php';
require_once 'controllers/GruposController.php';

// Iniciar controlador y mostrar grupos
$controller = new GruposController();
$controller->mostrarGrupos();
?>