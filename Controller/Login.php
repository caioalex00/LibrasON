<?php
/**
 * @project: LibrasON
 * @name: Login
 * @description: Classe que contém as funções de cadastro da plataforma
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos inserirDados, vereficarExistencia, autenticar, iniciarSessao
 */
class Login {
    
    /** @var object $loginBD guarda objeto responsavel por conexao com a Model */
    private $loginBD;
    
    /**
     * @Descrição: coleta os dados de login e instancia a conexaõ com a Model com esses dados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function inserirDados($usuario, $senha){
        $loginBD = new LoginBD();
        $loginBD->setUsuarioFornecido($usuario);
        $loginBD->setSenhaFornecida($senha);
        $this->loginBD = $loginBD;
    }
    
    /**
     * @Descrição: retorna se o usuario existe
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function vereficarExistencia(){
        return $this->loginBD->pesquisarUsuario();
    }
    
    /**
     * @Descrição: retorna se a senha está correta
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function autenticar(){
        return $this->loginBD->vereficarSenha();
    }
    
    /**
     * @Descrição: Inicia a SESSION do PHP para finalizar o Login
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function iniciarSessao(){
        $_SESSION['logado'] = true;
        $_SESSION['nome'] = $this->loginBD->nomeBase;
        $_SESSION['sobrenome'] = $this->loginBD->sobrenomeBase;
        $_SESSION['usuario'] = $this->loginBD->usuarioBase;
    }
    
    /**
     * @Descrição: Carrega foto do usuário logado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public static function carregarFoto($usuario){
        return LoginBD::imprimirFoto($usuario);
    }
}
