<?php
/**
 * @project: LibrasON
 * @name: CarregarImagens
 * @description: Essa classe trabalha com a impressão de imagens
 * dos usuários casos eles desejem.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */

include_once 'loader.php';

// Aqui imprimi a foto de perfil a ser cadastrada caso solicitado
if(isset($_REQUEST['FotoPerfilConfig'])){
    Header( "Content-type: image/gif");
    echo $_SESSION['tmpFotoCadastro'];
}

// Aqui imprimi a foto de perfil do usuário logado
if(isset($_REQUEST['FotoPerfil'])){
    Header( "Content-type: image/gif");
    echo Login::carregarFoto($_SESSION['usuario']);
}