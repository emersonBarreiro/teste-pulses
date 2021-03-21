CREATE DATABASE teste_pulses;
USE teste_pulses;

CREATE TABLE dimensoes(
	idDimensao INT (11) UNSIGNED NOT NULL AUTO_INCREMENT,
    descricaoDimensao VARCHAR(255) NOT NULL,
    excluidaDimensao CHAR(1) DEFAULT '0',
    PRIMARY KEY (idDimensao)
);

CREATE TABLE perguntas(
	idPergunta INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    textoPergunta VARCHAR(255) NOT NULL,
    idDimensao INT(11) UNSIGNED NOT NULL,
    ativaPergunta CHAR(1) DEFAULT '1',
    excluidaPergunta CHAR(1) DEFAULT '0',
    PRIMARY KEY (idPergunta),
    FOREIGN KEY (idDimensao) REFERENCES dimensoes(idDimensao) ON UPDATE CASCADE ON DELETE RESTRICT
);

insert into dimensoes (descricaoDimensao) values ("Bem-estar"), ("Estrutura"), ("Carreira");
insert into perguntas (textoPergunta, idDimensao, ativaPergunta) VALUES
("Quantos dias na semana você prefere trabalhar em home-office?", 2, "1"), 
("De 0 a 10, como você avalia sua disposicao para o dia?", 1, "0"),
("O quanto você se sente atraído pelas oportunidades de carreira que a empresa oferece?", 3, "1");