<?php

class Edit extends Admin_Base
{
    private $post;
    private $category;
    private $subcatid;
    private $subcatarray;
    private $post_id;
    protected function input($par = [])
    {
        parent::input();
        $this->category = $this->obm_u->get_category();


        if(isset($par['del'])){
            $id = (int)$par['del'];
            if($this->obm_u->delete($id)){
                redir_to(SITE_URL."news/mes/".urlencode("Новость удалена"));
            }else{
                redir_to(SITE_URL."news/mes/".urlencode("Возникли проблеммы при удалении"));
            }
        }

        if(isset($par['id'])){
            $this->post_id = (int)$par['id'];
        }else{
            redir_to(SITE_URL."news/");
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $form = new Form($this->post_id);
            $this->message = $form->message;
            $this->error=$form->error;
        }
        $this->post = $this->obm_u->get_post_by_id($this->post_id);
        $this->subcatid = (int)$this->post['c1id'];
        $this->subcatarray = $this->obm_u->get_sub_category($this->subcatid);
    }

    protected function output()
    {
        $this->content = $this->render('admin/edit',[
            'post'=>$this->post,
            'category'=>$this->category,
            'subcatarray'=>$this->subcatarray,
            'post_id'=>$this->post_id,
            'message'=>$this->message,
            'error'=>$this->error
        ]);
        $this->page = parent::output();
    }
}