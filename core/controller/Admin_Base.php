<?php

abstract class Admin_Base extends Base
{
    protected $header;
    protected $left_bar;
    protected $content;
    protected $footer;

    protected $obm_u;
    protected $title;
    protected $styles;
    protected $scripts;
    protected $user = true;
    protected $error;
    protected $message;

    protected function input($par = [])
    {
        session_start();
        if($this->user) $this->check_auth();
        $this->obm_u = Model_User::get_instance();

        $this->title = TITLE." / ADMIN / ";

        global $header_sts;
        if(isset($header_sts['styles-admin'])) {
            foreach ($header_sts['styles-admin'] as $v) {
                $this->styles[] = SITE_URL . VIEW . 'admin/'.$v;
            }
        }
        if(isset($header_sts['scripts-admin'])) {
            foreach ($header_sts['scripts-admin'] as $v) {
                $this->scripts[] = SITE_URL . VIEW . 'admin/'.$v;
            }
        }

    }

    protected function output()
    {
        $this->header = $this->render("admin/header",[
            'title'=>$this->title,
            'styles'=>$this->styles,
            'scripts'=>$this->scripts
        ]);

        if($this->user)
            $this->left_bar = $this->render("admin/leftbar");
        else
            $this->left_bar = $this->render("admin/leftbar1");

        $this->footer = $this->render("admin/footer");

        $page = $this->render("admin/admin",[
            "header"=>$this->header,
            "leftbar"=>$this->left_bar,
            "content"=>$this->content,
            "footer"=>$this->footer
        ]);

        return $page;
    }

    protected function check_auth()
    {
        if(!isset($_SESSION['login'])){
            redir_to(SITE_URL.'login');
        }
    }

}