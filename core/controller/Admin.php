<?php

class Admin extends Admin_Base
{
    protected $arr_logs;
    protected $category;
    protected function input($par = [])
    {
        parent::input();
        if(file_exists('admin-login.txt')){
            $temp = file('admin-login.txt');
            for ($i=count($temp)-1;$i>=0;$i--) {
                $this->arr_logs[] =  $temp[$i];
            }
            if(count($this->arr_logs)>5){
                for($i=5;$i<count($this->arr_logs);$i++){
                    if(isset($this->arr_logs[$i]))
                        unset($this->arr_logs[$i]);
                }
            }
        }

        $this->category = $this->obm_u->get_category();

        if(isset($par['exit'])){
            $data=time().'|['.$_SESSION['login'].']|'.$_SERVER['REMOTE_ADDR']."|Вышел"."\n";
            file_put_contents('admin-login.txt',$data,FILE_APPEND);
            unset($_SESSION['login']);
            Utilities::redir_to(SITE_URL.'login');
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