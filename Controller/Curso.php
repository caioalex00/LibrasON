<?php
/**
 * @project: LibrasON
 * @name: Curso
 * @description: Classe que contém metodos relacionadas a tabela de cursos, Inscrições e 
 * validação de inscrições
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos exibirLabels, botaoIncricaoTipo, inscreverCurso, vereficarCodigoDeInscricao, 
 * verificarDisponiblidadeInscricao, vereficarTipoCurso, vereficarInscriçãoNoCurso, 
 * retornarRegulamento, retornarCertificacao, exibirCursos
 */
class Curso {
    /** @var int $idCurso armazena o codigo de identificação do curso */
    private $idCurso;
    /** @var string $usuario armazena o nome de usuário que está trabalhando com esta classe */
    private $usuario;
    
    /**
     * @Descrição: Contrutor da classe, que exige o id do curso a ser trabalhado e o usuario
     * que está fazendo essas solicitações
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param int $idCurso armazena o id so curso sendo trabalhado
     * @param string $usuario armazena o nome do usuario
     */
    public function __construct($idCurso, $usuario) {
        $this->idCurso = $idCurso;
        $this->usuario = $usuario;
    }

    /**
     * @Descrição: Metodo responsavel por imprimir labels com informações básicas
     * do curso na View
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param int $idCurso armazena o id do curso que tem informações solicitadas
     * @param int $inscricoes armazena o numero de vagas total do curso
     * @param int $tipo armazena o tipo do curso
     */
    private function exibirLabels($idCurso, $inscricoes, $tipo){
        $Read = new Reader("verificarVagas", $idCurso, null, null);
        $qtdIncritos = $Read->chamarFuncao();
        $qtdRestante = $inscricoes - $qtdIncritos;
        
        if($tipo == 1){
            echo '<span class="uk-label uk-label-defaut" style="margin-right:5px">Online</span>';
        }else if($tipo == 2){
            echo '<span class="uk-label uk-label-defaut" style="margin-right:5px">Presencial</span>';
        }
        
        if($qtdRestante <= 0){
            echo '<span class="uk-label uk-label-defaut" style="margin-right:5px">Inscrições Fechadas</span>';
            echo '<span class="uk-label uk-label-defaut" style="margin-right:5px">Inscrições Restantes: 0</span>';
        }else{
            echo '<span class="uk-label uk-label-defaut"  style="margin-right:5px">Inscrições Abertas</span>';
            echo '<span class="uk-label uk-label-defaut"  style="margin-right:5px">Inscrições Restantes: '. $qtdRestante .'</span>';
        }
    }
    
    /**
     * @Descrição: Esse metodo analisa o tipo do curso e imprimi
     * o nome do metodo em JavaScript responsavel por chamar o
     * Modal de Inscrição com o ID do curso desejado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param string int armazena o tipo do curso
     * @param string int armazena o o id do Curso
     */
    private function botaoIncricaoTipo($tipo, $idCurso){
        if($tipo == 1){
            return "modalInscricaoOnline($idCurso)";
        }else if($tipo == 2){
            return "modalInscricaoPresencial($idCurso)";
        }
    }
    
