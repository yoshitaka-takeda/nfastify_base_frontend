<?php
declare(strict_types=1);

class Checkapi {
    public $api_host;
    public $api_port;
    private $current_protocol;
    private $api_is_secure;
    protected $api_url;
    public $status;

    /**
     * @__construct
     */

    public function __construct()
    {
        $this->current_protocol=$this->getProtocol($_SERVER);
        $this->api_is_secure=$this->isSecure();
        $this->api_host=$_ENV['NODE_API_HOST'];
        $this->api_port=($this->api_is_secure)?$_ENV['NODE_API_SECPORT']:$_ENV['NODE_API_PORT'];
        $this->status=$this->getStatus($this->current_protocol.$this->api_host.":".$this->api_port);
    }

    protected function getProtocol($__server=null) : string
    {
        if(isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        }
        else {
            $protocol = 'http://';
        }
        return $protocol;
    }

    public function getApiUrl()
    {
        $this->api_url = $this->current_protocol.$this->api_host.":".$this->api_port;
        return $this->api_url;
    }

    private function isSecure()
    {
        $__ret=0;

        if(isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $__ret =1;
        }
        else {
            $__ret;
        }
        return $__ret;
    }

    protected function getStatus($__remote_url=null)
    {
        $sts=false;
        if(!is_null($__remote_url)){
            $file_headers = @get_headers($__remote_url);
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                $sts;
            }else {
                $sts = true;
            }
        }
        return $sts;
    }

    public function accessProtocol()
    {
        return $this->current_protocol;
    }

    public function getApiPort()
    {
        return ':'.(($this->isSecure())?$_ENV['NODE_API_SECPORT']:$_ENV['NODE_API_PORT']);
    }

}