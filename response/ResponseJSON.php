<?php
/**
 * Created by PhpStorm.
 * Date: 22.09.2016
 * Time: 9:40
 */

namespace Framework\Response;


class ResponseJSON extends Response
{
    public $content_type = 'application/json';

    /**
     * this method add content and headers in JSON format
     *
     * @param $data
     * @param $code
     * @return object
     */
    public function addJson($data = null, $code = 200){
        $this->code = $code;
        $this->setContent($data);
        $this->setHeader('Content-type: ', $this->content_type);
        return $this;
    }

    /**
     * packs content in a format json
     * @param $data
     */
    public function setContent($data)
    {
        $this->content = json_encode($data);
    }

}
