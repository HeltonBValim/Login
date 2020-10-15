<?php
/*
@Autor : HeltonBValim
Classe Usuario: para operações com dados da respectiva tabela
Extende a classe Conexoes para acesso ao bd
Implementa a interface iCrud
*/
require_once 'iCrud.php';
require_once 'Conexoes.php';
class Usuario extends Conexoes implements iCrud{
    private $nome;
    private $senha;
    private $strsql;
    private $tabela = "tblusuarios";
    private $dados;
    
    private function getNome() {
        return $this->nome;
    }
    
    private function getSenha() {
        return $this->senha;
    }
    
    private function setNome($nome){
        $this->nome = $nome;
    }
    
    private function setSenha($senha){
        $this->senha = $senha;
    }
    
    /*Os métodos set e get para a variável dados retornam erro
    ao serem utilizados para o retorno do sql executado nos
    bancos instalados. (MySql e PostgreSql)
    Ex. Function inserir na quinta linha*/
    
    public function resposta() { #Esta function é a responsável pelo retorno das mensagens do sistema
        echo $this->getRetorno()."<br/>";
    }
    
    public function inserir ($n, $s){
        /*Executa os inserts de acordo com o tipo do banco.
        O uso do comando sql escrito direto no código ou armazenado em storage procedures
        não atrapalha a seleção de bancos diferentes, desde que o nome da SP seja o mesmo
        em todos os bancos e o número de parâmetros não seja alterado sem a devida revisão
        no fonte.*/
        $this->setNome($n);
        $this->setSenha($s);
        $this->strsql = ("insert into ".$this->tabela."(nome, senha) values ('" . $this->getNome(). "', '" . $this->getSenha() . "')");
        if ($this->getTipo()=="m"){
            $this->dados = mysqli_query($this->getConexao(), $this->strsql)or die("Erro na execução do comando: ".mysqli_error());
        } elseif ($this->getTipo()=="p"){
            $this->dados = pg_query($this->getConexao(), $this->strsql)or die("Erro na execução do comando: ".pg_result_error());
        }        
        if ($this->dados == true){
            $this->setRetorno("Inserido com sucesso...");
        }
    }
    
    public function deletar($n){
        /*Deleta todos os registros no banco se o parâmetro '$n' estiver vazio.
        Apenas para questões ilustrativas e somente em uma base de teste
        para limpar os dados.*/
        if ($n == ""){
            $this->strsql = ("delete from " . $this->tabela);
        } else {
            $this->strsql = ("delete from " . $this->tabela . " where nome=" . "'" . $n . "'");
        }
        if ($this->getTipo() == "m"){
            $this->dados = mysqli_query($this->getConexao(), $this->strsql) or die("Erro na execução do comando: ".mysqli_error());
        } elseif ($this->getTipo() == "p") {
            $this->dados = pg_query($this->getConexao(), $this->strsql) or die("Erro na execução do comando: ". pg_result_error());
        }
        if ($this->dados == true){
            $this->setRetorno("Deletado com sucesso...");
        }
    }
    
    public function alterar($n, $s) {
        /*Altera as informações de Senha($s) para o Nome($n) informado.
        Não há nehhum tipo de tratamento para o texto (lower o upper) seja do nome
        ou da senha.*/
        $this->setNome($n);
        $this->setSenha($s);
        $this->strsql = ('update tblusuarios set senha='."'".$this->getSenha()."'".' where nome='."'".$this->getNome()."'");
        if ($this->getTipo() == "m"){
            $this->dados = mysqli_query($this->getConexao(), $this->strsql) or die("Erro na exexução do comando: ".mysqli_error());
        } elseif ($this->getTipo() == "p"){
            $this->dados = pg_query($this->getConexao(), $this->strsql) or die("Erro na execução do comando: ". pg_result_error());
        }
        if ($this->dados == true){
            $this->setRetorno("Alterado com sucesso...");
        }
    }
    
    public function consultar($n) {
        /*Executa a consulta na tabela de usuários.
        Tras todos os registros caso o parâmetro passado seja vazio.
        Também para questõe ilustrativas.
        1. Nos testes os comandos get e set para a variável dados geraram erros.
        2. A exibição dos dados tem de ser colocados em uma function própria.*/
        $this->setNome($n);
        if ($this->getNome() == '') {
            $this->strsql = ("select * from " . $this->tabela);
        } else {
            $this->strsql = ("select * from " . $this->tabela . " where nome='" . $this->getNome() . "'");
        }
        if ($this->getTipo() == "m"){
            $this->dados = mysqli_query($this->getConexao(), $this->strsql) or die("Erro na execução do comando: " . mysqli_error());
            if (mysqli_num_rows($this->dados) > 0){
                while ($row = mysqli_fetch_array($this->dados)){
                    echo "<br/> Nome: ".$row["nome"]." -x- Senha: ".$row["senha"];
                }
                $this->setRetorno("<br/>Consultado com sucesso");
            } else {
                $this->setRetorno("Nenhum registro encontrado");
            }
        } elseif ($this->getTipo() == "p"){
            $this->dados = pg_query($this->getConexao(), $this->strsql) or die("Erro na execução do comando: " . pg_result_error());
            if (pg_num_rows($this->dados) > 0){
                while($row = pg_fetch_array($this->dados)){
                    echo "<br/> Nome: ".$row["nome"]." -x- Senha: ".$row["senha"];
                }
                $this->setRetorno("<br/>Consultado com sucesso");
            } else {
                $this->setRetorno("Nenhum registro encontrado");
            }
        }
    }
}