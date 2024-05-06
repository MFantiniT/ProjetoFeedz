<?php
class Feedback
{

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $feedback;
    private $status;
    private $id_usuario;
    private $id_feedback;
    private $data;
    private $img_perfil;


    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function getSobrenome()
    {
        return $this->sobrenome;
    }
    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getFeedback()
    {
        return $this->feedback;
    }
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getId_usuario()
    {
        return $this->id_usuario;
    }
    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }
    public function getId_feedback()
    {
        return $this->id_feedback;
    }
    public function setId_feedback($id_feedback)
    {
        $this->id_feedback = $id_feedback;
    }
    public function getData()
    {
        return $this->data;
    }
    public function setData($data)
    {
        $this->data = $data;
    }
    public function getImg_perfil()
    {
        return $this->img_perfil;
    }
    public function setImg_perfil($img_perfil)
    {
        $this->img_perfil = $img_perfil;
    }

    public function __construct($id, $nome, $sobrenome, $email, $feedback, $status, $id_usuario, $id_feedback, $data, $img_perfil)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->feedback = $feedback;
        $this->status = $status;
        $this->id_usuario = $id_usuario;
        $this->id_feedback = $id_feedback;
        $this->data = $data;
        $this->img_perfil = $img_perfil;
    }
}
interface I_feedbackDAO
{
    public function findAll(PDO $conn);
    public function create(Feedback $feedback, $conn);
    public function update(Feedback $feedback, $id, $conn);
    public function delete($id, $conn);
}