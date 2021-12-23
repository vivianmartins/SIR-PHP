/* Criar tabelas */
CREATE TABLE utilizadores (
	idUtiliz INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(200),
	email VARCHAR (200),
	senha VARCHAR (200),
	ativo boolean default true
);

CREATE TABLE tipo (
	idTIpo INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome varchar (300),
	cor varchar (50),
	ativo boolean default true
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
	CONSTRAINT fk_idTipo FOREIGN KEY (idTipo) REFERENCES
	tipo (idTipo)
);

/* Gerar dados */
INSERT INTO utilizadores (nome, email, senha) values ('julio', 'julio@mailp.com', '123');
insert into tipo (nome, cor) values ('tipo1', '123456');
insert into apontamentos (titulo, informacao, idtipo, idutiliz) values ('teste', 
'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Veritatis est, necessitatibus soluta vero obcaecati sit culpa debitis facilis, 
consectetur dolor quaerat! Nesciunt facilis laborum cum aut, quasi dolorem aspernatur. Dolores.', '1', '1');
