<?php
declare(strict_types=1);

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as LogStream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Logger\Exception as LogException;

class EncryptionVariables {
    private string $__key1;
    private string $__key2;
    private $capi;

    /**
     * 
     * @__construct
     */

    public function __construct()
    {
        $this->__key1=$_ENV['KEYPAIR1'];
        $this->capi=new Checkapi();
        $this->logger = $this->logger();

        echo "<pre>";
        print_r($this->logger);
        echo "</pre>";
        
    }

    /**
     * 
     * @logger
     */
    private function &logger()
    {
        $formatter = new Line();
        $formatter->setDateFormat('Y-m-d H:i:s O');
        $log_file = BASE_PATH . '/tmp/logs/mexception.log';

        if(!is_file($log_file)){
            //Some simple example content.
            $contents = '';
            //Save our content to the file.
            file_put_contents($log_file, $contents);
        }

        $adapter = new LogStream($log_file);
        $adapter->setFormatter($formatter);

        $elogger  = new Logger(
            'messages',
            [
                'main' => $adapter,
            ]
        );

        return $elogger;
    }

    /**
     *  
     * @getKey
     */
    protected function getKey()
    {
        return $this->__key1;
    }

    /**
     *  
     * @accessKey
     */
    public function accessKey()
    {
        return $this->getKey();
    }

    /**
     *  
     * @getPair
     */
    public function getPair($url=null)
    {
        $key2=null;
        if(is_null($url)){            
            $this->logger->log(LOGGER::WARNING,"getPair() message: API URL may not be null");
        }else{        
            try{    
                $ch = curl_init();
                curl_setopt_array($ch,[
                    CURLOPT_URL => $url,            
                    CURLOPT_HTTPHEADER => [
                        'X-Apple-Tz: 0',
                        'X-Apple-Store-Front: 143444,12',
                        'Pair: '.$_ENV['KEYPAIR1'],
                        'Keyword: '.$_ENV['KEYWORD'],
                        'Content-Type: application/json',
                        'Connection: keep-alive',
                        'Keep-Alive: timeout=5',
                        'Accept-Encoding: gzip, deflate, br'
                    ],
                    CURLOPT_CUSTOMREQUEST => 'OPTIONS',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_VERBOSE => true
                ]);
                $r = curl_exec($ch);
                // echo PHP_EOL.'Response Headers:'.PHP_EOL;
                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                // print_r($r);die;
                curl_close($ch);

                if($httpcode==200){
                    $key2=((object)(json_decode($r,true)))->key;
                }else if($httpcode==400){
                    $this->logger->log(LOGGER::ALERT,"getPair() message: ".$r);
                    $key2='';
                }else{
                    $this->logger->log(LOGGER::ALERT,"getPair() message: ".$r);
                    $key2='';
                }
            }catch(Exception $e){
                $this->logger->log(LOGGER::ALERT,"getPair() message: ".$r);
                exit(0);
            }
        }
        return $key2;
    }

    /**
     *  
     * @accessPair
     */
    public function accessPair($url=null)
    {
        return $this->getPair($url);
    }

}