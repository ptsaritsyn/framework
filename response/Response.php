<?php

/**
 * Created by PhpStorm.
 * Date: 22.09.2016
 * Time: 9:32
 */

namespace Framework\Response;


class Response
{
    protected $headers = [];
    public $content = '';
    public $code;
    public $content_type = 'text/html';
    const STATUS_MESSAGE = [
        200 => 'OK!',
        201 => 'Created New',
        403 => 'Forbidden',
        404 => 'Not Found',
        301 => 'Moved Permanently',
        302 => 'My redirect',
        500 => 'Server Error'
    ];

    /**
     * sets the value of the header and content as a service
     * @param $data,
     * @param $code
     * @return object
     */
    public function add($data = null, $code = 200)
    {
        $this->code = $code;
        $this->setContent($data);
        $this->setHeader('Content-Type', $this->content_type);
        return $this;
    }
    
    /**
     * Send response
     */
    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
    }

    /**
     * generates headers to send
     */
    public function sendHeaders()
    {
        header("HTTP/1.1 ".$this->code." ".self::STATUS_MESSAGE[$this->code]);
        
        if(!empty($this->headers)){
            foreach($this->headers as $key=>$value){
                    header(sprintf('%s: %s', $key, $value));
            }
        }
    }

    /**
     * set headers
     * @param $header,
     * @param $value
     */
    public function setHeader($header, $value)
    {
        $this->headers[$header] = $value;
    }

    /**
     * outputs the content
     */
    public function sendContent()
    {
        echo $this->content;
    }

    /**
     * set content
     * @param $data,
     */
    public function setContent($data)
    {
        $this->content = $data;
    }

}
