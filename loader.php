<?php

/**
 * @project: librason
 * @name: loader 
 * @description: realiza o carregamento automatico de classes
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos CarregarClasse()
 */

//Iniciamos a sessão para que as funções de login e cadastro funcione
//Foi feita uma condição para evitar o erro de iniciar uma sessão 2 vezes
if(!isset($_SESSION)){
    session_start();
}

/**
* @Descrição: Armazena os valores necessarios na instanciação e executa o 
* metodo construct da Classe herdada Conexao
* @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
* @versao 2.0 - 08/02/2019
* @param string $classe armazena o nome da classe obtida no spl_autoload_register() para fazer o include dela
*/
function CarregarClasse($classe){
    //Variavel que contem nome das pastas onde contem classes
    $Pastas = ['Controller','Model','View'];
    
    //Por meio do foreach pecorremos as pastas, vereficando se nelas contem a classe passada
    //no parametro do metodo
    foreach ($Pastas as $Pasta) {
        $Caminho = __DIR__ . "/" . $Pasta . "/" . $classe . ".php";
        
        if (file_exists($Caminho) && !is_dir($Caminho)){
            include_once $Caminho;
            break;
        }
    }
}
//Essa função cgamara nossa função de loader quando uma classe for instanciada
//Passando como parametro o nome da classe
spl_autoload_register('CarregarClasse');
