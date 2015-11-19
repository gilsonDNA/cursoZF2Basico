<?php

namespace Livraria\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Livraria\Entity\UserRepository")
 */
class User {
    
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $password;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salt;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getSalt() {
        return $this->salt;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    function setPassword($password) {
        
        $hashSenha = $this->encryptPassword($password);
        
        $this->password = $hashSenha;
        return $this;
    }

    public function encryptPassword($password){
        $hashSenha = hash('sha512', $password.$this->salt);
        for($i = 0; $i< 64000; $i++){
            $hashSenha = hash('sha512', $hashSenha);
        }
        
        return $hashSenha;
    }
            
    function setSalt($salt) {
        $this->salt = $salt;
        return $this;
    }


    public function toArray(){
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'salt' => $this->salt
           
        );
    }

   

    public function __construct($options = null) {
        
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        Configurator::configure($this, $options);
    }
}
