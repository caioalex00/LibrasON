<?php
/**
 * @name: CursoBD
 * @description: Arquivo que trabalha com as inscrições em cursos
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */

require_once 'loader.php';

//Imprime Regulamento
if(isset($_GET['gerarRegulamento'])){
    $idCurso = $_GET['gerarRegulamento'];
    $regulamento = new Curso(null,null);
    echo $regulamento->retornarRegulamento($idCurso);

//Imprime informações a cerca do certificado de um curso    
}if(isset($_GET['gerarCertificado'])){
    $idCurso = $_GET['gerarCertificado'];
    $certificacao = new Curso(null,null);
    echo $certificacao->retornarCertificacao($idCurso);
    
}if(isset($_GET['inscreverCurso'])){
    //Inscricao em Curso Online Gratis
    $idCurso = $_GET['inscreverCurso'];
    $usuario = $_SESSION['usuario'];
    $inscricao = new Curso($idCurso, $usuario);
    
    if(!$inscricao->verificarDisponiblidadeInscricao()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=4'</script>";
    
    }else if(!$inscricao->vereficarInscriçãoNoCurso()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=5'</script>";
        
    }else if(!($inscricao->vereficarTipoCurso() == 1)){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=6'</script>";
        
    }else if($inscricao->inscreverCurso()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=7'</script>";
        
    }else{
       echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=8'</script>";
        
    }
    
}if(isset($_POST['inscricaoPresencial'])){
    //Inscricao em Curso Presencial Codigo Unico
    $idCurso = $_POST['inscricaoPresencial'];
    $usuario = $_SESSION['usuario'];
    $codigo = $_POST['codigoAcesso'];
    $inscricao = new Curso($idCurso, $usuario);
    
    if(!$inscricao->vereficarCodigoDeInscricao($codigo)){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=3'</script>";
    
    }else if(!$inscricao->verificarDisponiblidadeInscricao()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=4'</script>";
    
    }else if(!$inscricao->vereficarInscriçãoNoCurso()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=5'</script>";
        
    }else if(!($inscricao->vereficarTipoCurso() == 2)){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=6'</script>";
        
    }else if($inscricao->inscreverCurso()){
        echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=7'</script>";
        
    }else{
       echo "<script>window.location.href = 'View/Cursos.php?MSGINSCRICAO=8'</script>";
        
    }
}