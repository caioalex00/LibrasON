<?php
/**
 * @project: LibrasON
 * @name: CadatroDeUsuario
 * @description: Essa classe trabalha com as classes para registrar o usuário
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */
require_once 'loader.php';;

$cadastro = new Cadastro();

// Amarzena os dados do formulario e recorte de foto
$usuario = $_POST['userNick'];
$nomeUsuario = $_POST['userNome'];
$sobrenomeUsuario = $_POST['userSobrenome'];
$senhaUsuário = $_POST['userSenha'];
$senhaRevisaoUsuario = $_POST['userSenhaC'];
$emailUsuario = $_POST['userEmail'];
$x = $_POST['x'];
$y = $_POST['y'];
$w = $_POST['w'];
$h = $_POST['h'];
$foto = $_SESSION['tmpFotoCadastroCaminho'];

//Trabalha com o controller para registrar os dados
$cadastro->definirDados($usuario, $nomeUsuario, $sobrenomeUsuario,
        $senhaUsuário, $senhaRevisaoUsuario, $emailUsuario);

$cadastro->definirFoto($foto, $x, $y, $w, $h);

if($cadastro->validarDados()){
    $cadastro->realizarRegistro();
    if($cadastro->vereficarCadastroRealizado()){
        // realiza redirecionamento caso haja sucesso no cadastro
        echo "<script>window.location.href = 'View/Inicio.php?SucessoNoCadastro'</script>";
    }else{
        // Realiza redirecionamento caso tenha havido algum erro na hora de registro em banco
        $src = "Temp/" . $_SESSION['tmpFotoCadastroCaminho'];
        unlink($src);
        echo "<script>window.location.href = 'View/Inicio.php?ErroNoCadastro'</script>";
    }
}else{
    // Realiza redirecionemento caso o usuário tenha digitado algum dado invalido
    $src = "Temp/" . $_SESSION['tmpFotoCadastroCaminho'];
    unlink($src);
    echo "<script>window.location.href = 'View/Inicio.php?$cadastro->erro'</script>";
}
