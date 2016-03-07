<?php

class Editcategory extends Admin_Base
{
    protected $category;
    protected $subcat;
    protected $count;
    protected $parent;
    protected function input($par = [])
    {
        parent::input();

        if(isset($par['del']) || isset($par['delsub'])){
            if(empty($par['del']) && empty($par['delsub'])){
                Throw new EException("Страницы не существует");
            }

            if(isset($par['del'])){
                $id = (int)$par['del'];
                $res = $this->obm_u->delete_category($id,true);
            }
            else{
                $id = (int)$par['delsub'];
                $res = $this->obm_u->delete_category($id,false);
            }

            if($res) {
                if(isset($par['del'])) $this->message = "Категория успешно удалена";
                else $this->message = "Подкатегория успешно удалена";
                Utilities::redir_to(SITE_URL."showcategory/mes/".urlencode($this->message));
            }
            else{
                if(isset($par['del'])) $this->message = "Возникли проблемы при удалении категории";
                else $this->message = "Возникли проблемы при удалении подкатегории";
                Utilities::redir_to(SITE_URL."showcategory/error/".urlencode($this->message));
            }
        }

        if($_SERVER['REQUEST_METHOD']=='POST'){
            $id = (int)$par['updateid'];
            $title = $_POST['header'];
            $position = (int)$_POST['position'];

            if(!empty($_POST['parent']))
                $parent=(int)$_POST['parent'];

            $res = $this->obm_u->update_category($id,$title,$position,$parent);

            if($res) {
                if(isset($parent)) $this->message = "Подкатегория успешно обновлена";
                else $this->message = "Категория успешно обновлена";
                Utilities::redir_to(SITE_URL."showcategory/mes/".urlencode($this->message));
            }
            else{
                if(isset($parent)) $this->error[] = "Возникли проблемы при изменении подкатегории";
                else $this->error[] = "Возникли проблемы при изменении категории";
            }
        }

        if(isset($par['id'])){
            $id = (int)$par['id'];
            $this->category = $this->obm_u->get_category($id);
            $this->count = count($this->obm_u->get_category());
        }elseif(isset($par['subid'])){
            $id = (int)$par['subid'];
            $this->category = $this->obm_u->get_category($id);
            $this->parent = $this->obm_u->get_category();
            $this->count = count($this->obm_u->get_sub_category($this->category['parent_id']));
        }else{
            Throw new EException("Страницы не существует");
        }
    }

    protected function output()
    {

        $this->content = $this->render("admin/editcategory",[
            'category'=>$this->category,
            'count'=>$this->count,
            'parent'=>$this->parent,
            'error'=>$this->error
        ]);
        $this->page = parent::output();
    }
}