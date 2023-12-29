<?php
declare(strict_types=1);

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
    // Implement common logic
    public function onConstruct()
    {
        $this->session->set('auction_session',(object)[]);

        $this->__capi=new Checkapi();
    }

    public function initialize()
    {
        if(!$this->session->has('auction_session')){
            echo "borrfff";
        }else{
            echo "wooo";
        }
    }

    public function checkapi()
    {
        return $response=$this->__capi->status;
    }

}
