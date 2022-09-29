<?php
/**
 * This class manages everything about sessions (login,register,logout,etc)
 */
class Session{

    /**
     * If the user is not logged in, the login form shows up. Once they complete it, the $_POST['login']
     * part goes to the Login controller
     */
    public function login(){
        if(isset($_POST['login'])){
            $login = new Login($_POST['user'],$_POST['password']);
            $login->verify();
        }else{
            $login = new Login;
            $login->showForm();
        }
    }

    /**
     * Manages registration, similar to login but with extra user data.
     */
    public function register(){
        if(isset($_POST['register'])){
            $register = new Register($_POST['user'],$_POST['phone'],$_POST['email'],$_POST['password']);
            $register->register();
        }else{
            $register = new Register;
            $register->showForm();
        }
    }

    /**
     * If the user decides to logout, destroys the session and reloads the page.
     */
    public function logout(){
        session_destroy();
        Header("Location: index.php");
    }
}