<?php

namespace LivrariaAdmin\Controller;
use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;
    
use LivrariaAdmin\Form\Categoria as FrmCategoria;
class CategoriasController extends AbstractActionController {
    //put your code here
    
    /**
     *
     * @var EntityManager 
     */
    protected  $em;


    public function indexAction() {
       $list = $this->getEm()->getRepository('Livraria\Entity\Categoria')->findAll();

       $page = $this->params()->fromRoute('page');
       
       $paginator =  new Paginator(new ArrayAdapter($list));
       $paginator->setCurrentPageNumber($page);
       $paginator->setDefaultItemCountPerPage(1);
       
       return new ViewModel(array('data' => $paginator, 'page' => $page));
       
       
    }
    
    public function newAction(){
        $form = new FrmCategoria();
        
        return new ViewModel(array('form' => $form));
        
    }

        /**
     * 
     * @return EntityManager
     */
    
    protected function getEm(){
        
        if(null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        return $this->em;
        
    }
}
