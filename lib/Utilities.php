<?php

class Utilities
{
    public static function dateMain($str,$t=false)
    {
        $d = strftime(" %d ", $str);
        if(strpos($d,'0')==1){
            $d = substr($d, 2,1);
        }
        $y = strftime(" %Y", $str);
        $m = strftime("%B", $str);
        $m = substr($m,0,-2);
        if($m==='Мар' || $m==='Авгус'){
            $m=$m.'та';
        }elseif($m==='Ма'){
            $m=$m.'я';
        }else{
            $m=$m.'я';
        }
        if($t){
            $time = strftime("%H:%M, ", $str);
            return $time.$d." ".$m.$y;
        }
        return $d." ".$m.$y;
    }
    public static function today($str)
    {
        $dn=date("d",time());
        $dd=date("d", $str)+1;
        if(date("dmy", $str)==date("dmy",time())){
            return 'Сегодня';
        }elseif($dn==$dd && date("my", $str)==date("my",time())){
            return 'Вчера';
        }
        else{
            return Utilities::dateMain($str);
        }
    }
    public static function active($a,$b)
    {
        if($a==$b){
            return " class=\"active\"";
        }else{
            return "";
        }
    }
    public static function redir_to($str)
    {
        header("Location: ".$str);
        exit;
    }
    public static function errorOrMessage($error="",$message=""){
        $string="";
        if($error != ""){
            $string .="<ul class=\"errormes\">"."\n";
            foreach ($error as $e) {
                $string.="<li>{$e}</li>"."\n";
            }
            $string .= "</ul>"."\n";
        }
        if($message != "") {
            $string .= "<p class=\"message\">{$message}</p>"."\n";
        }
        return $string;
    }
}