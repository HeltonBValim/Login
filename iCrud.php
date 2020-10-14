<?php
/**
* @Autor Helton
*/
interface iCrud {
    public function inserir($a, $b);
    public function deletar($s);
    public function alterar($a, $b);
    public function consultar($s);
}
