<?php
/**
 * @project: LibrasON
 * @name: LoginDoUsuario
 * @description: Trabalha com o Controller para realizar o Login do Usuário e retornar
 * os status dessas tentativas de login
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */
require_once 'loader.php';

// É execultado o codigo so caso o formulario de login seja o caminho para essa pagina
if(isset($_REQUEST['logarusuario'])){
    
    //Coleta de dados
    $usuario = $_REQUEST['userNick'];
    $senha = $_REQUEST['userSenha'];
    
    //Trabalhando com a classe Login do Controller
    $login = new Login;
    $login->inserirDados($usuario, $senha) ;
    
    if($login->vereficarExistencia()){
        if($login->autenticar()){
            $login->iniciarSessao();
            //realiando redirecionamentos dependendo dos retornos
            echo "<script>window.location.href = 'View/Home.php'</script>";
        }else{
            echo "<script>window.location.href = 'View/Inicio.php?ERRO=6'</script>";
        }
    }else{
        echo "<script>window.location.href = 'View/Inicio.php?ERRO=5'</script>";
    }
}else{
    echo "<script>window.location.href = 'View/Inicio.php?ERRO=7'</script>";
}
