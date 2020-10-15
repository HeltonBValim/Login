# Login
## Teste de conexão com MySql e PostgreSql utilizando PHP

Repositório criado para **teste de conexões** com
diferentes tipo de banco de dados, bem como a
viabilidade do uso de _Storage-Procedures_.

Para os testes, foram usadas as informações listadas abaixo para criação
dos BDs e tabelas (tiradas nos respectivos SGBDs):

```
-- PostgreSql 9.3

-- Database: teste
-- DROP DATABASE teste;

CREATE DATABASE teste
    WITH OWNER = postgres
        ENCODING = 'UTF8'
        TABLESPACE = pg_default
        LC_COLLATE = 'Portuguese_Brazil.1252'
        LC_CTYPE = 'Portuguese_Brazil.1252'
        CONNECTION LIMIT = -1;

-- Table: tblusuarios
-- DROP TABLE tblusuarios;

CREATE TABLE tblusuarios
(
    nome character varying(40),
    senha character varying(10)
)
WITH (
    OIDS=FALSE
);
ALTER TABLE tblusuarios
    OWNER TO postgres;
  
--MySql : 10.4.14-MariaDB em xampp-windows-x64-7.4.10-0-VC15-installer.exe
CREATE DATABASE teste;

USE teste;

CREATE TABLE tblusuarios
(
    nome varchar(40),
    senha varchar(10),
);
```


