<?php

    // Include config file
    require_once("../library/config.php");

    require_once("../classes/User.php");
    require_once("../classes/UserManager.php");

    $title = "Register";
    $registerForm = "register_form.php";

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        // Render register page
        render($registerForm,
               ["title" => $title,
                "user" => $u,
                "error" => "",
                "usernameValue" => ""]
        );

    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // If any empty fields
        if (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["confirm"])) {

            // Re-render with error
            render($registerForm,
                    ["title" => $title,
                     "user" => $u,
                     "error" => "Must fill in all fields.",
                     "usernameValue" => htmlEscape($_POST["username"])]
            );

            // Exit script
            exit();
        }

        // Assign input values to variables
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirm  = $_POST["confirm"];

        // Make sure username is valid
        if (!User::isValidUsername($username)) {

            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Invalid username.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // Make sure username isn't already in use
        if (UserManager::getUserByName($username)) {

            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Username already in use.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // Check password is valid
        if (!User::isValidPassword($password)) {

            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Invalid password.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // Check that password matches confirmation
        if ($password !== $confirm) {

            render($registerForm,
                   ["title" => $title,
                    "user" => $u,
                    "error" => "Password and confirmation do not match.",
                    "usernameValue" => htmlEscape($_POST["username"])]
            );
            exit;
        }

        // If code reaches this point, all form information is valid.  Can
        //    proceed to create user.

        // Attempt to create user in the database
        $newUser = UserManager::createUser($username, $password);

        // Display error if user failed to be created
        if ($newUser == false) redirect("error.php");

        // Log user in and redirect to index

        login($newUser->getId());

        redirect("index.php");

    }

 ?>
