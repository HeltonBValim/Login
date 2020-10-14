<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <!--<link rel="stylesheet" type="text/css" href="estilos/estilos.css">-->
        <title></title>
    </head>
    <body>
        <div class="center">
            <p>Para Consultar tudo ou Deletar tudo, deixe os campos em branco<br/>
            Para Inserir ou Alterar, ambos os campos devem sem preenchidos.<br></p>
            <form method="post" action="gravar.php">
                <label for="iuser">Usuário: </label>
                <input type="text" name="nome" id="iuser"/></br>
                <label for="ipass">Senha: </label>
                <input type="password" name="paw" id="ipass"/></br>
                <label for="ioper">Operação: </label>
                <select id="ioper" name="oper">
                    <option value="" selected>Selecione a opção!</option>
                    <option value="i">Inserir</option>
                    <option value="a">Alterar</option>
                    <option value="d">Deletar</option>
                    <option value="c">Consultar</option>
                <input type="submit" value="Enviar">
            </form>
            </br>
        </div>
    </body>
</html>
<!--
PDO(*)
https://www.devmedia.com.br/como-conectar-mysql-com-php-via-pdo/30317 (*)
https://www.devmedia.com.br/php-pdo-como-se-conectar-ao-banco-de-dados/37211 (*)

https://siteantigo.portaleducacao.com.br/conteudo/artigos/informatica/resgatando-registros-no-postgresql-com-php/7209

https://pt.stackoverflow.com/questions/3567/como-exibir-o-resultado-de-uma-query-numa-p%C3%A1gina-html-em-php
https://pt.stackoverflow.com/questions/210194/retornar-dados-da-minha-tabela-formatando-no-html
https://www.devmedia.com.br/criando-uma-conexao-em-php-com-mysql-e-postgresql/23917


-->