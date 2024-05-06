<?php
class User
{
    private $nome;
    private $sobrenome;
    private $email;
    private $senha;
    private $empresa;
    private $img;
    public function getNome(){
        echo $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getSobrenome(){
        echo $this->sobrenome;
    }
    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }
    public function getEmail(){
        echo $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    public function getSenha(){
        echo $this->senha;
    }
    public function setSenha($senha){
        $this->senha = $senha;
    }
    public function getEmpresa(){
        echo $this->empresa;
    }
    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
    public function getImg(){
        echo $this->img;
    }
    public function setImg($img){
        $this->img = $img;
    }
    public function __construct($nome, $sobrenome, $email, $senha, $empresa, $img)
    {
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->senha = $senha;
        $this->empresa = $empresa;
        $this->img = $img;
    }

}
