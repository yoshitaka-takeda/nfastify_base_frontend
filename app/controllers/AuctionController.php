<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;

class AuctionController extends ControllerBase
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
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
            $__current_acl='user';
            if($__current_acl=='user'){
                $this->view->pick('auction/auction_client');
            }else{

            }
        }catch(Exception $e){

        }
    }

    public function addentryAction()
    {
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
            
        }catch(Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
        }
    }

    public function editentryAction()
    {
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
        }
    }

    public function entryAction()
    {
        try{
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError=$this->session->has('route_not_found');
                $this->view->message=$this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
        }catch(Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
        }
    }

}