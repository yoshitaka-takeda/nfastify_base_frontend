<?php
declare(strict_types=1);

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as LogStream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Logger\Exception as LogException;

class User extends \Phalcon\Mvc\Model {
    protected $getUser;
    protected $listUsers;
    protected $storeUsers;
    protected $updateUsers;
    protected $user;

    public function onConstruct($params=null)
    {
        $init;
        if(is_array($params)){
            $init=$params;
        }
        $id=1;
        $this->user=[];
        $this->getUser = $this->getUser($id);
        $this->listUsers = $this->listUsers();
        $this->storeUsers = $this->storeUsers();
        $this->updateUsers = $this->updateUsers();
    }

    protected function getUser($id=null) : User
    {
        try{
            $__capi = new Checkapi();
            $urls=$__capi->getApiUrl().'/accessUser?id='.$id;
            echo $urls;
            $ch = curl_init($urls);
            curl_setopt_array($ch, [

            ]);
            $response = curl_exec($ch);

            echo "<pre>";
            print_r($response);
            echo "</pre>";
            
            curl_close($ch);
            echo $id;
            $this->user = $response;

        }catch(Exception $exception){
            throw $exception;
            exit(1);
        }

        return $this;
    }

    protected function listUsers($params=null) : array
    {
        return [];
    }

    protected function storeUsers($params=null) : User
    {
        return $this;
    }

    protected function updateUsers($params=null) : User
    {
        return $this;
    }

}