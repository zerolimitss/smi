<?php

class Admin extends Admin_Base
{
    protected $arr_logs;
    protected $category;
    protected function input($par = [])
    {
        parent::input();
        $this->arr_logs = file('admin-login.txt');
        $this->category = $this->obm_u->get_category();

        if(isset($par['exit'])){
            $data=time().'|['.$_SESSION['login'].']|'.$_SERVER['REMOTE_ADDR']."|Вышел"."\n";
            file_put_contents('admin-login.txt',$data,FILE_APPEND);
            unset($_SESSION['login']);
            redir_to(SITE_URL.'login');
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $form = new Form();
            $this->message = $form->message;
            $this->error=$form->error;
        }


    }

    protected function output()
    {

        $this->content = $this->render("admin/content",[
        'logs'=>$this->arr_logs,
            'error'=>$this->error,
            'message'=>$this->message,
            'category'=>$this->category
        ]);
        $this->page = parent::output();
    }
}