<?php
require_once 'loader.php';
if(isset($_POST['idprop'])){
    
    $idCurso = $_POST['idcurso'];
    $usuario = $_SESSION['usuario'];
    $proposta = $_POST['tipo'];
    $idProposta = $_POST['idprop'];
    
    $Curso = new PainelCursos($idCurso, $usuario);
    $Curso->registrarConclusão($proposta, $idProposta);
    
}

