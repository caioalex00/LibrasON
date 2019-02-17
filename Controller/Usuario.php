<?php
/**
 * @project: LibrasON
 * @name: Usuario
 * @description: Classe que contém as funções relacionadas ao usuario
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos pesquisarID, verificarInscricaousuario
 */
class Usuario {
    
    /**
     * @Descrição: Pesquisa o ID de um usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $usuario armazena o nome de usuario para a pesquisa
     */
    public function pesquisarID($usuario){
        $Read = new Reader("Usuario", "idUsuario", "usuario", "$usuario");
        $Read->executarQuery();
        return $Read->getResultado()[0]->idUsuario;
    }
    
    /**
     * @Descrição: verefica a inscrição de um certo usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param string $idCurso o curso que iremos veridicar a inscricao
     * @param string $usuario armazena o nome de usuario para vereficar a inscrição dele
     */
    public function verificarInscricaoUsuario($idCurso, $usuario){
        $idUser = $this->pesquisarID($usuario);
        $Read = new Reader("Usuario_has_Curso", "*", "FK_idUsuario, FK_idCurso", "$idUser, $idCurso");
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            return true;
        }else{
            return false;
        }
    }
}
