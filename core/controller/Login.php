<?php

/**
 * Created by PhpStorm.
 * User: Prime1
 * Date: 13.02.2016
 * Time: 10:15
 */
class Login extends Admin_Base
{
    protected $error;
    protected $user = false;

    protected function input($par = [])
    {
        parent::input();

        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(empty($_POST['login']) || empty($_POST['pass'])) {
                $this->error = "Заполните все поля ";
                return;
            }

            $login = $this->clear_str($_POST['login']);
            $pass = $this->clear_str($_POST['pass']);

            if($this->obm_u->check_login($login, $pass)){
                $_SESSION['login']=$login;
                $data=time().'|['.$login.']|'.$_SERVER['REMOTE_ADDR']."|Зашел"."\n";
                file_put_contents('admin-login.txt',$data,FILE_APPEND);
                Utilities::redir_to(SITE_URL."admin");
            }else{
                $data=time().'|['.$login.'='.$pass.']|'.$_SERVER['REMOTE_ADDR']."|Ошибка входа"."\n";
                file_put_contents('admin-login.txt',$data,FILE_APPEND);
                $this->error = "Ошибка логина/пароля";
            }
        }


    }

    protected function output()
    {
        $this->content = $this->render("admin/login",[
            'error'=>$this->error
        ]);
        $this->page = parent::output();
    }
}