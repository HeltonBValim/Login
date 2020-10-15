<?php
/*
 @Autor : HeltonBValim
 Classe para conexões com os bancos-de-dados MySql e PostgreSql
 Outros bancos podem ser adicionados. O código ou sigla do banco pode
 ser informado no construtor da classe, visto que será usado
 apenas um BD por vez (neste sistema).
 */
class Conexoes {
    /*Parâmetro "Tipo de conexão" passado no construtor da classe:
     *  m -> MySql;
     *  p -> PostgreSql.
    */
    #Dados para conexão com o MySql
    private $mysqlsrv = "localhost"; #Nome do servidor ou IP.
    private $mysqlusr = "mestre"; #Usuário padrão com acesso ao banco.
    private $mysqlsnh = "dono"; #Senha do usuário padrão.
    private $mysqldb = "teste"; #Banco de dados no servidor que será usado pela aplicação.
    private $mysqlprt = '3306'; #Porta utilizada pelo serviço do banco de dados.
    #Dados para conexão com o PostgreSql
    private $postgresrv = "localhost"; #nome do servidor ou IP
    private $postgreusr = "postgres"; #Usuário padrão com acesso ao banco.
    private $postgresnh = "postgre"; #Senha do usuário padrão.
    private $postgredb = "teste"; #Banco de dados no servidor que será usado pela aplicação.
    private $postgreprt = '5432'; #Porta utilizada pelo serviço do banco de dados.
    /*Os dados de conexão podem, e eventualmente irão, variar de acordo com o banco.
    Contudo deve-se observar que o nome das tabelas, bem como os nomes, parâmetros e conteúdos
    das storages procedures devem ser mantidos, caso contrário, todo o fonte deverá ser revisado.*/
    /*O fonte pode ser modificado/aperfeiçoado para conexões a múltiplos BD´s quando aplicável.
    Por exemplo:
    Usuários no BD de retaguarda no PostgreSql e
    Compras no BD de caixa no Firebird.*/
    private $tipo;
    protected $conexao;
    protected $retorno;
    
    public function __construct() {
        $this->setTipo("p"); #Define o tipo do banco que será usado pela aplicação.
    }
    
    public function getTipo() {
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
    
    public function conectar($simnao){
        /*Chama a function para conexão de acordo com o tipo de BD,
        informando se a conexão será efetuada (true) ou finalizada (false).*/
        if ($this->getTipo() == "m"){
            $this->cnxMySql($simnao);
        } elseif ($this->getTipo() == "p"){
            $this->cnxPostgre($simnao);
        } else {
            $this->setRetorno("Erro: Tipo de conexão desconhecido...");
        }
     }
    
    private function cnxMySql($simnao){
        /*Conexão do MySql
        Se o parâmetro for 'true' inicia uma conexão.
        caso contrário fecha a conexão ativa.*/
        if ($simnao){
            $this->conexao = new mysqli("$this->mysqlsrv:$this->mysqlprt", "$this->mysqlusr", "$this->mysqlsnh", "$this->mysqldb");
            if (!$this->conexao) {
                $this->setRetorno(die('Não foi possível conectar: ' . mysqli_error()));
            } else {
                $this->setRetorno('Conectado com sucesso');
            }            
        } else {
            mysqli_close($this->conexao);
            $this->setRetorno("Desconectado com sucesso");
        }
    }
    
    private function cnxPostgre($simnao){
        /*Conexão do PostgreSql
        Se o parâmetro for 'true' inicia uma conexão.
        caso contrário fecha a conexão ativa.*/
        if ($simnao){
            $this->conexao = pg_connect('host='.$this->postgresrv.' port='.$this->postgreprt.' dbname='.$this->postgredb.' user='.$this->postgreusr.' password='.$this->postgresnh);
            if (!$this->conexao) {
                $this->setRetorno(die("Não foi possível conectar: ".pg_last_error()));
            } else {
                $this->setRetorno("Conectado com sucesso");
            }            
        } else {
            pg_close($this->conexao);
            $this->setRetorno("Desconectado com sucesso");
        }
    }
}