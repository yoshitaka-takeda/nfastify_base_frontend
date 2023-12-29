<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;

class UserController extends ControllerBase
{
    public $__sess;
    public $__capi;
    const SESSNAME='auction_session';

    public function initialize()
    {
        if($this->session->has(SELF::SESSNAME)){
            $this->__sess=$this->session->get(SELF::SESSNAME);
        }else{
            $this->__sess=[];
        }

        $this->__users=new User("--id=9");
    }

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed before every found action
        // echo "<pre>";
        // print_r($this->__capi->status);
        // echo "</pre>";
        
        // if($this->session->has(self::SESSNAME)){
        //     $this->__sess=$this->session->get(self::SESSNAME);
        //     $props=['user','logged_in'];
        //     foreach($props as $prop){
        //         if(property_exists($this->__sess,$prop)){

        //         }else{
        //             $this->session->set('not_logged_in',(object)['status'=>1,'message'=>'Not Logged In',]);
        //             $this->response->redirect('/auth?op=login');
        //         }
        //     }
        // }
    }

    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed after every found action
        // if($this->session->has(self::SESSNAME)){
        //     $this->__sess=$this->session->get(self::SESSNAME);
        //     $props=['user','logged_in'];
        //     foreach($props as $prop){
        //         if(property_exists($this->__sess,$prop)){

        //         }else{
        //             $this->session->set('not_logged_in',(object)['status'=>1,'message'=>'Not Logged In',]);
        //             $this->response->redirect('/auth?op=login');
        //         }
        //     }
        // }
    }

    public function indexAction()
    {
        $this->response->redirect('user/manager');
    }

    public function newAction()
    {
        try{
            $this->view->hasRouteError=false;

            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }

            if($this->request->isGet()){

            }

            if($this->request->isPost()){
                $this->view->disable();

                echo "<pre>";
                print_r($this->request->getPost());
                echo "</pre>";
                echo "<pre>";
                print_r($this->__users);
                echo "</pre>";
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function disableAction()
    {
        try{
            $this->view->hasRouteError=false;

            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function editAction()
    {
        try{
            $this->view->hasRouteError=false;

            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e); 
        }
    }

    public function managerAction()
    {
        try{
            $this->view->hasRouteError=false;
            
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }

            if($this->request->isGet()){
                $datas = [];
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function pruneAction()
    {
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function requestAction()
    {
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function autoprune()
    {
        try{

        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

    public function aclAction($params1=null,$params2=null)
    {
        try{

            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }

            $__ext=[
                'add','edit','list'
            ];
            $found=false;
            if(in_array($params1,$__ext)){
                $found=true;
            }
            if($found){
                $this->view->pick($this->router->getControllerName().'/'.$this->router->getActionName().'/'.$params1);
            }else{
                $this->session->set('route_not_found',
                    '/'.$this->router->getControllerName().'/'.$this->router->getActionName().((!empty($params)?'/'.$params:'').' defaulting to list')
                );
                $this->response->redirect('/user/acl/list');
            }

            
            //$this->view->disable();
            // if($)
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }
    }

}