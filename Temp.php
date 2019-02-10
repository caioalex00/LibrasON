<?php
/**
 * @project: librason
 * @name: Temp
 * @description: realiza trabalhos com a temp
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */


//Limpa temp ao usuario sair da pagina
if(isset($_REQUEST['LimparPerfil'])){
    session_start();

    $src = "Temp/" . $_SESSION['tmpFotoCadastroCaminho'];

    unlink($src);
}


