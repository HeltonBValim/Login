<?php
/**
 * Descrição de ConexaoBD
 * @autor Helton
 * Classe para conexões com os bancos-de-dados MySql e PostgreSql
 */
class Conexoes {
    /*Parâmetro "Tipo de conexão" passado no construtor da classe:
     *  m -> MySql;
     *  p -> PostgreSql.
    */
    private $mysqlsrv = "localhost";
    private $mysqlusr = "mestre";
    private $mysqlsnh = "dono";
    private $mysqldb = "teste";
    private $mysqlprt = '3306';
    private $postgresrv = "localhost";
    private $postgreusr = "postgres";
    private $postgresnh = "postgre";
    private $postgredb = "teste";
    private $postgreprt = '5432';
    private $tipo;
    protected $conexao;
    protected $retorno;
    
    public function __construct() {
        $this->setTipo("p");
    }
    
    protected function getTipo() {
        return $this->tipo;
    }
    
    private function setTipo($t){
        $this->tipo = $t;
    }
    
    protected function getRetorno(){
        return $this->retorno;
    }
    
    protected function setRetorno($s){
        $this->retorno = $s;
    }
    
    protected function getConexao() {
        return $this->conexao;
    }
    
    public function conectar(){
        if ($this->getTipo() == "m"){
            $this->cnxMySql();
        } elseif ($this->getTipo() == "p"){
            $this->cnxPostgre();
        } else {
            $this->setRetorno("Erro: Tipo de conexão desconhecido...");
        }
     }
    
    public function desconectar(){
        if ($this->getTipo() == "m"){
            $this->dcnxMySql();
        } elseif ($this->getTipo() == "p"){
            $this->dcnxPostgre();
        } else {
            $this->setRetorno("Erro: Tipo de conexão desconhecido...");
        }
     }
    
    private function cnxMySql(){
        $this->conexao = new mysqli("$this->mysqlsrv:$this->mysqlprt", "$this->mysqlusr", "$this->mysqlsnh", "$this->mysqldb");
        if (!$this->conexao) {
            $this->setRetorno(die('Não foi possível conectar: ' . mysqli_error()));
        } else {
            $this->setRetorno('Conectado com sucesso');
        }        
    }
    
    private function dcnxMySql(){
        mysqli_close($this->conexao);
        $this->setRetorno("Desconectado com sucesso");
    }
    
    private function cnxPostgre(){
        $this->conexao = pg_connect('host='.$this->postgresrv.' port='.$this->postgreprt.' dbname='.$this->postgredb.' user='.$this->postgreusr.' password='.$this->postgresnh);
        if (!$this->conexao) {
            $this->setRetorno(die("Não foi possível conectar: ".pg_last_error()));
        } else {
            $this->setRetorno("Conectado com sucesso");
        }
    }
    
    private function dcnxPostgre(){
        pg_close($this->conexao);
        $this->setRetorno("Desconectado com sucesso");
    }
}