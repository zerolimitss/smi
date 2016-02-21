<?php

class EException extends Exception
{
    protected $message;


    public function __construct($m, $path = false)
    {
        $file = $this->getFile();
        $line = $this->getLine();

        $str = date("h:i d-m-Y")." ".$m." ".$path." ".$file." Строка:".$line."\n";

        file_put_contents('error.txt',$str,FILE_APPEND);

        header("Location: ".SITE_URL."Error/mes/".urlencode($m));
    }
}