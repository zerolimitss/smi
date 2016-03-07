<?php

class Editpage extends Admin_Base
{
    private $page_id;
    private $current_page;
    protected function input($par = [])
    {
        parent::input();

        if(isset($par['del'])){
            if(empty($par['del'])) Throw new EException("Такой страницы нет");
            $id = (int)$par['del'];
            if($this->obm_u->delete_page($id)){
                Utilities::redir_to(SITE_URL."showpages/mes/".urlencode("Страница удалена"));
            }else{
                Utilities::redir_to(SITE_URL."showpages/error/".urlencode("Возникли проблеммы при удалении страницы"));
            }
        }

        if(isset($par['id'])){
            $this->page_id = (int)$par['id'];
        }else{
            Throw new EException("Такой страницы не существует");
        }
        $model = Model::get_instance();
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(!empty($_POST['header']) && !empty($_POST['text'])){
                $form_header = $model->obm->real_esc($this->clear_str($_POST['header']));
                $form_text = $model->obm->real_esc($this->clear_str($_POST['text']));
                $form_position = $model->obm->real_esc($this->clear_str($_POST['position']));

                if(!empty($_POST['keys']))
                    $form_keys = $model->obm->real_esc($this->clear_str($_POST['keys']));

                if(!empty($_POST['description']))
                    $form_description = $model->obm->real_esc($this->clear_str($_POST['description']));

                $res = $this->obm_u->update_page($this->page_id,$form_header, $form_text,
                    $form_keys, $form_description, $form_position);

                if($res)
                    Utilities::redir_to(SITE_URL."showpages/mes/".urlencode("Страница успешно обновлена"));
                else
                    Utilities::redir_to(SITE_URL."showpages/error/".urlencode("Возникли проблемы при изменении страницы"));
            }else{
                $this->error[] = "Не заполнены необходимые поля";
            }

        }
        $this->count = count($model->get_footer());
        $this->current_page = $model->get_page_by_id($this->page_id);
    }

    protected function output()
    {
        $this->content = $this->render('admin/editpage',[
            'page'=>$this->current_page,
            'page_id'=>$this->page_id,
            'message'=>$this->message,
            'error'=>$this->error,
            'count'=>$this->count
        ]);
        $this->page = parent::output();
    }
}