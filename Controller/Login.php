<?php
/**
 * @project: LibrasON
 * @name: Login
 * @description: Classe que contém as funções de cadastro da plataforma
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos inserirDados, vereficarExistencia, autenticar, iniciarSessao
 */
class Login {
    
    /** @var string $usuario armazena o nome de usuario pego no formulario de Login */
    private $usuario;
    /** @var string $senha armazena a senha pega no formulario de Login */
    private $senha;
    /** @var string $nome aramazena o nome do usuário */
    private $nome;
    /** @var string $tabela armazena o sobrenome do usuário */
    private $sobrenome;
    
    /**
     * @Descrição: coleta os dados de login e instancia a conexaõ com a Model com esses dados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $usuario armazena o nome de usuario para Login
     * @param string $senha armazena a senha do suauário para Login
     */
    public function inserirDados($usuario, $senha){
        $this->usuario = $usuario;
        $this->senha = sha1($senha);
    }
    
    /**
     * @Descrição: retorna se o usuario existe
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function vereficarExistencia(){
        $Read = new Reader("Usuario", "*", "Usuario", "$this->usuario");
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: retorna se a senha está correta
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function autenticar(){
        $Read = new Reader("Usuario", "*", "Usuario,Senha", $this->usuario . "," . $this->senha);
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            $Resultado = $Read->getResultado();
            $this->nome  = $Resultado[0]->Nome;
            $this->sobrenome  = $Resultado[0]->Sobrenome;
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: Inicia a SESSION do PHP para finalizar o Login
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function iniciarSessao(){
        $_SESSION['logado'] = true;
        $_SESSION['nome'] = $this->nome;
        $_SESSION['sobrenome'] = $this->sobrenome;
        $_SESSION['usuario'] = $this->usuario;
    }
    
    /**
     * @Descrição: Carrega foto do usuário logado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $usuario armazena o nome do usuario que deseja a foto de perfil
     */
    public static function carregarFoto($usuario){
        $Read = new Reader("Usuario", "*", "Usuario", $usuario);
        $Read->executarQuery();
        $ID = $Read->getResultado()[0]->idUsuario;
        
        $Read2 = new Reader("Perfil", "*", "FK_idUsuario", $ID);
        $Read2->executarQuery();
        return $Read2->getResultado()[0]->Foto;
    }
}
