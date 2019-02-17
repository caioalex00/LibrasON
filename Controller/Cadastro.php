<?php
/**
 * @project: LibrasON
 * @name: Cadastro
 * @description: Classe que contém as funções de cadastro da plataforma
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0 - 10/02/2019
 * @métodos definirDados, definirFoto, validarDados, realizarRegistro, vereficarCadastroRealizado, 
 * verificarCompatibilidadeDeSenhas, criptografarSenha, verificarFormatacao, formatarNomeUsuario, 
 * verificarDisponiblidadeUsuario, registrarPerfil
 */
class Cadastro {
    /** @var string $usuario armazena o nome de usuário a ser registrado */
    private $usuario;
    /** @var string $nomeUsuario armazena nome do usuário a ser registrado */
    private $nomeUsuario;
    /** @var string $sobrenomeUsuario armazena o sobrenome do usuário a ser registrado */
    private $sobrenomeUsuario;
    /** @var string $senhaUsuario armazena a senha do usuário a ser registrado */
    private $senhaUsuario;
    /** @var string $senhaRevisaoUsuario armazena a senha digitada de novo para validação */
    private $senhaRevisaoUsuario;
    /** @var string $emailUsuario armazena email do usuário a ser registrado */
    private $emailUsuario;
    /** @var string $senhaFinalUsuario armazena a senha do usuário cripografada */
    private $senhaFinalUsuario;
    /** @var string $foto variavel armazena a foto de perfil do usuário */
    private $foto;
    /** @var string $x variavel armazena dados de recorte da foto */
    private $x;
    /** @var float $y variavel armazena dados de recorte da foto */
    private $y;
    /** @var float $w variavel armazena dados de recorte da foto */
    private $w;
    /** @var float $h variavel armazena dados de recorte da foto */
    private $h;
    /** @var float $erro variavel que armazena erro de validação caso haja */
    public $erro;
    
    /**
     * @Descrição: Armazena os valores necessarios para o cadastro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $usuario armazena o nome de usuario a ser registrado
     * @param string $nomeUsuario armazena o nome do usuario a ser registrado
     * @param string $sobrenomeUsuario armazena o sobrenome do usuario a ser registrado
     * @param string $senhaUsuario armazena a senha do usuario a ser registrado
     * @param string $senhaRevisaoUsuario armazena a senha de revisão do usuário a ser registrado
     * @param string $emailUsuario armazena o email do usuário a ser registrado
     */
    public function definirDados($usuario, $nomeUsuario, $sobrenomeUsuario, $senhaUsuario, $senhaRevisaoUsuario, $emailUsuario) {
        $this->usuario = $usuario;
        $this->nomeUsuario = $nomeUsuario;
        $this->sobrenomeUsuario = $sobrenomeUsuario;
        $this->senhaUsuario = $senhaUsuario;
        $this->senhaRevisaoUsuario = $senhaRevisaoUsuario;
        $this->emailUsuario = $emailUsuario;
    }
    
    /**
     * @Descrição: Armazena os valores necessarios para o recorte e upload da foto para o banco
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $foto armazena a foto de perfil enviada pelo usuário
     * @param string $x armazena o eixo x do recorte de foto
     * @param string $y armazena o eixo y do recorte de foto
     * @param string $w armazena a lagura do recorte de foto
     * @param string $h armazena a altura do recorte de foto
     */
    public function definirFoto($foto, $x, $y, $w, $h) {
        $this->foto = $foto;
        $this->x = $x;
        $this->y = $y;
        $this->w = $w;
        $this->h = $h;
    }
    
    /**
     * @Descrição: valida dados inserido pelo usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function validarDados(){
        if(empty($this->usuario) || empty($this->nomeUsuario) || empty($this->sobrenomeUsuario) || empty($this->senhaUsuario) || empty($this->emailUsuario)){
            return false;
        }else if(!$this->verificarCompatibilidadeDeSenhas()){
            $this->erro = "ERROCADASTRO=1";
            return false;
        }else if(!$this->verificarFormatacao()){
            $this->erro = "ERROCADASTRO=2";
            return false;
        }else if(!$this->verificarDisponiblidadeUsuario()){
            $this->erro = "ERROCADASTRO=3";
            return false;
        }else if(strlen($this->senhaUsuario) < 8){
            $this->erro = "ERROCADASTRO=4";
            return false;
        }else{
            $this->criptografarSenha();
            $this->formatarNomeUsuario();
            return true;
        }
    }
    
    /**
     * @Descrição: Realiza registro de usuário fazendo contato com a Model
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function realizarRegistro(){
        $colunas = "`idUsuario`, `Usuario`, `Email`, `Senha`, `Nome`, `Sobrenome`, `DataNascimento`";
        $valores = "0|\|R" . $this->usuario . "|\|R" . $this->emailUsuario . "|\|R" . $this->senhaFinalUsuario . "|\|R" . $this->nomeUsuario . "|\|R" . $this->sobrenomeUsuario . "|\|R0";
        $Create = new Create("Usuario", $colunas, $valores);
        $Create->executarQuery();
        $this->registrarPerfil();
    }
    
    /**
     * @Descrição: Verefica se o o resgistro do usuário foi feito por meio de uma checagem
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function vereficarCadastroRealizado(){
        
        $Read = new Reader("Usuario", "*", "Usuario", "$this->usuario");
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: Verefica se as senhas inseridas pelo usuário são compativeis
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function verificarCompatibilidadeDeSenhas(){
        if($this->senhaUsuario == $this->senhaRevisaoUsuario){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: Faz uma criptografia da senha usando o hash sha1
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function criptografarSenha(){
        $this->senhaFinalUsuario = sha1($this->senhaUsuario);
    }
    
    /**
     * @Descrição: verefica se o nome de usuário contém espaços
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function verificarFormatacao(){
         if( preg_match('/\s/', $this->usuario)){
                return false;
            }else{
                return true;
            }
    }
    
    /**
     * @Descrição: Armazena novamente o nome de usuário, so que em letras minusculas
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function formatarNomeUsuario(){
        $this->usuario = strtolower($this->usuario);
    }
    
    /**
     * @Descrição: Verifica se há um nome de usuario correpodente na base de dados
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function verificarDisponiblidadeUsuario(){
        
        $Read = new Reader("Usuario", "*", "Usuario", "$this->usuario");
        $Read->executarQuery();
        if($Read->getnumLinhas() == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @Descrição: Realiza o recorte da foto e faz upload da mesma na base de dados pelo
     * contado com a Model
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function registrarPerfil(){
        
        $x = $this->x;
        $y = $this->y;
        $w = $this->w;
        $h = $this->h;
        
        $targ_w = $targ_h = 200;
	$jpeg_quality = 90;
	$src = "Temp/" . $this-> foto;
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
	$targ_w,$targ_h,$w,$h);
        
        ob_start();
	imagejpeg($dst_r,null,$jpeg_quality);
        $conteudoF = ob_get_contents();
        ob_end_clean();
        
        unlink($src);
        
        $Read = new Reader("Usuario","idUsuario","Usuario","$this->usuario");
        $Read->executarQuery();
        $idUsuario = $Read->getResultado()[0]->idUsuario;
        
        $Colunas = "`idPerfil`,`Foto`,`FK_idUsuario`";
        $Valores = "0|\|R" . $conteudoF . "|\|R" . $idUsuario;
        $Create = new Create("Perfil", $Colunas, $Valores);
        $Create->executarQuery();
    }

}