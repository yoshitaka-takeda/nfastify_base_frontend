<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;
use Phalcon\{
    Logger
};

class DashboardController extends ControllerBase
{
    public $__sess;
    public $__capi;
    const SESSNAME='auction_session';

    public function initialize()
    {
        // if($this->session->has(SELF::SESSNAME)){
        //     $this->__sess=$this->session->get(self::SESSNAME);
        // }else{
        //     $this->__sess=[];
        // }

        //$this->view->disable();
        $this->view->api_status=$this->__capi->status;
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
        //$this->view->disable();
        // echo "<pre>";
        // print_r($this->session->has('route_not_found'));
        // echo "</pre>";
        // echo "<pre>";
        // print_r(($this->session->has('auction_sessions'))?:"0");
        // echo "</pre>";
        // echo "<pre>";
        // $__sess=(object)[
        //     "__id"=>$this->session->getId(),
        //     "username"=>$_ENV['KEYPAIR1']."Entah".$_ENV['KEYPAIR2'],
        // ];
        // print_r($this->session->set('auction_sessions',$__sess));
        // echo "</pre>";
        // echo "<pre>";
        // print_r(($this->session->has('auction_sessions'))?:"0");
        // echo "</pre>";
        // echo "<pre>";
        // print_r($this->session->get('auction_sessions'));
        // echo "</pre>";
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";
        try{
            $this->view->hasRouteError=false;
            if($this->session->has('route_not_found')){
                $this->view->hasRouteError = $this->session->has('route_not_found');
                $this->view->message = $this->session->get('route_not_found');
                $this->session->remove('route_not_found');
            }
            $encr=new Encryption;
            $this->view->vx = $encr->crypter('e','My secret message 1234');
            $this->view->vy = $encr->crypter('d',$this->view->vx);
        }catch(Exception $e){
            $this->exception_logger->log(LOGGER::CRITICAL,$e);
        }
    }

}

