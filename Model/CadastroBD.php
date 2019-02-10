<?php
/**
 * @project: LibrasON
 * @name: Cadastro
 * @description: Classe que contém as funções armazenamento e leitura no banco de dados
 * para o cadastro de usuários
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos definirDados, inserirDados, vereficarUser, obterID, registrarFotoDePerfil
 */
class CadastroBD extends Conexao{
    
    /** @var string $usuario armazena o nome de usuário para registrar */
    private $usuario;
    /** @var string $nomeUsuario armazena o nome do usuário para registrar */
    private $nomeUsuario;
    /** @var string $sobrenomeUsuario armazena o sobrenome do usuário para registrar */
    private $sobrenomeUsuario;
    /** @var string $senhaUsuario armazena a senha do usuário para registrar */
    private $senhaUsuario;
    /** @var string $emailUsuario armazena o email do usuário para registrar */
    private $emailUsuario;
    
    /**
     * @Descrição: Armazena os valores necessarios para o cadastro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function definirDados($usuario, $nomeUsuario, $sobrenomeUsuario, $senhaUsuario, $emailUsuario) {
        $this->usuario = $usuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->sobrenomeUsuario = $sobrenomeUsuario;
        $this->senhaUsuario = $senhaUsuario;
        $this->emailUsuario = $emailUsuario;
    }

    /**
     * @Descrição: Faz a inserção de dados na base de dados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function inserirDados(){
        $nulo = 0;
        $conexao = $this->conectar();
        $sql = "INSERT INTO usuario VALUES(?,?,?,?,?,?,?);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam('1', $nulo, PDO::PARAM_INT);
        $stmt->bindParam('2', $this->usuario, PDO::PARAM_STR);
        $stmt->bindParam('3', $this->emailUsuario, PDO::PARAM_STR);
        $stmt->bindParam('4', $this->senhaUsuario, PDO::PARAM_STR);
        $stmt->bindParam('5', $this->nomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam('6', $this->sobrenomeUsuario, PDO::PARAM_STR);
        $stmt->bindParam('7', $nulo, PDO::PARAM_INT);
        $stmt->execute();
    }
       
    /**
     * @Descrição: realiza um selecão de dados a procura de um nome de usuario especifico
     * e retorna se verdadeiro se não houver algum resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function vereficarUser($usuario){
        $conexao = $this->conectar();
        $sql = "SELECT * FROM Usuario WHERE usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam('1', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $qtdValores = $stmt->rowCount();
        
        if($qtdValores != 0){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * @Descrição: Obtem o ID de um usuário especifico
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function obterID($usuario){
        $conexao = $this->conectar();
        $sql = "SELECT * FROM Usuario WHERE usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam('1', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        return $dados->idUsuario;
    }
    
    /**
     * @Descrição: Insere os dados da foto de perfil no banco de dados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function registrarFotoDePerfil($idUsuario, $foto){
        $nulo = 0;
        $conexao = $this->conectar();
        $sql = "INSERT INTO perfil VALUES(?,?,?);";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam('1', $nulo, PDO::PARAM_INT);
        $stmt->bindParam('2', $foto);
        $stmt->bindParam('3', $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
    }
}