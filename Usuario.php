<?php
/*
Autor : Helton
Classe Usuario para tratamento de tados da respectiva tabela
Extende a classe Conexoes para acesso ao bd
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
    
    public function resposta() {
        echo $this->getRetorno()."<br/>";
    }
    
    public function inserir ($n, $s){
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