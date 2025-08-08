<?php
    if(isset($_POST["signup"])){
        // access form data by 'name' attribute in HTML inputs, e.g. <input name="username" />
        echo "User name is " .$_POST["username"]."<br/>";
    }
?>