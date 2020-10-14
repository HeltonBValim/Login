<!DOCTYPE HTML>
<html lang="pt-br">
<head>
    <?php
        require_once 'Usuario.php';
        $nm = isset($_POST["nome"])?$_POST["nome"]:"";
        $pw = isset($_POST["paw"])?$_POST["paw"]:"";
        $oper = isset($_POST["oper"])?$_POST["oper"]:"";
    ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilos/estilos.css">
    <title>Cadastro.</title>
</head>
<body>
    <h1>Projeto XX</h1>
    <pre>
    <div>
    <?php
        #cria objeto usuário que extende a classe Conexoes
        $usuario = new Usuario();
        #mostra o tipo de conexão recebido
        echo "<p>Tipo de conexão: p <br/></p>";
        $usuario->conectar();
        $usuario->resposta()."<br/>";
        switch ($oper){
            case "i":
                if (($nm === "") or ($pw === "")){
                    echo "Sem dados informados...<br/>";
                } else {
                    $usuario->inserir($nm, $pw);
                    $usuario->resposta();
                }
                break;
            case "a":
                if (($nm === "") or ($pw === "")){
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
        $usuario->desconectar();
        $usuario->resposta()."<br/>";
    ?>
    </div>
    <a href="javascript:history.go(-1)">Voltar</a>
    </pre>
</body>
</html>