CREATE DATABASE restaurante

CREATE TABLE mozos(
	idmozo	INT AUTO_INCREMENT 	PRIMARY KEY,
	mesa	INT 			NOT NULL,
	entrada VARCHAR(50)		NOT NULL,
	menu 	VARCHAR(100)		NOT NULL,
	descripcion VARCHAR(100)	NOT NULL,
	total DECIMAL(7,2)		NOT NULL,
	fecha_registro		DATETIME	NOT NULL DEFAULT NOW(),
	fecha_modificacion	DATETIME	NULL,
	estado		CHAR(1)			NOT NULL DEFAULT '1'
)ENGINE=INNODB;




CREATE TABLE recepcionistas(
	idrecepcionista INT AUTO_INCREMENT 	PRIMARY KEY,
	nombre VARCHAR(50)		NOT NULL,
	entrada VARCHAR(50)		NOT NULL,
	menu 	VARCHAR(100)		NOT NULL,
	descripcion VARCHAR(100)	NOT NULL,
	total DECIMAL(7,2)		NOT NULL,
	fecha_registro		DATETIME	NOT NULL DEFAULT NOW(),
	fecha_modificacion	DATETIME	NULL,
	estado		CHAR(1)			NOT NULL DEFAULT '1'
)ENGINE=INNODB;





CREATE TABLE usuarios(
	idusuario	INT AUTO_INCREMENT 	PRIMARY KEY,
	nombreusuario	VARCHAR(50)		NOT NULL,
	apellidos	VARCHAR(30)		NOT NULL,
	nombres		VARCHAR(30)		NOT NULL,
	claveacceso	VARCHAR(100)		NOT NULL,
	fecha_registro	DATETIME		NOT NULL DEFAULT NOW(),
	fecha_modificacion	DATETIME	NULL,
	estado		CHAR(1)			NOT NULL DEFAULT '1'	
)ENGINE=INNODB;

INSERT INTO usuarios(nombreusuario, apellidos, nombres, claveacceso) VALUES
('AlonsoMu','Muñoz Quispe','Alonso Enrique','gustitos'),
('FiorellaY','Colquepisco Madrid','Fiorella Yakelyns','gustitoa');

UPDATE usuarios SET
	claveacceso = '$2y$10$9RlJvEUJI2RYbmK2a/sZbubKl0cTUL9ecBQ/I.wzSdvWt2BJ65JJu'
	WHERE idusuario = 1;

UPDATE usuarios SET
	claveacceso = '$2y$10$TAbap4jTCQ3MV9MafFCuKeqG2VAUCZFz/DHcfx48upyYZsy/zZjlO'
	WHERE idusuario = 2;
	


