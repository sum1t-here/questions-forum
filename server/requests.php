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
                $userid = $conn->insert_id;

                $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $userid];
                // redirect to homepage
                header("location: /forum");

                exit;
            } else {
                throw new Exception("Error while registering");
            }
        } catch (Exception $e) {
            echo "Registration failed: " . $e->getMessage();
        } 
    } else if (isset($_POST["login"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = "";
        $userid = 0;

        // Prepare the statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();
        
            foreach($result as $row) {
                $username = $row["username"];
                $userid = $row["id"];
            }
            
            // verify password
            if(password_verify($password, $row["password"])){
                $_SESSION["user"] = ["username" => $username, "email" => $email, "user_id" => $userid];

                header("location: /forum");

                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No account find with that email";
        }
    } else if (isset($_GET["logout"])) {
        session_unset();
        header("location: /forum");
    } else if (isset($_POST["ask"])) {
        $title = $_POST["title"];
        $description = $_POST["description"];
        $category_id = $_POST["category"];
        $user_id = $_SESSION["user"]["userid"];
        $question_id = 0;

        // print_r($_SESSION["user"]);

        try {
            // Throw exceptions on MySQLi errors
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $stmt = $conn->prepare("INSERT INTO `questions` (`title`, `description`, `category_id`, `user_id`) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssii", $title, $description, $category_id, $user_id);

            $result = $stmt->execute();

            if ($result) {
                $question_id = $conn->insert_id;
                header("location: /forum");
                exit;
            } else {
                throw new Exception("Failed to insert question");
            }

        } catch (mysqli_sql_exception $e) {
            echo "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else if ($_POST["answer"]) {
        $answer = $_POST["answer"];
        $q_id = $_POST["q_id"];
        $user_id = $_SESSION["user"]["userid"];

        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            $stmt = $conn->prepare("INSERT INTO `answers` (`answer`, `question_id`, `user_id`) VALUES (?, ?, ?)");
            $stmt->bind_param("sii", $answer, $q_id, $user_id);

            $result = $stmt->execute();

            if ($result) {
                header("location: /forum/?q-id=$q_id");
                exit;
            } else {
                throw new Exception("Failed to insert answer");
            }

        } catch (mysqli_sql_exception $e) {
            echo "Database Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>