<?php

    session_start();
        
    if(isset($_SESSION["login"])) {
        if($_SESSION["login"] === "16c72330-d2f1-4922-bb29-b1cf33532e79") {
            header("Location: ./");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
    	<title>SDSU AI Student Survey Dashboard</title>
        <link rel = "apple-touch-icon" sizes = "180x180" href = "https://ou-resources.sdsu.edu/crimson/icons/apple-touch-icon.png">
        <link rel = "icon" type = "image/png" sizes = "32x32" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-32x32.png">
        <link rel = "icon" type = "image/png" sizes = "16x16" href = "https://ou-resources.sdsu.edu/crimson/icons/favicon-16x16.png">
    	<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
        <script>
            function info() {
                Swal.fire({
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    backdrop: false,
                    confirmButtonColor: "#869bdd",
                    confirmButtonText: "Login",
                    input: "password",
                    inputPlaceholder: "Password",
                    preConfirm: (result) => {
                        if (!result) {
                          Swal.showValidationMessage("Password required")
                        }
                        return {result: result}
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("login.php?password=" + result.value.result);
                        return false;
                    }
                });
                <?php
                    if (isset($_GET["login"])) {
                        if ($_GET["login"] === "false") {
                            echo('Swal.showValidationMessage("Incorrect password")');
                        }
                    }
                ?>
            }
        </script>
    </head>
    <body onload = "info();">
    </body>
</html>