    /**
     * @Descrição: Esse metodo faz contato com a Model para inscrever
     * o usuário no curso solicitado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function inscreverCurso(){
        $User = new Usuario();
        $idUsuario = $User->pesquisarID($this->usuario);
        $valores = $idUsuario . "|\|R" . $this->idCurso;
        
        $Create = new Create("Usuario_has_Curso", "`FK_idUsuario`, `FK_idCurso`", $valores);
        $Create->executarQuery();
        
        return $User->verificarInscricaoUsuario($this->idCurso, $this->usuario);
    }
    
    /**
     * @Descrição: Esse metodo verifica se o codigo de inscrição
     * para certos tipos de curso está correto
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param int $codigo codigo de inscrção oferecido pelo usuario
     */
    public function vereficarCodigoDeInscricao($codigo){
        $valores = $codigo . "," . $this->idCurso;
        $Read = new Reader("Codigo_Geral_Inscricao", "*", "Codigo,FK_idCurso", $valores);
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            return true;
        }else{
            return false;
        }
    }
    
    /**
     * @Descrição: Esse metodo verifica se o curso dispoe de vagas
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function verificarDisponiblidadeInscricao(){
        $Read = new Reader("verificarVagas", $this->idCurso, null, null);
        $qtdIncritos = $Read->chamarFuncao();
        
        $Read2 = new Reader("Curso", "*", "idCurso", $this->idCurso);
        $Read2->executarQuery();
        $Inscricoes =  $Read2->getResultado()[0]->Inscricoes;
        
        $qtdRestante = $Inscricoes - $qtdIncritos;
        
        if($qtdRestante <=0){
            return false;
        }else{
            return true;
        }

    }
    
    /**
     * @Descrição: Esse metodo retorna o tipodo curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function vereficarTipoCurso(){
        $Read = new Reader("Curso", "Tipo", "idCurso", $this->idCurso);
        $Read->executarQuery();
        return $Read->getResultado()[0]->Tipo;
    }
    
    /**
     * @Descrição: Retorna se o usuário já está incrito no curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function vereficarInscriçãoNoCurso(){
        $User = new Usuario();
        $idUsuario = $User->pesquisarID($this->usuario);
        $valores = $idUsuario . "," . $this->idCurso;
        
        $Read = new Reader("Usuario_has_Curso", "*", "FK_idUsuario, FK_idCurso", $valores);
        $Read->executarQuery();
        if($Read->getnumLinhas() == 1){
            return false;
        }else{
            return true;
        }
    }
    
    /**
     * @Descrição: Retorna regulamento do curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param string $idCurso curso que o usuario deseja o regulamento
     */
    public function retornarRegulamento($idCurso){
        $Read = new Reader("Informacoes", "Regulamento", "FK_idCurso", $idCurso);
        $Read->executarQuery();
        return $Read->getResultado()[0]->Regulamento;
    }
    
    /**
     * @Descrição: Retorna esclarecimentos sobre o certificado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @param string $idCurso curso que o usuario deseja as informações referentes a certificado
     */
    public function retornarCertificacao($idCurso){
        $Read = new Reader("Informacoes", "Certificacao", "FK_idCurso", $idCurso);
        $Read->executarQuery();
        return $Read->getResultado()[0]->Certificacao;
    }
    
    /**
     * @Descrição: Exibi Cursos cadastrados na Plataforma
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function exibirCursos(){
        $Read2 = new Reader("Curso", "*", null, null);
        $Read2->executarQuery();
        $Cursos = $Read2->getResultado();
        
        foreach ($Cursos as $dado){
            ?>
            <div class="Cards-Funcoes" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-card-hover bordaPersonalizada">
                    <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC1.png" alt="" width="30"> <span style="margin-right: 10px;"><?php echo $dado->Nome  ?></span><?php $this->exibirLabels($dado->idCurso, $dado->Inscricoes, $dado->Tipo) ?></h3>
                  <p><?php echo $dado->Descricao?></p>
                  <p uk-margin>
                    <button onclick="<?php echo $this->botaoIncricaoTipo($dado->Tipo, $dado->idCurso) ?>" class="uk-button uk-button-default uk-button-small">Se inscrever no Curso</button>
                    <button uk-toggle="target: #InformacoesModal" type="button" class="uk-button uk-button-primary uk-button-small btn-color-primeiro">Informações em Falta?</button>
                    <button onclick="exibirCertificadoR(<?php echo $dado->idCurso ?>)" class="uk-button uk-button-secondary uk-button-small btn-color-secundario">Esse curso oferece certificado?</button>
                    <button onclick="exibirRegulamento(<?php echo $dado->idCurso ?>)" class="uk-button uk-button-secondary uk-button-small ">Regulamento dos Cursos</button>
                  </p>
                </div>
              </div>
            </div>
            <?php
        }
    }
    
    /**
     * @Descrição: Exibe os cursos que um determinado usuário está cadastrado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     * @parametros Sem parâmetros
     */
    public function exibirCursosCadastrados(){
        $User = new Usuario();
        $IDUsuario = $User->pesquisarID($this->usuario);
        
        $Read = new Reader("Usuario_has_Curso", "FK_idCurso", "FK_idUsuario", $IDUsuario);
        $Read->executarQuery();
        $IdCursos = $Read->getResultado();
        
        if(empty($IdCursos)){
            echo '<p>Você não possui cursos cadastrados na sua conta, por favor entre na página de <a href="Cursos.php">Cursos da plaforma</a> e se inscreva nos cursos disponiveís</p>';
            echo '<p>Caso tenha se inscrevido e não seu curso não está sendo exposto aqui, por favor contate a administração da plaforma pelo menu do usuário (Dando um click no seu nome na barra de menu)</p>';
        }else{
            foreach ($IdCursos as $value){
                $Read2 = new Reader("Curso", "*", "idCurso", $value->FK_idCurso);
                $Read2->executarQuery();
                $Curso = $Read2->getResultado()[0];
                ?>
                <div class="uk-child-width-expand@s Cards-Funcoes" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-body uk-card-hover bordaPersonalizada">
                      <h3 class="uk-card-title CorTituloCard"><img src="img/Icones/IC1.png" alt="" width="30"> <?php echo $Curso->Nome ?></h3>
                      <p><?php echo $Curso->Descricao ?></p>
                      <p uk-margin>
                        <form action="PainelUsuarioCurso.php" method="get">
                            <button name="ID" value="<?php echo $Curso->idCurso ?>" type="submit" class="uk-button uk-button-primary uk-button-small btn-color-primeiro">Entrar no curso</button>
                        </form>
                      </p>
                    </div>
                  </div>
                </div>
                <?php
            }
        }
    }
    
}