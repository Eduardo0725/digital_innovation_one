CREATE TABLE IF NOT EXISTS banco (
	numero INTEGER NOT NULL,
	nome VARCHAR(50) NOT NULL,
	ativo BOOLEAN NOT NULL DEFAULT TRUE,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (numero)
);

CREATE TABLE IF NOT EXISTS agencia (
	banco_numero INTEGER NOT NULL,
	numero INTEGER NOT NULL,
	nome VARCHAR(80) NOT NULL,
	ativo BOOLEAN NOT NULL DEFAULT TRUE,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (banco_numero, numero),
	FOREIGN KEY (banco_numero) REFERENCES banco (numero)
);

CREATE TABLE IF NOT EXISTS cliente (
	numero BIGSERIAL PRIMARY KEY,
	nome VARCHAR(120) NOT NULL,
	email VARCHAR(120) NOT NULL,
	ativo BOOLEAN NOT NULL DEFAULT TRUE,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS conta_corrente (
	banco_numero INTEGER NOT NULL,
	agencia_numero INTEGER NOT NULL,
	numero BIGINT NOT NULL,
	digito SMALLINT NOT NULL,
	cliente_numero BIGINT NOT NULL,
	ativo BOOLEAN NOT NULL DEFAULT TRUE,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (banco_numero, agencia_numero, numero, digito, cliente_numero),
	FOREIGN KEY (banco_numero, agencia_numero) REFERENCES agencia (banco_numero, numero),
	FOREIGN KEY (cliente_numero) REFERENCES cliente (numero)
);

CREATE TABLE IF NOT EXISTS tipo_transacao (
	id SMALLINT PRIMARY KEY,
	nome VARCHAR(50) NOT NULL,
	ativo BOOLEAN NOT NULL DEFAULT TRUE,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS cliente_transacoes (
	id BIGSERIAL PRIMARY KEY,
	banco_numero INTEGER NOT NULL,
	agencia_numero INTEGER NOT NULL,
	conta_corrente_numero BIGINT NOT NULL,
	conta_corrente_digito SMALLINT NOT NULL,
	cliente_numero BIGINT NOT NULL,
	tipo_transacao_id SMALLINT NOT NULL,
	valor NUMERIC(15,2) NOT NULL,
	data_criacao TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (banco_numero, agencia_numero, conta_corrente_numero, conta_corrente_digito, cliente_numero)
	REFERENCES conta_corrente (banco_numero, agencia_numero, numero, digito, cliente_numero)
);

SELECT numero, nome, ativo FROM banco;
SELECT banco_numero, numero, nome FROM agencia;
SELECT numero, nome, email FROM cliente;
SELECT id, nome FROM tipo_transacao;
SELECT banco_numero, agencia_numero, numero, cliente_numero FROM conta_corrente;
SELECT banco_numero, agencia_numero, cliente_numero FROM cliente_transacoes;

---------------------------------TESTE---------------------------------
CREATE TABLE teste (
	id SERIAL PRIMARY KEY,
	nome VARCHAR(50) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS teste;

CREATE TABLE teste (
	cpf VARCHAR(11) NOT NULL,
	nome VARCHAR(50) NOT NULL,
	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (cpf)
);

INSERT INTO teste (cpf, nome, created_at)
VALUES ('12345678901', 'Eduardo', '2019-03-04');

INSERT INTO teste (cpf, nome, created_at)
VALUES ('12345678901', 'Eduardo', '2019-03-04')
ON CONFLICT (cpf) DO NOTHING;

UPDATE teste SET nome = 'Pedro' WHERE cpf = '12345678901';

SELECT * FROM teste;
---------------------------------TESTE---------------------------------

SELECT * FROM information_schema.columns WHERE table_name = 'banco';

--AVG
SELECT AVG(valor) FROM cliente_transacoes;
--COUNT (having)
SELECT COUNT(numero) FROM cliente;
--MAX
SELECT MAX(valor) FROM cliente_transacoes;
--MIN
SELECT MIN(valor) FROM cliente_transacoes;
--SUM
SELECT SUM(valor) FROM cliente_transacoes;

--Valores agregados com não agregados dão erro.
SELECT COUNT(id), tipo_transacao_id FROM cliente_transacoes;
--Para resolver terá que agrupá-los com o GROUP BY.
SELECT COUNT(id), tipo_transacao_id FROM cliente_transacoes
GROUP BY tipo_transacao_id;
--O mesmo vale para as outras funções de agregação.

--HAVING
SELECT COUNT(id), tipo_transacao_id FROM cliente_transacoes
GROUP BY tipo_transacao_id
HAVING COUNT(id) > 150;

--ORDER BY
SELECT COUNT(id), tipo_transacao_id FROM cliente_transacoes
GROUP BY tipo_transacao_id
ORDER BY tipo_transacao_id ASC;

SELECT COUNT(id), tipo_transacao_id FROM cliente_transacoes
GROUP BY tipo_transacao_id
ORDER BY tipo_transacao_id DESC;

---------------------------------JOINs---------------------------------
SELECT numero, nome, ativo FROM banco;
SELECT banco_numero, numero, nome FROM agencia;
SELECT numero, nome, email FROM cliente;
SELECT id, nome FROM tipo_transacao;
SELECT banco_numero, agencia_numero, numero, cliente_numero FROM conta_corrente;
SELECT banco_numero, agencia_numero, conta_corrente_numero, conta_corrente_digito, cliente_numero, valor FROM cliente_transacoes;

SELECT COUNT (1) FROM banco; --151
SELECT COUNT (1) FROM agencia; --296

--JOIN
SELECT banco.numero, banco.nome, agencia.numero, agencia.nome 
FROM banco
JOIN agencia ON banco.numero = agencia.banco_numero; --296 agencias possuem bancos

SELECT COUNT(DISTINCT banco.numero)
FROM banco
JOIN agencia ON banco.numero = agencia.banco_numero; --Somente 9 bancos tem agencias

--LEFT JOIN
SELECT banco.numero, banco.nome, agencia.numero, agencia.nome
FROM banco
LEFT JOIN agencia ON banco.numero = agencia.banco_numero;

SELECT COUNT(banco.numero)
FROM banco
LEFT JOIN agencia ON banco.numero = agencia.banco_numero;

--RIGHT JOIN
SELECT banco.numero, banco.nome, agencia.numero, agencia.nome
FROM agencia
RIGHT JOIN banco ON banco.numero = agencia.banco_numero;

--FULL JOIN
SELECT banco.numero, banco.nome, agencia.numero, agencia.nome
FROM banco
FULL JOIN agencia ON banco.numero = agencia.banco_numero;

--JOIN com todas as tabelas
SELECT banco.nome, 
	   agencia.nome, 
	   conta_corrente.numero, 
	   conta_corrente.digito,
	   cliente.nome
FROM banco
JOIN agencia ON banco.numero = agencia.banco_numero
JOIN conta_corrente ON banco.numero = conta_corrente.banco_numero
	AND agencia.numero = conta_corrente.agencia_numero
JOIN cliente ON cliente.numero = conta_corrente.cliente_numero;

SELECT banco.nome, 
	   agencia.nome, 
	   conta_corrente.numero, 
	   conta_corrente.digito,
	   cliente.nome,
	   tipo_transacao.nome,
	   cliente_transacoes.valor,
	   cliente_transacoes.data_criacao
FROM cliente_transacoes
JOIN banco ON banco.numero = cliente_transacoes.banco_numero
JOIN agencia ON cliente_transacoes.agencia_numero = agencia.numero
	AND banco.numero = agencia.banco_numero
JOIN conta_corrente ON cliente_transacoes.conta_corrente_numero = conta_corrente.numero
	AND banco.numero = conta_corrente.banco_numero
	AND agencia.numero = conta_corrente.agencia_numero
JOIN cliente ON cliente.numero = cliente_transacoes.cliente_numero
JOIN tipo_transacao ON tipo_transacao.id = cliente_transacoes.tipo_transacao_id;
---------------------------------JOINs---------------------------------

----------------------------------CTE----------------------------------
SELECT numero, nome FROM banco;
SELECT banco_numero, numero, nome FROM agencia;

WITH tbl_tmp_banco AS (
	SELECT numero, nome 
	FROM banco
)
SELECT nome, numero
FROM tbl_tmp_banco;

WITH params AS (
	SELECT 213 AS banco_numero
), tbl_tmp_banco AS (
	SELECT numero, nome 
	FROM banco
	JOIN params
	ON params.banco_numero = banco.numero
)
SELECT numero, nome 
FROM tbl_tmp_banco;

WITH cliente_e_transacoes AS (
	SELECT cliente.nome AS cliente_nome,
		   tipo_transacao.nome AS tipo_transacao,
		   cliente_transacoes.valor AS valor
	FROM cliente_transacoes
	JOIN cliente ON cliente.numero = cliente_transacoes.cliente_numero
	JOIN tipo_transacao ON tipo_transacao.id = cliente_transacoes.tipo_transacao_id
)
SELECT cliente_nome, tipo_transacao, valor
FROM cliente_e_transacoes;
----------------------------------CTE----------------------------------

----------------------------------VIEW---------------------------------
SELECT numero, nome, ativo
FROM banco;

CREATE OR REPLACE VIEW vw_bancos AS (
	SELECT numero, nome, ativo
	FROM banco
);

SELECT numero, nome, ativo
FROM vw_bancos;

CREATE OR REPLACE VIEW vw_bancos_2 (banco_numero, banco_nome, banco_ativo) AS (
	SELECT numero, nome, ativo
	FROM banco
);

SELECT banco_numero, banco_nome, banco_ativo
FROM vw_bancos_2;

INSERT INTO vw_bancos_2 (banco_numero, banco_nome, banco_ativo) 
VALUES (51, 'Banco Boa Ideia', TRUE);

SELECT banco_numero, banco_nome, banco_ativo
FROM vw_bancos_2 WHERE banco_numero = 51;
SELECT numero, nome, ativo
FROM banco WHERE numero = 51;

UPDATE vw_bancos_2 SET banco_ativo = FALSE WHERE banco_numero = 51;

DELETE FROM vw_bancos_2 WHERE banco_numero = 51;



CREATE OR REPLACE TEMPORARY VIEW vw_agencia AS (
	SELECT nome FROM agencia
);

SELECT nome FROM vw_agencia;

CREATE OR REPLACE VIEW vw_bancos_ativos AS (
	SELECT numero, nome, ativo
	FROM banco
	WHERE ativo IS TRUE
) WITH LOCAL CHECK OPTION;

INSERT INTO vw_bancos_ativos (numero, nome, ativo) VALUES (51, 'Banco Boa Ideia', FALSE);

CREATE OR REPLACE VIEW vw_bancos_com_a AS (
	SELECT numero, nome, ativo
	FROM vw_bancos_ativos
	WHERE nome ILIKE 'a%'
) WITH LOCAL CHECK OPTION;

SELECT numero, nome, ativo FROM vw_bancos_com_a;

INSERT INTO vw_bancos_com_a (numero, nome, ativo) VALUES (333, 'Beta Omega', TRUE); --Erro
INSERT INTO vw_bancos_com_a (numero, nome, ativo) VALUES (331, 'Alfa Omega', FALSE); --Erro
INSERT INTO vw_bancos_com_a (numero, nome, ativo) VALUES (333, 'Alfa Omega', TRUE); --Ok

CREATE OR REPLACE VIEW vw_bancos_ativos AS (
	SELECT numero, nome, ativo
	FROM banco
	WHERE ativo IS TRUE
);

INSERT INTO vw_bancos_com_a (numero, nome, ativo) VALUES (331, 'Alfa Omega', FALSE); --Ok

CREATE OR REPLACE VIEW vw_bancos_com_a AS (
	SELECT numero, nome, ativo
	FROM vw_bancos_ativos
	WHERE nome ILIKE 'a%'
)WITH CASCADED CHECK OPTION;

INSERT INTO vw_bancos_com_a (numero, nome, ativo) VALUES (332, 'Alfa Omega Beta', FALSE); --Erro
----------------------------------VIEW---------------------------------

CREATE TABLE IF NOT EXISTS funcionarios(
	id SERIAL,
	nome VARCHAR(50),
	gerente INTEGER,
	PRIMARY KEY (id),
	FOREIGN KEY (gerente) REFERENCES funcionarios (id)
);

INSERT INTO funcionarios (nome, gerente) VALUES ('Ancelmo', NULL);
INSERT INTO funcionarios (nome, gerente) VALUES ('Beatriz', 1);
INSERT INTO funcionarios (nome, gerente) VALUES ('Magno', 1);
INSERT INTO funcionarios (nome, gerente) VALUES ('Cremilda', 2);
INSERT INTO funcionarios (nome, gerente) VALUES ('Wagner', 4);

SELECT id, nome, gerente FROM funcionarios;
SELECT id, nome, gerente FROM funcionarios WHERE gerente IS NULL;
SELECT id, nome, gerente FROM funcionarios WHERE gerente = 999;

SELECT id, nome, gerente FROM funcionarios WHERE gerente IS NULL
UNION ALL
SELECT id, nome, gerente FROM funcionarios WHERE gerente = 999; --APENAS PARA EXEMPLIFICAR

CREATE OR REPLACE RECURSIVE VIEW vw_func(id, gerente, funcionario) AS(
	SELECT id, gerente, nome
	FROM funcionarios
	WHERE gerente IS NULL
	
	UNION ALL
	
	SELECT funcionarios.id, funcionarios.gerente, funcionarios.nome
	FROM funcionarios
	JOIN vw_func ON vw_func.id = funcionarios.gerente
);

SELECT id, gerente, funcionario
FROM vw_func;

----------------------------------EXERCICIO----------------------------------
--No lugar de "gerente", colocar o nome do gerente ao invés do id.

DROP VIEW IF EXISTS vw_func;
CREATE OR REPLACE RECURSIVE VIEW vw_func(id, gerente, funcionario) AS(
	SELECT id, gerente::varchar(50), nome
	FROM funcionarios
	WHERE gerente IS NULL
	
	UNION ALL
	
	SELECT funcionarios.id, vw_func.funcionario, funcionarios.nome
	FROM funcionarios
	JOIN vw_func ON vw_func.id = funcionarios.gerente
);

SELECT * FROM vw_func;
SELECT * FROM funcionarios;
----------------------------------EXERCICIO----------------------------------

----------------------------------Transações---------------------------------
SELECT numero, nome, ativo FROM banco ORDER BY numero;

UPDATE banco SET ativo = FALSE WHERE numero = 0;

BEGIN;
UPDATE banco SET ativo = TRUE WHERE numero = 0;
SELECT numero, nome, ativo FROM banco WHERE numero = 0;
ROLLBACK;

BEGIN;
UPDATE banco SET ativo = TRUE WHERE numero = 0;
COMMIT;

SELECT id, gerente, nome FROM funcionarios;

BEGIN;
UPDATE funcionarios SET gerente = 2 WHERE id = 3;
SAVEPOINT save_func;
UPDATE funcionarios SET gerente = NULL;
ROLLBACK TO save_func;
UPDATE funcionarios SET gerente = 3 WHERE id = 5;
COMMIT;

----------------------------------Funções----------------------------------
CREATE OR REPLACE FUNCTION func_soma (INTEGER, INTEGER)
RETURNS INTEGER
SECURITY DEFINER
--RETURNS NULL ON NULL INPUT
CALLED ON NULL INPUT
LANGUAGE SQL
AS $$
	SELECT COALESCE($1,0) + COALESCE($2,0)
$$;

SELECT func_soma(1,null);

SELECT COALESCE (null,'Digital');

---------------------------------------------------------------------------

CREATE OR REPLACE FUNCTION banco_add(p_numero INTEGER, p_nome VARCHAR, p_ativo BOOLEAN)
RETURNS INTEGER
SECURITY INVOKER
LANGUAGE PLPGSQL
CALLED ON NULL INPUT
AS $$
	DECLARE variavel_id INTEGER;
	BEGIN
		IF p_numero IS NULL OR p_nome IS NULL OR p_ativo IS NULL THEN
			RETURN 0;
		END IF;
		
		SELECT INTO variavel_id numero
		FROM banco
		WHERE numero = p_numero;
		
		IF variavel_id IS NULL THEN
			INSERT INTO banco(numero, nome, ativo)
			VALUES(p_numero, p_nome, p_ativo);
		ELSE
			RETURN variavel_id;
		END IF;
		
		SELECT INTO variavel_id numero
		FROM banco
		WHERE numero = p_numero;
		
		RETURN variavel_id;
	END;
$$;

SELECT banco_add(1234,'Banco Novo', FALSE);

SELECT numero, nome, ativo FROM banco WHERE numero = 1234;
----------------------------------Funções----------------------------------
