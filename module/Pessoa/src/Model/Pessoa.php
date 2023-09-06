<?php 

namespace Pessoa\Model;

class Pessoa{
    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $situacao;


    public function exchangeArray(array $data){
        $this->id = !empty($data['id']) ? $data['id'] : NULL;
        $this->nome = !empty($data['nome']) ? $data['nome'] : NULL;
        $this->sobrenome = !empty($data['sobrenome']) ? $data['sobrenome'] : NULL;
        $this->email = !empty($data['email']) ? $data['email'] : NULL;
        $this->situacao = !empty($data['situacao']) ? $data['situacao'] : NULL;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getSobrenome(){
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome){
        $this->sobrenome = $sobrenome;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getSituacao(){
        return $this->situacao;
    }

    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }


}