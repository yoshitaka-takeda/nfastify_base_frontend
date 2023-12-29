<?php
declare(strict_types=1);

use Phalcon\Escaper;
use Phalcon\Flash\Session as FlashSession;
use Phalcon\Mvc\Dispatcher;

class AuthController extends ControllerBase
{
    public $__sess;
    const SESSNAME='auction_session';

    public function initialize()
    {
        $this->view->setMainView('layouts/base_login');
        if($this->session->has(SELF::SESSNAME)){
            $this->__sess=$this->session->get(SELF::SESSNAME);
        }else{
            $this->__sess=[];
        }

        //$this->view->disable();
        $this->view->api_status=$this->__capi->status;
    }

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed before every found action
        // echo "<pre>";
        // print_r($this->__capi->status);
        // echo "</pre>";
        
        if(!$this->__capi->status){
            $this->view->setMainView('layouts/down');
            $this->view->pick('index/engine_down');
            // $this->response->redirect('/');
        }
    }

    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed after every found action
        if(!$this->__capi->status){
            $this->view->setMainView('layouts/down');
            $this->view->pick('index/engine_down');
            // $this->response->redirect('/');
        }
    }

    public function indexAction()
    {
        try{
            $props=[
                'user',
            ];
            $__flag;
            foreach($props as $prop){
                if(property_exists($this->__sess,$prop)){
                    $__flag=true;
                }else{
                    $__flag=false;
                }
            }

            print_r($__flag);
            if(!$__flag){
                $ops=$this->request->getQuery('op');
                if(!empty($ops))
                {
                    switch($ops){
                        // case "checkapi":
                        //     $response=parent::checkapi();
                        //     if (true !== $this->response->isSent()) {
                        //         $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
                        //     }
                        //     break;
                        case "login": 
                            $this->response->redirect(
                                $this->router->getControllerName().'/login'
                            );
                            break;
                        case "logout":
                            $this->session->destroy();
                            $this->response->redirect(
                                $this->router->getControllerName().'/login'
                            );
                            break;
                    }
                }else{
                    $this->response->redirect('/');
                }
            }else{
                $this->response->redirect(
                    'dashboard'
                );
            }
        }catch(\Exception $e){

        }
        

    }

    public function loginAction()
    {
        try{
            $props=[
                'user',
            ];
            $__flag;
            foreach($props as $prop){
                if(property_exists($this->__sess,$prop)){
                    $__flag=true;
                }else{
                    $__flag=false;
                }
            }
            
            if(!$__flag)
            {
                $__encr=new Encryption();
                if($this->request->isGet()){
                    $hasError=0;
                    $hasRouteError=0;
                    // print_r($this->session->has('auth_error'));
                    //$this->view->disable();
                    if($this->session->has('auth_error')){
                        $hasError=$this->session->get('auth_error')->status;                    
                        $this->view->message=$this->session->get('auth_error')->message;
                        $this->session->remove('auth_error');
                    }

                    if($this->session->has('auth_user_not_found_message')){
                        $hasError=$this->session->has('auth_user_not_found_message');
                        $this->view->message=$this->session->get('auth_user_not_found_message');
                        $this->session->remove('auth_user_not_found_message');
                    }

                    if($this->session->has('not_logged_in')){
                        $hasError=$this->session->get('not_logged_in')->status;
                        $this->view->message=$this->session->get('not_logged_in')->message;
                        $this->session->remove('not_logged_in');
                    }

                    if($this->session->has('route_not_found')){
                        $this->view->hasRouteError=$this->session->has('route_not_found');
                        $this->view->message=$this->session->get('route_not_found');
                        $this->session->remove('route_not_found');
                    }

                    $this->view->hasError=($hasError)?:0;
                    // $this->view->hasRouteError=($hasRouteError)?:0;                               
                }else if($this->request->isPost()){
                    $__continue=false;
                    
                    if ($this->security->checkToken()) {
                        $__continue=true;
                    }
                    
                    if($__continue){
                        $this->view->disable();
                        $__post=$this->request->getPost();
                        if(!empty($__post['inputEmail'])||!empty($__post['inputPassword']))
                        {
                            echo "<pre>";
                            print_r($__post);
                            echo "</pre>";
                            //$__post['inputEmail']=$__encr->crypter('e',$__post['inputEmail']);
                            //$__post['inputPassword']=$__encr->crypter('e',$__post['inputPassword']);
                            echo "<pre>";
                            print_r($__post);
                            echo "</pre>";
                            echo "<pre>";
                            print_r($_ENV['KEYPAIR1']);
                            echo "</pre>";
                            echo "<pre>";
                            print_r($_ENV['KEYPAIR2']);
                            echo "</pre>";
                            $x=$__encr->crypter('d',$__post['inputEmail']);
                            echo "<pre>";
                            print_r($x);
                            echo "</pre>";
                           
                            $auth=false;
                            //$this->view->disable();
                            if(property_exists($this->__sess,'user')){
                                $auth=true;
                            }else{
                                $this->session->set('auth_error',(object)
                                    [
                                        'status' => true,
                                        'message' => 'Something went wrong.'
                                    ]);
                                //$this->session->set('auth_error',true);
                            }
                            if($auth){
                                $path=$this->response->redirect(
                                    'dashboard'
                                );
                            }else{
                                // $this->session->set('auth_error_message','Something went wrong');
                                // $this->session->set('auth_error',true);
                                $path=$this->response->redirect(
                                    'auth/login'
                                );                                    
                            }
                        }else{
                           
                            $path=$this->response->redirect(
                                '/'
                            );
                        }
                    }else{
                        $path=$this->response->redirect(
                            'auth?op=login'
                        );
                    }
                }else{
                    $path=$this->response->redirect(
                        '/'
                    );
                }    
            }else{
                $path=$this->response->redirect(
                    'dashboard'
                );
            }
        }catch(Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
        }
        $path;
    }

}

