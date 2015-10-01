<?php


class message
{
    public function setFlash($message,$type ='danger'){
        $_SESSION['flash'] = array(
            'message' => $message,
            'type' => $type
        );
    }
    public function flash(){
        if(isset($_SESSION['flash'])){
            echo "<div class=\"alert alert-".$_SESSION['flash']['type']."\" role=\"alert\">".$_SESSION['flash']['message']."</div>";
            unset($_SESSION['flash']);

        }
    }

}