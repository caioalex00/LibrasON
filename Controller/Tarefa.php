<?php
/**
 * @project: LibrasON
 * @name: Tarefa
 * @description: Classe que contém as funções da pagina de tarefas do AVA;
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos buscarInformacoes,imprimirquestoes, buscarquestoes, imprimirQuestaodd,
 * imprimirQuestaof, imprimirQuestaoLC, imprimirQuestaoA
 */
class Tarefa {
    /** @var int $IdTarefa armazena o ID da tarefa */
    public $idTarefa;
    /** @var int $idCurso armazena o ID do Curso */
    public $idCurso;
    /** @var int $idUsuario armazena o ID do usuario */
    public $idUsuario;
    
    /**
     * @Descrição: Construtor da Classe
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @param int $idCurso armazena o ID do curso a ser trabalhado
     * @param int $idUsuario armazena o id do usuario
     * @param int $idTarefa armazena o id da tarefa
     */
    public function __construct($idTarefa, $idCurso, $idUsuario) {
        $this->idTarefa = $idTarefa;
        $this->idCurso = $idCurso;
        $this->idUsuario = $idUsuario;
    }
    
    
    /**
     * @Descrição: Busca todos os dados da tarefa sendo trabalhada 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function buscarInformacoes(){
        $Read = new Reader("Tarefas", "*", "idTarefas", $this->idTarefa);
        $Read->executarQuery();
        return $Read->getResultado()[0];
    }
    
     /**
     * @Descrição: Imprime na tela todas a questoes relacionadas a tarefas no banco 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    public function imprimirquestoes(){
        $dados = $this->buscarquestoes();
        echo '<form id="form_tarefa">';
        $n = 1;
        foreach ($dados as $questao) {
            if($questao->Tipo == 1){
                $this->imprimirQuestaodd($questao, $n);
            } else if($questao->Tipo == 2){
                $this->imprimirQuestaof($questao, $n);
            } else if($questao->Tipo == 3){
                $this->imprimirQuestaoLC($questao, $n);
            } else if ($questao->Tipo == 4) {
                $this->imprimirQuestaoA($questao, $n);
            }
            
            $n++;
        }
        echo '</form>';
        echo '<form id="form_final" method="post" action="../verificarRespostas.php" >';
        for ($i = 1; $i < $n; $i++){
            echo '<input id="qFinal_'. $i .'" name="questao_'. $i .'" type="hidden" value="">';
        }
        echo '<button type="button" onclick="atualizarForm()" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom  btn-color-primeiro">Submeter respostas</button>';
        echo '</form>';
        $qtQ = $n - 1;
        echo "<script>qtdQ = $qtQ;</script>";
    }
    
    /**
     * @Descrição: Busca dados da questão no banco e retorna 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function buscarquestoes(){
        $Read = new Reader("QuestoesFechadas", "*", "FK_idTarefas", $this->idTarefa);
        $Read->executarQuery();
        return $Read->getResultado();
    }
    
    /**
     * @Descrição: Imprime na tela todas as alternativas de uma questão do tipo DROP DOWN 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function imprimirQuestaodd($questao, $n){
        echo '<div title="DropDown" id="questao_'. $n .'" class="questao">' . "<p>$questao->Questao</p>";
        $Read = new Reader("Alternativa", "*", "FK_idQuestoes", $questao->idQuestoesFechadas);
        $Read->executarQuery();
        $alternativas = $Read->getResultado();
        
        echo '<ul class="uk-grid-small uk-child-width-1-2 uk-child-width-1-5@s uk-text-center" uk-sortable="handle: .uk-card" uk-grid>';
        
        if(!empty($alternativas)){
            
            $valor = 1;
            
            foreach ($alternativas as $alt) {
                echo '<li> <div class="ddquestao uk-card uk-card-default uk-card-body"> <img alt="foto da alternativa" src="../Servidor/'. $alt->Texto .'"></div> <input name="dd" value="'. $valor .'" type="hidden"> </li>';
                $valor++;
            }
        } else {
            echo "Dados indisponiveis";
        }
        
        echo '</ul>';
        echo '</div>';
    }
    
    /**
     * @Descrição: Imprime na tela todas as alternativas de uma questão do tipo RADIO - FORMULARIO 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function imprimirQuestaof($questao, $n){
        $Read = new Reader("Alternativa", "*", "FK_idQuestoes", $questao->idQuestoesFechadas);
        $Read->executarQuery();
        $alternativas = $Read->getResultado();
        echo '<div title="Formulario" id="questao_'. $n .'" class="questao">' . "<p>$questao->Questao</p>";
        if(!empty($questao->Img)){
            echo '<center>';
            echo '<figure class="figureTarefa"><img alt="foto da alternativa" src="../Servidor/'. $questao->Img .'"></figure>';
            echo '</center>';
        }
        
        echo '<div style="margin-bottom: 0px" class="uk-margin">';
        echo '<div class="uk-form-controls">';
        if(!empty($alternativas)){
            
            $valor = 1;
            
            foreach ($alternativas as $alt) {
                echo '<label><input class="uk-radio" value="'. $alt->Texto .'" type="radio" name="radio'. $n .'">'. $alt->Texto .'</label><br>';
                $valor++;
            }
        } else {
            echo "Dados indisponiveis";
        }
        echo '</div></div>';
        echo '</div>';
    }
    
    /**
     * @Descrição: Imprime na tela todas as alternativas de uma questão do tipo LIGAÇÂO DE COLUNA 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function imprimirQuestaoLC($questao, $n){
        $Read = new Reader("Alternativa", "*", "FK_idQuestoes", $questao->idQuestoesFechadas);
        $Read->executarQuery();
        $alternativas = $Read->getResultado();
        
        echo '<div title="Coluna" id="questao_'. $n .'" class="questao">' . "<p>$questao->Questao</p>";
        echo '<div class="uk-grid-small uk-child-width-expand@s" uk-grid>';
        echo '<div>';
        echo '<h4>Palavra</h4>';
        if(!empty($alternativas)){
            foreach ($alternativas as $alt){
                echo '<div class="uk-margin"> <div class="questaoLC questaoLCT uk-card uk-card-default uk-card-body uk-card-small">'. $alt->Texto .'</div></div>';
            }
        } else {
            echo "Dados indisponiveis";
        }
        
        echo '</div><div uk-sortable="group: sortable-group"><h4>Sinal</h4>';
        
        if(!empty($alternativas)){
            $valor = 1;
            foreach ($alternativas as $alt){
                echo '<div class="uk-margin"> <div class="questaoLC uk-card uk-card-default uk-card-body uk-card-small"><img src="../Servidor/'. $alt->Img .'"></div> <input name="cl" value="'. $valor .'" type="hidden"></div>';
                $valor++;
            }
        }
        echo '</div></div></div>';
    }
    
    /**
     * @Descrição: Imprime na tela todas as alternativas de uma questão do tipo ABERTA 
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 10/02/2019
     * @parametros Sem parâmetros
     */
    private function imprimirQuestaoA($questao, $n){
        $Read = new Reader("Alternativa", "*", "FK_idQuestoes", $questao->idQuestoesFechadas);
        $Read->executarQuery();
        $alternativas = $Read->getResultado();
        
        echo '<div title="Aberta" id="questao_'. $n .'" class="questao">' . "<p>$questao->Questao</p>";
        if(!empty($questao->Img)){
            echo '<center>';
            echo '<figure class="figureTarefa"><img alt="foto da alternativa" src="../Servidor/'. $questao->Img .'"></figure>';
            echo '</center>';
        }
        echo '<div class="uk-margin"> <input class="questaoa uk-input" type="text" placeholder="Digite sua resposta!"> </div>';
        echo '</div>';
    }
}
