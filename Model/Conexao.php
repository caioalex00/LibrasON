<?php

/**
 * @project: LibrasON
 * @name: Conexao 
 * @description: Classe que realiza conexao com o banco de dados.
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos definirValores(), conectar() 
 */
class Conexao {
    
    /** @var string $host variavel responsavel por armazenar o host utilizado pelo banco */
    private $host;
    
    /** @var string $dbname variavel que armazena o nome da database */
    private $dbname;
    
    /** @var string $usuario armazena user para autenticação no banco */
    private $usuario;
    
    /** @var string $senha armazena senha para autenticação no banco */
    private $senha;
    
    /** @var string $tipo responsavel por armazenar o driver a ser especificado no PDO */
    private $tipo;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação pelo metodo definirValores() 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros sem parâmetros
     */
    public function __construct() {
        $this->definirValores();
    }
    
    /**
     * @Descrição: Armazena os valores a serem utilizados para a conexao nos atributos da classe
     * @copyright
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    private function definirValores(){
        $this->host = "localhost";
        $this->dbname = "librason";
        $this->usuario = "root";
        $this->senha = "";
        $this->tipo = "mysql";
    }

    /**
     * @Descrição: Realiza a conexao com o banco de dados
     * @copyright
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    protected function conectar(){
        
        try {
            //Aqui instaciamos a classe PDO que realizara a conexão com o banco de dados
            $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);
            $this->conexao = new PDO($this->tipo . ':host=' . $this->host . ';dbname=' . $this->dbname, $this->usuario, $this->senha,$options);
            
        } catch (Exception $ex) {
            //Caso haja algum erro na conexao, o erro será imprimido na tela
            echo 'Erro na conexão: ' . $ex->getMessage();
        }
        
        //Retorna a conexao
        return $this->conexao;
    }

}
