<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;

class RegisterController extends ControllerBase
{
    public $__sess;
    const SESSNAME='auction_session';

    public function initialize()
    {
        if($this->session->has(SELF::SESSNAME)){
            $this->__sess=$this->session->get(SELF::SESSNAME);
        }else{
            $this->__sess=[];
        }
        $this->view->api_status=$this->__capi->status;
    }

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed before every found action
        // echo "<pre>";
        // print_r($this->__capi->status);
        // echo "</pre>";
        // $this->view->api_status=$this->__capi->status;
        
    }

    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed after every found action
    }

    public function indexAction()
    {
        $this->view->setLayoutsDir('layouts');
        $this->view->setMainView('layouts/base_register');

        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }

            if($this->request->isGet())
            {
                if($this->request->hasQuery('post_message')){
                    if($this->request->getQuery('post_message')=='submitted'){
                        $this->view->pick('register/submission');
                    }
    
                    if($this->request->getQuery('post_message')=='reviewrequest'){
                        $this->view->pick('register/review');
                    }
                }else{
                    //$this->view->disable();
                    echo "<pre>";
                    print_r($this->request->getHttpReferer());
                    echo "</pre>";
                    echo $this->request->getHttpReferer();
                }
            }

            if($this->request->isPost())
            {
                $this->view->disable();
                $__inputs=$this->request->getPost();
                
                print_r($__inputs);
                die;
                $this->dispatcher->forward([
                    'current_register' => $__inputs
                ]);
                $this->response->redirect(
                    $this->router->getControllerName().'?post_message=submitted'
                );
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }        
    }

}
