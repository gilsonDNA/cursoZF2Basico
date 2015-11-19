<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Livraria\Entity\Configurator;

class Livro extends AbstractService {
    
    public function __construct(\Doctrine\ORM\EntityManager $em) {
        parent::__construct($em);
        $this->entity = "Livraria\Entity\Livro";
    }
    
    public function insert(array $data) {
        
        $categoriaId = $data['categoria'];
        unset($data['categoria']);
       
        $entity = new $this->entity($data);
         
        $categoria = $this->em->getReference("Livraria\Entity\Categoria", $categoriaId);
        $entity->setCategoria($categoria);
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
    }
    
    
    public function update(array $data) {
        
        $entity =  $this->em->getReference($this->entity, $data['id']);
        
        $categoria = $this->em->getReference("Livraria\Entity\Categoria", $data['categoria']);
        $entity->setCategoria($categoria);
        
        $this->em->persist($entity);
        $this->em->flush();
        
        return $entity;
    }
}
