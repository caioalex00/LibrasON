<?php
/**
 * @project: LibrasON
 * @name: Sair
 * @description: Execulta o Logout do sistema por meio de excluir dados da SESSION
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 */

require_once 'loader.php';

unset($_SESSION['logado']);
unset($_SESSION['nome']);
unset($_SESSION['sobrenome']);
unset($_SESSION['usuario']);

echo "<script>window.location.href = 'View/Inicio.php?logout'</script>";