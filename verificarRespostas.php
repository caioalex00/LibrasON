<?php
require_once 'loader.php';

if(!empty($_POST)){
    
    $idUsuario = $_SESSION['usuario'];
    $idCurso = $_POST['Curso'];
    $idTarefa = $_POST['Tarefa'];
    $Questoes = array();
    
    for($i = 1; $i < 11; $i++){
        $Questoes[$i] = $_POST["questao_$i"];
    }
    
    $verificar = new Tarefa($idTarefa, $idCurso, $idUsuario);
    
    $acertos = $verificar->verificarRespostas($Questoes);
    
    $msg = "";
    $pct = $acertos * 10;
    
    if($acertos <= 6){
        $msg = 1;
    }else if ($acertos > 6 && $acertos < 8) {
        $msg = 2;
    }else if ($acertos < 10) {
        $msg = 3;
    } else {
        $msg = 4;
        
        $user = new Usuario();
        $id = $user->pesquisarID($idUsuario);
        
        $create = new Create('usuario_has_tarefas', '`FK_idTarefas`, `FK_idUsuario`', $idTarefa . '|\|R' . $id);
        $create->executarQuery();
        print_r($create->erroPDO);
    }
    
    echo "<script>window.location.href = 'View/PainelUsuarioCurso.php?ID=$idCurso&msg=$msg&pct=$pct'</script>";
}
