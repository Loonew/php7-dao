CREATE TABLE tb_usuarios (
  idusuario int(11) NOT NULL AUTO_INCREMENT,
  login varchar(64) NOT NULL,
  senha varchar(256) NOT NULL,
  dtcadastro timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (idusuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SELECT *FROM tb_usuarios;

INSERT INTO tb_usuarios (login, senha) VALUES ('root', '!@#$%');

UPDATE tb_usuarios SET senha = '123456' WHERE idusuario = 1;

DELETE FROM tb_usuarios WHERE idusuario = 1;

TRUNCATE TABLE tb_usuarios;