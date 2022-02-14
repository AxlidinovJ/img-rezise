<?php
require_once "./vendor/autoload.php";

class ReziseImage{
    public $img;
    public function __construct()
    {
        $this->img = new \Imagine\Gd\Imagine(); 
    }
/**
 * Undocumented function
 * Rasmlarni Kichraytirish 300px 300px
 *
 */
    public function ReziseAll($dir){
        $files = scandir($dir);
        foreach ($files as $key => $value) {
           $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
           if(!is_dir($path)){
               $ext = pathinfo($path,PATHINFO_EXTENSION);
               if(in_array($ext,['jpg','png','jpeg'])){
                    $this->img->open($path)->
                thumbnail(new \Imagine\Image\Box(300,300))->
                save($path);
               }
           }else if($value!="." and $value!=".."){
               $this->ReziseAll($path);
           }
        }
    }
}

$img = new ReziseImage();
$img->ReziseAll("./img");


?>