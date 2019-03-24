-- FUNÇÃO: contem a função de vereficar vagas restantes

DELIMITER $$

CREATE FUNCTION verificarVagas (idCurso INT(11))
RETURNS INTEGER
BEGIN

DECLARE retorno INT(11);

SELECT count(FK_idCurso) INTO retorno FROM Usuario_has_Curso WHERE FK_idCurso = idCurso;

RETURN retorno;
END$$

DELIMITER $$;

-- VIEW: contem todas as Propostas do cursos organizadas por postagem

CREATE VIEW `Propostas` AS
SELECT FK_idCurso as 'idCurso', idVideo as 'idProposta', Proposta, Descricao, DataCriacao FROM Video v
UNION ALL
SELECT FK_idCurso as 'idCurso', idTarefas as 'idProposta', Proposta, Descricao, DataCriacao FROM Tarefas t
UNION ALL
SELECT FK_idCurso as 'idCurso', idDocumentacao as 'idProposta', Proposta, Descricao, DataCriacao FROM Documentacao d
ORDER BY DataCriacao ASC;