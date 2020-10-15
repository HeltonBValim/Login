<?php
/*
@Autor Helton
Interface criada para criação das functions padrões
das classes que a implementam.
*/
interface iCrud {
    public function inserir($a, $b);
    public function deletar($s);
    public function alterar($a, $b);
    public function consultar($s);
}
