<?php
/**
 * @project: LibrasON
 * @name: LoginBD
 * @description: Classe que contém as funções de login, mas so para realizar  contato em função Model
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos pesquisarUsuario, vereficarSenha, imprimirFoto, setSenhaFornecida, setUsuarioFornecido
 */
class LoginBD extends Conexao{
    
    /** @var string $usuarioFornecido guarda usuário fornecido pelo usuário */
    private $usuarioFornecido;
    /** @var string $senhaFornecida guarda senha fornecida pelo usuário */
    private $senhaFornecida;
    /** @var string $senhaBase guarda senha emitida da base */
    private $senhaBase;
    /** @var string $usuarioBase guarda usuario emitido da base */
    public $usuarioBase;
    /** @var string $nomeBase guarda nome do usuário emitido da base */
    public $nomeBase;
    /** @var string $sobrenomeBase guarda sobrenome do usuário emitido da base */
    public $sobrenomeBase;

    /**
     * @Descrição: pesquisa usuário na base
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function pesquisarUsuario(){
        $conexao = $this->conectar();
        $sql = "SELECT * FROM Usuario WHERE usuario = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bindParam('1', $this->usuarioFornecido, PDO::PARAM_STR);
        $stmt->execute();
        $qtdValores = $stmt->rowCount();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        
        if($qtdValores != 0){
            $this->senhaBase = $dados->Senha;
            $this->usuarioBase = $dados->Usuario;
            $this->nomeBase = $dados->Nome;
            $this->sobrenomeBase = $dados->Sobrenome;
            return true;
        }else{
            return false;
        }
    }
    
    public function vereficarSenha(){
        if($this->senhaFornecida == $this->senhaBase){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: imprimi codigo de foto do usuário solicitado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public static function imprimirFoto($usuario){
        $conexao = new Conexao();
        $stmt = $conexao->conectar()->prepare("SELECT * FROM usuario u INNER JOIN Perfil p on p.FK_idUsuario = u.idUsuario WHERE Usuario = ?");
        $stmt->bindParam('1', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        return $dados->Foto;
    }

    /**
     * @Descrição: coleta a senha fornecida pelo usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function setSenhaFornecida($senhaFornecida) {
        $this->senhaFornecida = sha1($senhaFornecida);
    }
    
    /**
     * @Descrição: coleta o usuário fornecido pelo usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     */
    public function setUsuarioFornecido($usuarioFornecido) {
        $this->usuarioFornecido = $usuarioFornecido;
    }


}
