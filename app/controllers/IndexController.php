<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;

class IndexController extends ControllerBase
{
    public $__sess;
    public $__capi;
    const SESSNAME='auction_session';

    public function initialize()
    {
        // if($this->session->has(SELF::SESSNAME)){
        //     $this->__sess=$this->session->get(SELF::SESSNAME);
        // }else{
        //     $this->__sess=[];
        // }

        //print_r($this->__capi);
        $this->view->api_status=$this->__capi->status;
    }

    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed before every found action
        // echo "<pre>";
        // print_r($this->__capi->status);
        // echo "</pre>";
        // $this->view->disable();

        // $response=$this->__capi->status;
        // if (true !== $this->response->isSent()) {
        //      $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
        // }
        // if(!$this->__capi->status){
        //     $this->response->redirect('/');
        // }

        // echo ($this->session->has(self::SESSNAME))?"true":"false";
        if($this->session->has(self::SESSNAME)){
            $this->__sess=$this->session->get(self::SESSNAME);
            $props=['user','logged_in'];
            foreach($props as $prop){
                if(property_exists($this->__sess,$prop)){

                }else{
                    //$this->session->set('not_logged_in',(object)['status'=>1,'message'=>'Not Logged In',]);
                    //$this->response->redirect('/auth?op=login');
                }
            }
        }
    }

    public function afterExecuteRoute(Dispatcher $dispatcher)
    {
        // Executed after every found action
        // if(!$this->__capi->status){
        //     $this->view->setMainView('layouts/down');
        //     $this->view->pick('index/engine_down');
        // }

        // echo ($this->session->has(self::SESSNAME))?"true":"false";
        if($this->session->has(self::SESSNAME)){
            $this->__sess=$this->session->get(self::SESSNAME);
            $props=['user','logged_in'];
            foreach($props as $prop){
                if(property_exists($this->__sess,$prop)){

                }else{
                    //$this->response->redirect('/auth?op=login');
                }
            }
        }
    }

    // public function checkapiAction()
    // {
    //     parent::checkapi();
    // }

    public function indexAction()
    {
        try{
            if($this->request->isGet())
            {
                if($this->request->hasQuery('op'))
                {
                    $this->view->disable();
                    $uiresponse=false;
                    $backendresponse=false;
                    $_op=$this->request->getQuery('op');
                    switch($_op){
                        case 'ui-running': 
                            $response = true;
                            $uiresponse = $response;
                            break;
                        case 'backend-running':
                            $response = false;
                            $backendresponse = $response;
                            break;
                        case 'checkapi':
                            $response=parent::checkapi();
                            if (true !== $this->response->isSent()) {
                                $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
                            }
                            break;
                    }


                    if($uiresponse && $backendresponse){
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
                        if(!$__flag){
                            $this->response->redirect(
                                'auth?op=login'
                            );
                        }else{
                            $this->response->redirect(
                                'dashboard'
                            );
                        }
                    }else if($uiresponse || $backendresponse){
                        if($uiresponse){
                            if (true !== $this->response->isSent()) {
                                $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
                            }
                            $this->response->redirect(
                                '?op=backend-running&return=json'
                            );
                        }else{
                            $this->response->redirect(
                                '?op=backend-running&return=json'
                            );
                        }
                    
                        if($backendresponse){

                        }else{
                            if($this->request->hasQuery('return')&&$this->request->getQuery('return')==='json'){
                                $response=[
                                    'status' => -1,
                                    'message' => 'engine down',
                                ];
                                if (true !== $this->response->isSent()) {
                                    $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
                                }
                            }else{
                                $this->view->pick('index/engine_down');
                            }
                        }
                    }
                }else{
                    $backendresponse=$this->__capi->status;
                    
                    if($backendresponse){
                        $this->response->redirect(
                            'auth?op=login'
                        );
                    }else{
                        $this->view->setMainView('layouts/down');
                        $this->view->pick('index/engine_down');
                    }
                }
            }

            if($this->request->isPost()||$this->request->isPut()||$this->request->isPatch()||
                $this->request->isPurge()||$this->request->isDelete()||$this->request->isOptions())
            {
                $this->view->disable();

                $rawBody=$this->request->getJsonRawBody();
                $response=[
                    'method'=>[
                        'CONNECT' => ($this->request->isConnect())?"true":"false",
                        'DELETE' => ($this->request->isDelete())?"true":"false",
                        'GET' => ($this->request->isGet())?"true":"false",
                        'HEAD' => ($this->request->isHead())?"true":"false",
                        'OPTIONS' => ($this->request->isOptions())?"true":"false",
                        'PATCH' => ($this->request->isPatch())?"true":"false",
                        'POST' => ($this->request->isPost())?"true":"false",
                        'PURGE' => ($this->request->isPurge())?"true":"false",
                        'PUT' => ($this->request->isPut())?"true":"false",
                        'TRACE' => ($this->request->isTrace())?"true":"false"
                    ]
                ];

                if($this->request->isPut()){
                    $response['checkhead']=$this->request->getHeaders();
                    $response['Json']=$rawBody;
                }

                
                if (true !== $this->response->isSent()) {
                    $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
                }
            }
        }catch(\Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
            // if (true !== $this->response->isSent()) {
            //     $this->response->setJsonContent($e, JSON_PRETTY_PRINT, 512)->send();
            // }
        }
        
    }

}
