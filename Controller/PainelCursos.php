<?php
/**
 * @project: LibrasON
 * @name: PainelCursos
 * @description: Classe que contém as funções da pagina Meus Cursos
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos verificarPermissao, retornarInfCurso, exibirPropostas, retornarPropostasCurso
 * processarTipoProposta, formatarData, setIdUsuario
 */
class PainelCursos {
    /** @var int $usuario armazena o ID do Curso */
    private $idCurso;
    /** @var int $iDusuario armazena o ID do usuario */
    private $idUsuario;
    
    /**
     * @Descrição: Construtor da Classe
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param int $idCurso armazena o ID do curso a ser trabalhado
     * @param String $usuario armazena o nome de usuario
     */
    public function __construct($idCurso, $usuario) {
        $this->idCurso = $idCurso;
        $this->setIdUsuario($usuario);
    }
    
    /**
     * @Descrição: exibi as proposta na tabela
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function exibirPropostas(){
        print_r($this->retornarPropostasCurso());
    }
    
    /**
     * @Descrição: verifica a permissão de acesso ao curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function verificarPermissao(){
        $condicao = $this->idUsuario . "," . $this->idCurso;
        $read = new Reader("Usuario_has_Curso", "*", "FK_idUsuario, FK_idCurso", $condicao);
        $read->executarQuery();
        
        if($read->getnumLinhas() == 1){
            return true;
        }else{
            return false;
        }
    }
    
        /**
     * @Descrição: retorna as informações do curso sendo trabalhado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function retornarInfCurso(){
        $read = new Reader("Curso", "*", "idCurso", $this->idCurso);
        $read->executarQuery();
        return $read->getResultado()[0];
    }
    
    /**
     * @Descrição: retorna para a tabela do curso as proposta pertecentes a ele
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function retornarPropostasCurso(){
        $read = new Reader("Propostas", "*", "idCurso", $this->idCurso);
        $read->executarQuery();
        $dados = $read->getResultado();
        
        foreach ($dados as $proposta){
            $conc = $this->verificarConclusao($proposta->Proposta, $proposta->idProposta);
            $link = $this->processarTipoProposta($proposta->Proposta) . ".php?idCurso=" . $proposta->idCurso . "&idProposta=" . $proposta->idProposta;
            echo "<tr>";
            echo '<td><img src="img/Icones/ICOC_' . $this->processarTipoProposta($proposta->Proposta) . '.png"> <span style="color: #3269c4">' . $proposta->Proposta . '</span></td>';
            echo "<td>$proposta->Descricao</td>";
            echo "<td>$conc</td>";
            echo '<td><a href="' . $link .'">Acessar</td>';
            echo "</tr>";
        }
    }
    
    /**
     * @Descrição: retorna se o usuario completo aquela proposta do curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param int $proposta armazena o tipo da proposta
     * @param String $idProposta o id da proposta
     */
    private function verificarConclusao($proposta, $idProposta){
        $tipo = $this->processarTipoProposta($proposta);
        $tabela = "Usuario_has_" . $tipo;
        $where  = "FK_id" . $tipo . "," . "FK_idUsuario";
        $condicao = $idProposta . "," . $this->idUsuario;
        $Read = new Reader($tabela, "*", $where, $condicao);
        $Read->executarQuery();
        
        if($Read->getnumLinhas() == 1){
            return '<span style="color: #01b400">Sim</span>';
        }else{
            return '<span style="color: #db0100">Não</span>';
        }
        
    }
    
    /**
     * @Descrição: verifica o tipo da proposta
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function processarTipoProposta($proposta){
        $verificao = explode(" ", $proposta);
        
        if($verificao[0] == "Vídeo"){
            return "Video";
        }else if($verificao[0] == "Tarefa"){
            return "Tarefas";
        }else if($verificao[0] == "Documentação"){
            return "Documentacao";
        }
    }
    
        /**
     * @Descrição: formata a data pro formato brasileiro pego do banco
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function formatarData($dataHora){
        $dataHoraArray = explode(" ", $dataHora);
        $data = $dataHoraArray[0];
        $dataArray = explode("-", $data);
        $dataArrayReverse = array_reverse($dataArray);
        $dataBR = implode("/", $dataArrayReverse);
        return $dataBR;
    }
    
        /**
     * @Descrição: setter do ID do usuario
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function setIdUsuario($usuario) {
        $Usuario = new Usuario();
        $this->idUsuario = $Usuario->pesquisarID($usuario);
    }
}
