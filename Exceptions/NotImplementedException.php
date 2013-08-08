<?php
namespace iMVC\Exceptions;
require_once 'AppException.php';
class NotImplementedException extends AppException
{
    private $stack_trace;

    public function __construct($message, $code, $previous) {
        parent::__construct($message, $code, $previous);
        $this->SendErrorCode("501 Not Implemented.");
    }
    private $error_code;

    public function SendErrorCode($code = NULL)
    {
        if($code)
            $this->error_code = $code;
        if(!headers_sent ())
        {
            header('HTTP/1.1 '.$this->error_code);
            return true;
        }
        return false;
    }

    public function GetErrorCode(){return $this->error_code;}
    public function GetErrorTraceAsString(){return $this->stack_trace;}
}
