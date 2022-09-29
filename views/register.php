<center><div class="login">
    <?php
    /**
     * Shows the error information.
     */
    if(!empty($this->error)):
    ?>
    <center><div class="alert"><?=$this->error?></div></center>
    <?php
    endif;
    ?>
    <h2>Register</h2>
    <form method="POST">
        <input type="text" name="user" value="<?=$this->user?>"placeholder="username" class="loginForm"><br>
        <input type="text" name="phone" value="<?=$this->phone?>" placeholder="phone" class="loginForm"><br>
        <input type="email" name="email" value="<?=$this->email?>" placeholder="email" class="loginForm"><br>
        <input type="password" name="password" value="<?=$this->password?>" placeholder="password" class="loginForm"><br>
        <input type="submit" name="register" value="Submit" class="submit"><br><br>
        Already registered? <a href="./">Login here!</a>

    </form>
</div></center>