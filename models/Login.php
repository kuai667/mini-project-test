<?php
/**
 * This class manages the login by verifying the information input in login form and checking in userData.json if it's okay, then redirects to home.
 */
class Login{
    private $user;
    private $password;
    private $status = true;
    private $error;

    /**
     * Constructs the class, $user and $password must be strings and are optional statements.
     */
    public function __construct($user = "",$password = "")
    {
        $this->user = $user;
        $this->password = $password;

    }


    /**
     * Shows the login form.
     */
    public function showForm()
    {
        include "views/login.php";
    }



    /**
     * Verifies if the input user and password are not empty and match the data on the json file.
     */
    public function verify()
    {

        if(empty($this->user) && empty($this->password)){
            $this->error = "Please input your user information before submiting the form!";
            $this->status = false;
        }elseif(empty($this->user)){
            
            $this->error = "The user field can't be empty!";
            $this->status = false;
            
        }elseif(empty($this->password)){
            $this->error = "The password field can't be empty!";
            $this->status = false;
        }

        /**
         * If up to this moment the user and password are not empty, check if the user exists and
         * has the right password.
         */
        if($this->status){
        $userData = file_get_contents("json/userData.json");
        $data = json_decode($userData, true);
        if(array_key_exists($this->user,$data)){
            if($data["$this->user"]["password"] === $this->password){
                $this->status = true;
            }else{
                $this->error = "The password is incorrect";
                $this->status = false;
            }
        }else{
            $this->error = "The username $this->user doesn't exist in our database!";
            $this->status = false;
        }

        /**
         * Now if everything is ok, set the session information with the user data and redirect to home.
         */
        if($this->status){
            $_SESSION['user'] = $this->user;
            $_SESSION['phone'] = $data["$this->user"]["phone"];
            $_SESSION['email'] = $data["$this->user"]["email"];
            echo "<script>location.reload()</script>";
        }else{
            $this->showForm();
            die();
        }

        }
        else
        {
            $this->showForm();
            die();
        }

    }
}
