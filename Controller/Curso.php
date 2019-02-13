<?php
/**
 * @project: LibrasON
 * @name: Curso
 * @description: Classe que contém metodos relacionadas a tabela de cursos, Inscrições e 
 * validação de inscrições
 * @copyright (c) 10/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0
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
     */
    private function exibirLabels($idCurso, $Inscricoes, $tipo){
        $verificar = new CursoBD();
        $qtdIncritos = $verificar->retornaQtdIncritos($idCurso);
        $qtdRestante = $Inscricoes - $qtdIncritos;
        
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
     */
    public function inscreverCurso(){
        $CursoBD = new CursoBD();
        return $CursoBD->inscreverCurso($this->idCurso, $this->usuario);
    }
    
    /**
     * @Descrição: Esse metodo verifica se o codigo de inscrição
     * para certos tipos de curso está correto
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function vereficarCodigoDeInscricao($codigo){
        $CursoBD = new CursoBD();
        return $CursoBD->verificarCodigoDeInscricao($this->idCurso, $codigo);
    }
    
    /**
     * @Descrição: Esse metodo verifica se o curso dispoe de vagas
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function verificarDisponiblidadeInscricao(){
        $verificar = new CursoBD();
        $qtdIncritos = $verificar->retornaQtdIncritos($this->idCurso);
        
        $cursoBD = new CursoBD();
        $curso = $cursoBD->buscarCursoID($this->idCurso);
        $Inscricoes = $curso['Inscricoes'];
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
     */
    public function vereficarTipoCurso(){
        $cursoBD = new CursoBD();
        $curso = $cursoBD->buscarCursoID($this->idCurso);
        return $curso['Tipo'];
    }
    
    /**
     * @Descrição: Retorna se o usuário já está incrito no curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function vereficarInscriçãoNoCurso(){
        $cursoBD = new CursoBD;
        return $cursoBD->buscarInscricao($this->usuario, $this->idCurso);
    }
    
    /**
     * @Descrição: Retorna regulamento do curso
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function retornarRegulamento($idCurso){
        $regulamento = new CursoBD();
        return $regulamento->buscarRegulamento($idCurso);
    }
    
    /**
     * @Descrição: Retorna esclarecimentos sobre o certificado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function retornarCertificacao($idCurso){
        $certificacao = new CursoBD();
        return $certificacao->buscarCertificadoInf($idCurso);
    }
    
    /**
     * @Descrição: Exibi Cursos cadastrados na Plataforma
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 2.0 - 12/02/2019
     */
    public function exibirCursos(){
        $cursoBD = new CursoBD();
        $cursoBD->encontrarCursos();
        
        while ($dado = $cursoBD->retornarDados()){
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
    
}
