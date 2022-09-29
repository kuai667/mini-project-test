<?php
/**
 * This class manages user registrations by verifying the information entered in the registration form and adding the user to userData.json
 */
class Register
{
    private $user;
    private $phone;
    private $email;
    private $password;
    private $status;
    private $error;

    /**
     * Constructs the class, $user,$phone,$email and $password are optional.
     */
    public function __construct($user = "",$phone = "",$email = "",$password = "")
    {
        $this->user = $user;
        $this->phone = $phone;
        $this->email = $email;
        $this->password = $password;
        $this->status = true;
    }

    /**
     * Shows the registration form.
     */
    public function showForm(){
        include "views/register.php";
    }

    /**
     * Verifies that all the data is ok and uploads it to userData.json
     */
    public function verify(){
        
        /**
         * Verifies there's no empty space
         */
        if(empty($this->user) || empty($this->phone) || empty($this->email) || empty($this->password)){
            $this->error = "Please make sure to input all of the information required by the form";
            return false;
        }

        /**
         * Verifies:
         * - Username only contains letters
         * - Email is valid
         * - Phone with a "+" followed by 9 numbers.
         * - Password is only 6 characters with one uppercase and must contain one of these:
         *   - "*"
         *   - "-"
         *   - "."
         * 
         *  -- Note: I could have made this in less lines, but wanted the error message to be the most
         *     precise possible. For example, if the phone error was because of the + or the quantity, etc.
         */

        if(preg_match("/[^a-zA-Z]/",$this->user)){
            $this->error = "The username can only contain letters!";
            return false;
        }
        if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/",$this->email)){
            $this->error = "Please enter a valid email!";
            return false;
        }
        if(preg_match("/\D/",substr($this->phone,1))){
            $this->error = "Your phone number must only contain numbers and a '+' symbol in the beginning!";
            return false;
        }
        if(!preg_match("/\+/",substr($this->phone,0,1))){
            $this->error = "Remember to add your country code! (example: +1 for United States)";
            return false;
        }
        if(strlen(substr($this->phone,1)) !== 9){
            $this->error = "Your phone number should contain 9 characters";
            return false;
        }       
        if(strlen($this->password) != 6){
            $this->error = "Your password should contain 6 characters";
            return false;
        }
        if(!preg_match("/[A-Z]+/",$this->password)){
            $this->error = "Your password should contain at least one letter Uppercased";
            return false;
        }
        if(!preg_match("/[*-.]/",$this->password)){
            $this->error = "Your password must contain one of the following characters: '*', '-', '.'";
            return false;
        }

        if($this->status == true){
            return true;
        }else{
            return false;
        }
    }


    /**
     * This function adds the user data to userData.json after the verify() function returns true
     */
    public function register(){
        if($this->verify() != false){
            $userData = file_get_contents("json/userData.json");
            $userData = json_decode($userData,true);
            if(array_key_exists($this->user,$userData)){
                $this->error = "The user $this->user already exists, please choose a new one or <a onclick=\"window.open('index.php','_self')\">login</a>.";
                $this->showForm();
                die();
            }else{
                $newUser = array(
                    "$this->user" => array(
                        "phone" => "$this->phone",
                        "email" => "$this->email",
                        "password" => "$this->password"
                    )
                );
                $finalData = array_merge_recursive($userData,$newUser);
                $finalData = json_encode($finalData);
                if(file_put_contents("json/userData.json",$finalData)){
                    echo "<script> alert('User generated succesfully. Please login with your new credentials.'); window.open('index.php','_self') </script>";
                }else{
                    $this->error = "There was an error adding your user";
                    $this->showForm();
                }
            }
        }else{
            $this->showForm();
        }
    }
}