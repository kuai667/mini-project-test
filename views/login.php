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
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="user" value="<?=$this->user?>"placeholder="username" class="loginForm"><br>
        <input type="password" name="password" value="<?=$this->password?>" placeholder="password" class="loginForm"><br>
        <input type="submit" name="login" value="Submit" class="submit"><br><br>
        Not a user yet? <a href="?cont=register" >Register here!</a>

    </form>
</div></center>