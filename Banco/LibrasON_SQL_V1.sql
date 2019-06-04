
CREATE TABLE IF NOT EXISTS `Usuario` (
  `idUsuario` INT(11) NOT NULL AUTO_INCREMENT,
  `Usuario` VARCHAR(30) NOT NULL,
  `Email` VARCHAR(100) NOT NULL,
  `Senha` VARCHAR(40) NOT NULL,
  `Nome` VARCHAR(60) NOT NULL,
  `Sobrenome` VARCHAR(60) NOT NULL,
  `DataNascimento` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Perfil` (
  `idPerfil` INT(11) NOT NULL AUTO_INCREMENT,
  `Foto` BLOB NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idPerfil`),
	FOREIGN KEY (`FK_idUsuario`)
	REFERENCES `Usuario` (`idUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Curso` (
  `idCurso` INT(11) NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(80) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `Oferecedor` VARCHAR(100) NOT NULL,
  `Inscricoes` INT(11) NOT NULL,
  `Tipo` INT(11) NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Codigo_Geral_Inscricao` (
  `idCodigo_Geral_Inscricao` INT(11) NOT NULL AUTO_INCREMENT,
  `Codigo` VARCHAR(45) NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idCodigo_Geral_Inscricao`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Informacoes` (
  `idInformacoes` INT(11) NOT NULL AUTO_INCREMENT,
  `Regulamento` TEXT NOT NULL,
  `Certificacao` TEXT NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idInformacoes`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Notificacoes` (
  `idNotificacoes` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `Oferecedor` VARCHAR(80) NOT NULL,
  `Perfil_Oferecedor` VARCHAR(80) NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idNotificacoes`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Notificacoes_Gerais` (
  `idNotificacoes_Gerais` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `DataCriacao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idNotificacoes_Gerais`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Video` (
  `idVideo` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(200) NOT NULL,
  `URL` TEXT NOT NULL,
  `Descricao` TEXT NOT NULL,
  `Tempo` INT(11) NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idVideo`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Documentacao` (
  `idDocumentacao` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(200) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `NomeArquivo` VARCHAR(200) NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idDocumentacao`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Tarefas` (
  `idTarefas` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(100) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idTarefas`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `QuestoesFechadas` (
  `idQuestoesFechadas` INT(11) NOT NULL AUTO_INCREMENT,
  `Questao` TEXT NOT NULL,
  `Resposta` TEXT NOT NULL,
  `Tipo` INT(11) NOT NULL,
  `Img` VARCHAR(200),
  `FK_idTarefas` INT(11) NOT NULL,
  PRIMARY KEY (`idQuestoesFechadas`),
    FOREIGN KEY (`FK_idTarefas`)
    REFERENCES `Tarefas` (`idTarefas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Alternativa` (
  `idAlternativa` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `Img` VARCHAR(100) NOT NULL,
  `FK_idQuestoes` INT(11) NOT NULL,
  PRIMARY KEY (`idAlternativa`),
    FOREIGN KEY (`FK_idQuestoes`)
    REFERENCES `QuestoesFechadas` (`idQuestoesFechadas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Comunidade` (
  `idComunidade` INT(11) NOT NULL AUTO_INCREMENT,
  `Topico` TEXT NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idComunidade`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `MensagemDiscusao` (
  `idMensagemDiscusao` INT(11) NOT NULL AUTO_INCREMENT,
  `Mensagem` TEXT NOT NULL,
  `Data` DATETIME NOT NULL,
  `FK_idComunidade` INT(11) NOT NULL,
  PRIMARY KEY (`idMensagemDiscusao`),
    FOREIGN KEY (`FK_idComunidade`)
    REFERENCES `Comunidade` (`idComunidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Usuario_has_Curso` (
  `Inscricao` INT(11) NOT NULL AUTO_INCREMENT,
  `FK_idUsuario` INT(11) NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`Inscricao`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `LibrasON`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Usuario_has_Documentacao` (
  `FK_idUsuario` INT(11) NOT NULL,
  `FK_idDocumentacao` INT(11) NOT NULL,
  PRIMARY KEY (`FK_idUsuario`, `FK_idDocumentacao`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`FK_idDocumentacao`)
    REFERENCES `Documentacao` (`idDocumentacao`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Usuario_has_Tarefas` (
  `FK_idTarefas` INT(11) NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`FK_idTarefas`, `FK_idUsuario`),
    FOREIGN KEY (`FK_idTarefas`)
    REFERENCES `Tarefas` (`idTarefas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `Usuario_has_Video` (
  `FK_idUsuario` INT(11) NOT NULL,
  `FK_idVideo` INT(11) NOT NULL,
  PRIMARY KEY (`FK_idUsuario`, `FK_idVideo`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`FK_idVideo`)
    REFERENCES `Video` (`idVideo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;
