<?php

class Addnewcat extends Admin_Base
{
    protected $category;
    protected $subcat;
    protected $count;
    protected $parent;
    protected function input($par = [])
    {
        parent::input();


        if(isset($par['parent'])){
            $this->parent = (int)$par['parent'];
            $this->count = count($this->obm_u->get_sub_category($this->parent));
        } else{
            $this->count = count($this->obm_u->get_category());
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(empty($_POST['header'])){
                $this->error[] = "Заголовок не может быть пустым";
                return;
            }
            $title = $_POST['header'];
            $position = (int)$_POST['position'];

            if(!empty($_POST['parent']))
                $parent=(int)$_POST['parent'];

            $res = $this->obm_u->insert_category($title,$position,$parent);

            if($res) {
                if(isset($parent)) $this->message = "Подкатегория успешно добавлена";
                else $this->message = "Категория успешно добавлена";
            }
            else{
                if(isset($parent)) $this->error[] = "Возникли проблемы при добавлении подкатегории";
                else $this->error[] = "Возникли проблемы при добавлении категории";
            }

            Utilities::redir_to(SITE_URL."showcategory/mes/".urlencode($this->message));
        }

    }

    protected function output()
    {
        $this->content = $this->render("admin/addnewcat",[
            'category'=>$this->category,
            'count'=>$this->count,
            'parent'=>$this->parent,
            'message'=>$this->message,
            'error'=>$this->error

        ]);
        $this->page = parent::output();
    }
}