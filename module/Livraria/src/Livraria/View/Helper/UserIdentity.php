<?php

namespace Livraria\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;



class UserIdentity extends AbstractHelper{
   
    protected $autoService;
    
    public function getAuthService(){
        return $this->authService;
    }
    
    public function __invoke($namespace = null){
        
        $sessionStorage = new SessionStorage("$namespace");
        $this->autoService = new AuthenticationService;
        $this->autoService->setStorage($sessionStorage);
        
        if($this->getAuthService()->hasIdentity()){
            return $this->getAuthService()->getIdentity();
        }else{
            return false;
        }
        
    }
}
