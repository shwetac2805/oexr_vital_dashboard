<?php

    # If the form was not submitted, redirect back to landing
    if (!(isset($_GET["password"]))) {
        header("Location: landing.php?login=false");
        exit();
    }
    
    try {
        $password = strtolower($_GET["password"]);
        if ($password === "cfop") {
            session_start();
            $_SESSION["login"] = "16c72330-d2f1-4922-bb29-b1cf33532e79";
            header("Location: ./");
            exit();
        } else {
            header("Location: landing.php?login=false");
            exit();
        }
    } catch (Exception $e) {
        header("Location: landing.php?login=false");
        exit();
    }
    
?>