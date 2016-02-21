<?php

class Model_User
{
    static $inst;
    protected $obm;

    private function __construct(){
        $this->obm = MySQL::get_instance();
    }

    static function get_instance()
    {
        if(self::$inst instanceof self)
            return self::$inst;
        return self::$inst=new self;
    }

    public function check_login($l, $p)
    {
        $l = $this->obm->real_esc($l);
        $sql= "SELECT * FROM users WHERE login='$l' LIMIT 1";
        $res = $this->obm->get_query($sql);
        if(!$res) return false;
        return password_verify($p, $res[0]['password']);
    }

    public function add_new($header, $text, $anons, $visible, $subcat,
                      $main=0, $keys='', $description='', $file='')
    {
        $date = time();
        //если обычная новость
        if($main===0) {
            $sql = "INSERT INTO posts (title,text,keywords,description,
                visible,anons,date,image,category_id,main_new)";
            $sql .= "VALUES ('$header','$text','$keys','$description','$visible',
                           '$anons',$date,'$file',$subcat,'$main')";
        }
        //если новость нужно разместить на главной
        if($main===1) {
            $del = "UPDATE posts SET main_new='0' WHERE main_new='1'";
            $this->obm->change($del);
            $sql = "INSERT INTO posts (title,text,keywords,description,
                visible,anons,date,image,category_id,main_new)";
            $sql .= "VALUES ('$header','$text','$keys','$description','$visible',
                           '$anons',$date,'$file',$subcat,'$main')";
        }
        //если новость важная
        if($main===2) {
            $sql = "INSERT INTO posts (title,text,keywords,description,
                visible,anons,date,image,category_id,main_new)";
            $sql .= "VALUES ('$header','$text','$keys','$description','$visible',
                           '$anons',$date,'$file',$subcat,'$main')";
        }
        return $this->obm->change($sql);
    }

    public function update_new($id,$header, $text, $anons, $visible, $subcat,
                            $main=0, $keys='', $description='', $file='')
    {
        if($main===1) {
            $del = "UPDATE posts SET main_new='0' WHERE main_new='1'";
            $this->obm->change($del);
        }

        $sql = "UPDATE posts ";
        $sql .= "SET title='$header',
                     text='$text',
                     keywords='$keys',
                     description='$description',
                     visible='$visible',
                     anons='$anons',
                     category_id=$subcat,
                     main_new='$main' ";

        if(!empty($file))
            $sql .= ", image='$file' ";

        $sql .= " WHERE id=$id";
        //echo $sql;
        return $this->obm->change($sql);
    }

    public function get_category($id=false)
    {
        //получить все родительские категории
        if(!$id) {
            $sql = "SELECT id, title FROM category WHERE parent_id=0 ORDER BY position";
            $res = $this->obm->get_query($sql);
            return $res;
        }
        //получить категорию по ID
        else{
            $sql = "SELECT id, title,position,parent_id FROM category WHERE id=$id";
            $res = $this->obm->get_query($sql);
            return $res[0];
        }
    }
    public function get_sub_category($id=0)
    {
        //получить все подкатегории к родительской
        if($id !== 0){
            $sql = "SELECT id, title,position,parent_id FROM category WHERE parent_id=$id ORDER BY position";
        }
        //получить все подкатегории
        else{
            $sql = "SELECT id, title, parent_id FROM category WHERE parent_id<>$id ORDER BY position";
        }
        $res = $this->obm->get_query($sql);
        return $res;
    }
    public function delete($id)
    {
        $sql="DELETE FROM posts WHERE id=$id LIMIT 1";
        return $this->obm->change($sql);
    }
    public function get_post_by_id($id)
    {
        $sql = "SELECT p.id, p.title, p.text, p.image, p.date,
                        p.keywords, p.description,p.anons,
                        p.category_id,p.main_new,p.visible,
                        c1.id as c1id";
        $sql .= " FROM posts p
                    INNER JOIN category c ON c.id=p.category_id
                    INNER JOIN category c1 ON c1.id=c.parent_id ";
        $sql .= " WHERE p.id=$id AND p.category_id=c.id";
        $sql .= " LIMIT 1";
        $res = $this->obm->get_query($sql);
        return $res[0];
    }

    public function update_category($id,$title,$position,$parent='')
    {
        $sql = "UPDATE category ";
        $sql .= "SET title='$title',
                     position='$position' ";
        if(!empty($parent))
            $sql .= ",parent_id=$parent ";

        $sql .= " WHERE id=$id";
        return $this->obm->change($sql);
    }

    public function insert_category($title,$position,$parent='')
    {
        $sql = "INSERT INTO category ";
        $sql .= "SET title='$title',
                     position='$position' ";
        if(!empty($parent))
            $sql .= ",parent_id=$parent ";
        else
            $sql .= ",parent_id=0 ";
        //echo $sql;
        return $this->obm->change($sql);
    }

    public function delete_category($id,$parent)
    {
        //если категория родительская, проверям нет ли подкатегорий
        if ($parent) {
            $sql = "SELECT id FROM category WHERE parent_id=$id";
            $res = $this->obm->get_query($sql);
            if (!$res) {
                $sql = "DELETE FROM category WHERE id=$id LIMIT 1";
                return $this->obm->change($sql);
            } else {
                return false;
            }
        }
        //если подкатегория, проверям нет ли постов
        else {
            $sql = "SELECT id FROM posts WHERE category_id=$id";
            $res = $this->obm->get_query($sql);
            if (!$res) {
                $sql = "DELETE FROM category WHERE id=$id LIMIT 1";
                return $this->obm->change($sql);
            } else {
                return false;
            }
        }
    }

    public function add_new_page($header, $text, $keys='', $description='', $position)
    {
        $sql = "INSERT INTO pages (title,text,keywords,description,position)";
        $sql .= "VALUES ('$header','$text','$keys','$description','$position')";
        return $this->obm->change($sql);
    }
    public function update_page($id, $header, $text, $keys='', $description='', $position)
    {
        $sql = "UPDATE pages ";
        $sql .= "SET title='$header',
                    text='$text',
                    keywords='$keys',
                    description='$description',
                    position='$position' ";
        $sql .= "WHERE id=$id";
        return $this->obm->change($sql);
    }
    public function delete_page($id)
    {
        $sql="DELETE FROM pages WHERE id=$id LIMIT 1";
        return $this->obm->change($sql);
    }
}