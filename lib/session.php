<?php
class Session{
    public static function init(){
        if(version_compare(phpversion(), '5.4.0', '<')){
            if(session_id() == ''){ 
                session_start(); 
            }
        }
        else{
            if(session_status() == PHP_SESSION_NONE){ 
                session_start(); 
            }
        }
    }

    public static function set($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        if(isset($_SESSION[$key])){ 
            return $_SESSION[$key]; 
        }
        else{ 
            return false; 
        }
    }

    public static function checkSession(){
        self::init();
        if(self::get("login") == false) {
            self::destroy();
            header("location:login.php");
            exit();
        }
    }

    public static function checkLogin() {
        self::init();
        if(self::get("login") == true) {
            header("location:index.php");
        }
    }

    public static function destroy(){
        session_destroy();
        header("location:login.php");
    }

    public static function sessionDestroyAll(){
        self::init(); // Khởi tạo session nếu chưa
        session_unset(); 
        session_destroy();
    }
}
?>
