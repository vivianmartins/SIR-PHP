/* Criar tabelas */
CREATE TABLE utilizadores (
	idUtiliz INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(200),
	email VARCHAR (200),
	senha VARCHAR (200),
	ativo boolean default true
);

CREATE TABLE tipo (
  idTIpo int(11) NOT NULL auto_increment primary key,
  nome varchar(300) DEFAULT NULL,
  cor varchar(50) DEFAULT NULL,
  ativo tinyint(1) DEFAULT 1,
  idUtil int,
  CONSTRAINT tipo_FK FOREIGN KEY (idUtil) REFERENCES utilizadores (idUtiliz)
);

CREATE TABLE apontamentos(
	id_ap INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	titulo VARCHAR (200),
	informacao VARCHAR (3000),
	dataCriacao datetime default now(),
	imagem BLOB,
	ativo boolean default true,
	idTIpo integer,
	idUtiliz integer,
	CONSTRAINT fk_idUtiliz FOREIGN KEY (idUtiliz) REFERENCES utilizadores (idUtiliz),
	CONSTRAINT fk_idTipo FOREIGN KEY (idTipo) REFERENCES tipo (idTipo)
);