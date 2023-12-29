<?php
declare(strict_types=1);

use Phalcon\Logger;
use Phalcon\Logger\Adapter\Stream as LogStream;
use Phalcon\Logger\Formatter\Line;
use Phalcon\Logger\Exception as LogException;

class Encryption extends \Phalcon\Mvc\Model {
    private string $__key1;
    private string $__key2;
    const AES_METHOD = 'aes-256-cbc';
    const IV_LENGTH = 16;
    private $capi;
    private $enc_var;
    private $iv;
    private $keyhash;
    private $logger;
    private $password;    

    public function onConstruct()
    {
        $this->logger = $this->logger();

        // echo "<pre>";
        // print_r($this->logger);
        // echo "</pre>";
        // die;
        try{
            $this->capi = new Checkapi;
            $this->enc_var = new EncryptionVariables;
            $this->iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
            $this->__key1 = $this->enc_var->accessKey();
            if($this->capi->status){
                try{
                    $this->__key2 = $this->enc_var->accessPair($this->getApiUrl());
                }catch(Exception $e){
                    $this->logger->log(LOGGER::ALERT,"Construct->__key2 message: ".((object)(json_decode($r,true)))->message);
                }
            }            
            $this->password='';
            $this->keyhash='';
        }catch(Exception $e){
            $this->logger->log(LOGGER::ALERT,"Construct message: ".((object)(json_decode($r,true)))->message);
        }
    }

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

    public function getPair($url=null)
    {
        $key2=null;
        // $cap=new Checkapi();
        // $url = $cap->accessProtocol().$_ENV['APP_HOST'].$cap->getApiPort().'/api/getkey';
        if(is_null($url)){            
            $this->logger->log(LOGGER::WARNING,"getPair() message: API URL may not be null");
        }else{            
            $ch = curl_init();
            curl_setopt_array($ch,[
                CURLOPT_URL => $url,            
                CURLOPT_HTTPHEADER => [
                    'X-Apple-Tz: 0',
                    'X-Apple-Store-Front: 143444,12',
                    // 'Pair: '.$_ENV['KEYPAIR1'],
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
            curl_close($ch);

            if($httpcode===200){
                $key2=((object)(json_decode($r,true)))->key;
            }else if($httpcode===400){
                $this->logger->log(LOGGER::ALERT,"getPair() message: ".((object)(json_decode($r,true)))->message);
            }
        }
        return $key2;
    }

    public function crypter($mode=null,$input=null)
    {
        try{
            $output='';
            //$this->fillKeyhash();
            //print_r(base64_decode($this->getPassword(),true));
            //die;
            $password = '3sc3RLrpd17';
            
            $key = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
            
            switch($mode)
            {
                case 'd':
                    if(!is_null($input))
                    {                        
                        $decoded=base64_decode($input);                        
                        
                        $output=openssl_decrypt($decoded, self::AES_METHOD, $key, OPENSSL_RAW_DATA, $this->iv);
                        
                    }else{
                        $this->logger->log(LOGGER::INFO,'Decryption input may not be null');
                    }
                    break;
                case 'e':
                    if(!is_null($input))
                    {
                        $encr=openssl_encrypt($input, self::AES_METHOD, $key, OPENSSL_RAW_DATA, $this->iv);
                        $output=base64_encode($encr);
                    }else{
                        $this->logger->log(LOGGER::INFO,'Encryption input may not be null');
                    }
                    break;
                default:
                    $this->logger->log(LOGGER::CRITICAL,"crypter() message: Huh??? '".$mode."' option?");
                    break;
            }
        }catch(Exception $e){
            $this->logger->log(LOGGER::CRITICAL,$e);
        }

        return $output;
    }

    public function getApiUrl()
    {
        return $this->capi->accessProtocol().$_ENV['APP_HOST'].$this->capi->getApiPort().'/api/getkey';
    }

    public function getPassword()
    {
        return $this->password.$this->__key1.$this->__key2;
    }

    public function fillKeyhash()
    {
        $this->keyhash = password_hash(base64_decode($this->getPassword(),true),PASSWORD_BCRYPT,['cost' => 12]);
    }

}