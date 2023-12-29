<?php
declare(strict_types=1);

use Phalcon\Mvc\Dispatcher;

class ApiController extends ControllerBase
{
    public $__sess;
    public $__capi;
    const SESSNAME='auction_session';

    public function initialize()
    {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
    }

    public function indexAction()
    {
        try{
            $response=parent::checkapi();

            // print_r($_SERVER);
            // die;

            $response=[
                'api-endpoint' => [
                    0 => $_ENV['NODE_API_PORT'],
                    1 => $_ENV['NODE_API_SECPORT']
                ],             
                'api-status' => $response,
                'request' => $this->request->getURI(),
                'server' => $_SERVER
            ];
            if (true !== $this->response->isSent()) {
                $this->response->setJsonContent($response, JSON_PRETTY_PRINT, 512)->send();
            }
        }catch(Exception $e){
            $this->elogger(LOGGER::CRITICAL,$e);
        }
    }

    public function getkeyAction()
    {
        try{
            
            
        }catch(Exception $e){

        }

        
    }

}