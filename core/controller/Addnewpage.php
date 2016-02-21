<?php

class Addnewpage extends Admin_Base
{
    private $page_id;
    private $current_page;
    protected function input($par = [])
    {
        parent::input();

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

                $res = $this->obm_u->add_new_page($form_header, $form_text,
                    $form_keys, $form_description, $form_position);

                if($res) {
                    redir_to(SITE_URL."showpages/mes/".urlencode("Страница успешно добавлена"));
                }
                else{
                    redir_to(SITE_URL."showpages/error/".urlencode("Возникли проблемы при добавлении страницы"));
                }
            }else{
                $this->error[] = "Не заполнены необходимые поля";
            }

        }
        $this->count = count($model->get_footer());
    }

    protected function output()
    {
        $this->content = $this->render('admin/addnewpage',[
            'page'=>$this->current_page,
            'message'=>$this->message,
            'error'=>$this->error,
            'count'=>$this->count
        ]);
        $this->page = parent::output();
    }
}