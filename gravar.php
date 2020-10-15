<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <?php
        require_once 'Usuario.php';
        $nm = isset($_POST["nome"]) ? $_POST["nome"] : "";
        $pw = isset($_POST["psw"]) ? $_POST["psw"] : "";
        $oper = isset($_POST["oper"]) ? $_POST["oper"] : "";
        ?>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
        <title>Testes com BDs - Página de retorno</title>
    </head>
    <body>
        <!--
            @Autor : HeltonBValim
            Arquivo gravar.php para execução das funções solicitadas pelo
            formulário em index.html
        -->
        <pre>
        <div>
            <?php
            $usuario = new Usuario(); #cria novo objeto da classe Usuario.
            echo "<p>Tipo de conexão: " . $usuario->getTipo() . " <br/></p>";
            /* Exibir o tipo de conexão apenas para referência
              Caso isso não seja necessário, a function pode ser
              modificada para protected e a linha pode ser suprimida */
            $usuario->conectar(true); #conecta ao banco selecionado na classe Conexao
            $usuario->resposta() . "<br/>"; #Exibe a resposta da conexão.
            /* Apenas uma variável foi criada para retornar as respostas
              a cada passo do sistema. */
            /* Verifica a operação selecionada e executa a respectiva function */
            switch ($oper) {
                case "i":
                    if (($nm === "") or ($pw === "")) {
                        echo "Sem dados informados...<br/>";
                    } else {
                        $usuario->inserir($nm, $pw);
                        $usuario->resposta();
                    }
                    break;
                case "a":
                    if (($nm === "") or ($pw === "")) {
                        echo "Sem dados informados...<br/>";
                    } else {
                        $usuario->alterar($nm, $pw);
                        $usuario->resposta();
                    }
                    break;
                case "d":
                    $usuario->deletar($nm);
                    $usuario->resposta();
                    break;
                case "c":
                    $usuario->consultar($nm);
                    $usuario->resposta();
                    break;
                default :
                    echo "Nenhuma operação solicitada<br/>";
            }
            $usuario->conectar(false); #Desconecta o banco.
            $usuario->resposta() . "<br/>"; #Exibe a resposta ao último comando(desconectar).
            ?>
        </div>
        <a href="javascript:history.go(-1)">Voltar</a>
        </pre>
    </body>
</html>