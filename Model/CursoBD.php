<?php
/**
 * @project: LibrasON
 * @name: CursoBD
 * @description: Classe que trabalha com o banco de dados realacionado a busca de dados
 * dos cursos na plataforma
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
 * @métodos realizarProcura, buscarIDUsuario, encontrarCursos, inscreverCurso, buscarInscricao, 
 * verificarCodigoDeInscricao, buscarCursoID, retornarDados, retornaQtdIncritos, buscarRegulamento, 
 * buscarCertificadoInf
 */
class CursoBD extends Conexao{
    /** @var string $cursos armazena dados de um curso retornado de alguns metodos */
    public $cursos;
            
    /**
     * @Descrição: Realiza uma busca de todos os cursos cadastrados na plataforma
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    private function realizarProcura(){
        $sql = "SELECT * FROM Curso ORDER BY idCurso DESC";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->execute();
        $this->numeroCursos = $stmt->rowCount();
        $this->cursos = $stmt;
    }
    
    /**
     * @Descrição: Faz uma busca do ID de um usuário pelo nome de usuário
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    private function buscarIDUsuario($usuario){
        $sql = "SELECT idUsuario FROM usuario WHERE Usuario = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $usuario, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        return $dados->idUsuario;
    }
    
    /**
     * @Descrição: retorna dados de uma procura de curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function encontrarCursos(){
        return $this->realizarProcura();
    }
    
    /**
     * @Descrição: Inscreve usuario em um determinado curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function inscreverCurso($idCurso, $usuario){
        $idUsuario = $this->buscarIDUsuario($usuario);
        $nulo = 0;
        $sql = "INSERT INTO Usuario_has_Curso VALUES(?,?,?)";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $nulo, PDO::PARAM_INT);
        $stmt->bindParam(2, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(3, $idCurso, PDO::PARAM_INT);
        $stmt->execute();
        
        return !$this->buscarInscricao($usuario, $idCurso);
    }
    
    /**
     * @Descrição: Faz uma busca no banco verificando se o usuário possui inscrição em algum curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function buscarInscricao($usuario, $idCurso){
        $idUsuario = $this->buscarIDUsuario($usuario);
        $sql = "SELECT * FROM Usuario_has_Curso WHERE FK_idUsuario = ? AND FK_idCurso = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->bindParam(2, $idCurso, PDO::PARAM_STR);
        $stmt->execute();
        $numeroResultados = $stmt->rowCount();
        
        if($numeroResultados <= 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: verifica se existe o codigo de inscrição inserido
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function verificarCodigoDeInscricao($idCurso, $codigo){
        $sql = "SELECT * FROM Codigo_Geral_Inscricao WHERE Codigo = ? AND FK_idCurso = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $codigo, PDO::PARAM_INT);
        $stmt->bindParam(2, $idCurso, PDO::PARAM_STR);
        $stmt->execute();
        $numeroResultados = $stmt->rowCount();
        
        if($numeroResultados > 0){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: Contrutor da classe, que exige o id do curso a ser trabalhado e o usuario
     * que está fazendo essas solicitações
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function buscarCursoID($cursoID){
        $sql = "SELECT * FROM Curso WHERE idCurso = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $cursoID, PDO::PARAM_INT);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $dado;
    }
    
    /**
     * @Descrição: Contrutor da classe, que exige o id do curso a ser trabalhado e o usuario
     * que está fazendo essas solicitações
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function retornarDados(){
        return $this->cursos->fetch(PDO::FETCH_OBJ);
    }
    
    /**
     * @Descrição: Retorna quantidades de inscritos no curso solicitado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function retornaQtdIncritos($idCurso){
        $sql = "SELECT verificarVagas($idCurso) as 'qtdIncritos'";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->execute();
        $dado = $stmt->fetch(PDO::FETCH_OBJ);
        return $dado->qtdIncritos;
    }
    
    /**
     * @Descrição: Busca o regulamento de um determinado curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function buscarRegulamento($idCurso){
        $sql = "SELECT Regulamento FROM Informacoes WHERE FK_idCurso = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $idCurso, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        return $dados->Regulamento;
    }
    
    /**
     * @Descrição: Busca o certificado de um determinado Curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function buscarCertificadoInf($idCurso){
        $sql = "SELECT Certificacao FROM Informacoes WHERE FK_idCurso = ?";
        $stmt = $this->conectar()->prepare($sql);
        $stmt->bindParam(1, $idCurso, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(PDO::FETCH_OBJ);
        return $dados->Certificacao;
    }
    
}
