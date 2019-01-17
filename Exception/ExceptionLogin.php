<?php
/**
 * Created by PhpStorm.
 * Date: 04.11.2016
 * Time: 8:51
 */

namespace Framework\Exception;
use Framework\View\Render;
use Framework\Response\Response;


class ExceptionLogin extends \Exception
{
    public function __construct($message = '')
    {
        parent::__construct($message);
        Render::$error = $message;
        $buffer = Render::view('admin_error.template.php');
        $response = new Response();
        return $response->add($buffer);
    }
}
