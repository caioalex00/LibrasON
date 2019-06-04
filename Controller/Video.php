<?php
 /**
 * @project: LibrasON
 * @name: Video
 * @description: Classe que contém as funções da pagina de Video do AVA;
 * @copyright (c) 08/02/2019, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 2.0  - 10/02/2019
 * @métodos buscarInformacoes
 */

class Video {
    /** @var int $idVideo armazena o ID do video */
    public $idVideo;
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
     * @param int $idVideo armazena o id do Video
     */
    public function __construct($idVideo, $idCurso, $idUsuario) {
        $this->idVideo = $idVideo;
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
        $Read = new Reader("Video", "*", "idVideo", $this->idVideo);
        $Read->executarQuery();
        return $Read->getResultado()[0];
    }
}
