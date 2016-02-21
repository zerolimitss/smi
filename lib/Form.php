<?php

class Form
{
    private $form_file;
    private $form_header;
    private $form_text;
    private $form_anons;
    private $form_keys;
    private $form_description;
    private $form_visible;
    private $form_subcat;
    private $form_main;
    private $form_id;
    private $obm_user;
    private $obm_mysql;
    public $error;
    public $message;


    public function __construct($what=false)
    {
        $this->obm_user = Model_User::get_instance();
        $this->obm_mysql = MySQL::get_instance();
        $this->processing();
        if(empty($this->error) && $what) {
          $this->form_id = $what;
          $this->update();
        }
        if(empty($this->error) && !$what)
          $this->insert();
    }

    private function processing()
    {
     if(!empty($_FILES['img']['name'])){
         $this->form_file = uniqid()."_".basename($_FILES['img']['name']);
         if(!move_uploaded_file($_FILES['img']['tmp_name'],UPLOAD_IMG.$this->form_file)){
             $this->error[] = "Ошибка загрузки файла";
         }
     }
     if(!empty($_POST['header']) && !empty($_POST['text']) &&
         !empty($_POST['anons']) && !empty($_POST['subcat'])){

         $this->form_header = $this->obm_mysql->real_esc($this->clear_str($_POST['header']));
         $this->form_text = $this->obm_mysql->real_esc($this->clear_str($_POST['text']));
         $this->form_anons = $this->obm_mysql->real_esc($this->clear_str($_POST['anons']));

         if(!empty($_POST['keys']))
             $this->form_keys = $this->obm_mysql->real_esc($this->clear_str($_POST['keys']));

         if(!empty($_POST['description']))
             $this->form_description = $this->obm_mysql->real_esc($this->clear_str($_POST['description']));

         $this->form_visible = (int)$_POST['visible'];
         $this->form_subcat = (int)$_POST['subcat'];
         $this->form_main = (int)$_POST['main'];
     }else{
         $this->error[] = "Не заполнены необходимые поля";
          }
     }

    private function insert()
    {
         $res = $this->obm_user->add_new($this->form_header, $this->form_text, $this->form_anons,
                                     $this->form_visible, $this->form_subcat, $this->form_main,
                                     $this->form_keys, $this->form_description, $this->form_file);
         if($res)
             $this->message = "Новость успешно добавлена";
         else
             $this->error[] = "Возникли проблемы при добавлении новости";
    }

    private function update()
    {
        $res = $this->obm_user->update_new($this->form_id, $this->form_header, $this->form_text, $this->form_anons,
                                        $this->form_visible, $this->form_subcat, $this->form_main,
                                        $this->form_keys, $this->form_description, $this->form_file);
        if($res)
            $this->message = "Новость успешно обновлена";
        else
            $this->error[] = "Возникли проблемы при обновлении новости";
    }
    protected function clear_str($str)
    {
        return strip_tags(trim($str));
    }
}