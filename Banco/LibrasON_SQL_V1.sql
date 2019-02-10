-- MySQL Workbench Synchronization
-- Generated: 2019-02-08 14:17
-- Model: New Model
-- Version: 1.0
-- Project: Name of the project
-- Author: Caio Alexandre

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

CREATE SCHEMA IF NOT EXISTS `LibrasON` DEFAULT CHARACTER SET utf8 ;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Usuario` (
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

CREATE TABLE IF NOT EXISTS `LibrasON`.`Perfil` (
  `idPerfil` INT(11) NOT NULL AUTO_INCREMENT,
  `Foto` BLOB NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idPerfil`),
	FOREIGN KEY (`FK_idUsuario`)
	REFERENCES `LibrasON`.`Usuario` (`idUsuario`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Curso` (
  `idCurso` INT(11) NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(80) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `Oferecedor` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Notificacoes` (
  `idNotificacoes` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `Oferecedor` VARCHAR(80) NOT NULL,
  `Perfil_Oferecedor` VARCHAR(80) NOT NULL,
  `DataCriacao` DATETIME NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idNotificacoes`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `LibrasON`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Notificacoes_Gerais` (
  `idNotificacoes_Gerais` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `DataCriacao` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`idNotificacoes_Gerais`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Video` (
  `idVideo` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(200) NOT NULL,
  `URL` TEXT NOT NULL,
  `Descricao` TEXT NOT NULL,
  `DataCriacao` DATE NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idVideo`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `LibrasON`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Documentacao` (
  `idDocumentacao` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(200) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `NomeArquivo` VARCHAR(200) NOT NULL,
  `DateCriacao` DATE NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idDocumentacao`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `LibrasON`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Tarefas` (
  `idTarefas` INT(11) NOT NULL AUTO_INCREMENT,
  `Proposta` VARCHAR(100) NOT NULL,
  `Descricao` TEXT NOT NULL,
  `DataCriacao` DATE NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
  PRIMARY KEY (`idTarefas`),
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `LibrasON`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`QuestoesFechadas` (
  `idQuestoesFechadas` INT(11) NOT NULL AUTO_INCREMENT,
  `Questao` TEXT NOT NULL,
  `Resposta` TEXT NOT NULL,
  `Tipo` INT(11) NOT NULL,
  `FK_idTarefas` INT(11) NOT NULL,
  PRIMARY KEY (`idQuestoesFechadas`),
    FOREIGN KEY (`FK_idTarefas`)
    REFERENCES `LibrasON`.`Tarefas` (`idTarefas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Alternativa` (
  `idAlternativa` INT(11) NOT NULL AUTO_INCREMENT,
  `Texto` TEXT NOT NULL,
  `FK_idQuestoes` INT(11) NOT NULL,
  PRIMARY KEY (`idAlternativa`),
    FOREIGN KEY (`FK_idQuestoes`)
    REFERENCES `LibrasON`.`QuestoesFechadas` (`idQuestoesFechadas`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Comunidade` (
  `idComunidade` INT(11) NOT NULL AUTO_INCREMENT,
  `Topico` TEXT NOT NULL,
  `FK_idUsuario` INT(11) NOT NULL,
  PRIMARY KEY (`idComunidade`),
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `LibrasON`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`MensagemDiscusao` (
  `idMensagemDiscusao` INT(11) NOT NULL AUTO_INCREMENT,
  `Mensagem` TEXT NOT NULL,
  `Data` DATETIME NOT NULL,
  `FK_idComunidade` INT(11) NOT NULL,
  PRIMARY KEY (`idMensagemDiscusao`),
    FOREIGN KEY (`FK_idComunidade`)
    REFERENCES `LibrasON`.`Comunidade` (`idComunidade`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE TABLE IF NOT EXISTS `LibrasON`.`Usuario_has_Curso` (
  `FK_idUsuario` INT(11) NOT NULL,
  `FK_idCurso` INT(11) NOT NULL,
    FOREIGN KEY (`FK_idUsuario`)
    REFERENCES `LibrasON`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
    FOREIGN KEY (`FK_idCurso`)
    REFERENCES `LibrasON`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
