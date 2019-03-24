<?php

class Video {
    
    public $idVideo;
    public $idCurso;
    public $idUsuario;
    
    public function __construct($idVideo, $idCurso, $idUsuario) {
        $this->idVideo = $idVideo;
        $this->idCurso = $idCurso;
        $this->idUsuario = $idUsuario;
    }
    
    public function buscarInformacoes(){
        $Read = new Reader("Video", "*", "idVideo", $this->idVideo);
        $Read->executarQuery();
        return $Read->getResultado()[0];
    }
}
