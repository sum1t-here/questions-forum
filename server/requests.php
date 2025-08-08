<?php
    session_start();

    include("../config/db.php");

    if(isset($_POST["signup"])){
        // access form data by 'name' attribute in HTML inputs, e.g. <input name="username" />
        // echo "User name is " .$_POST["username"]."<br/>";

        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $address = $_POST["address"];

        // hashed password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $conn->prepare("INSERT INTO `users` (`username`, `email`, `password`, `address`) VALUES (?, ?, ?, ?)");
            // bind parameters wh: s — string i — integer d — double (float) b — blob (binary data)
            $stmt->bind_param("ssss", $username, $email, $hashedPassword, $address);

            // execute statement
            $result = $stmt->execute();

            if($result) {
                echo "New user registered";
                $_SESSION["user"] = ["username" => $username, "email" => $email];
            } else {
                throw new Exception("Error while registering");
            }
        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        }
    }
?>