<?php
    
    # Validate login
    session_start();
    if (isset($_SESSION["login"])) {
        if ($_SESSION["login"] !== "16c72330-d2f1-4922-bb29-b1cf33532e79") {
            header("Location: ./landing.php");
            exit();
        }
    } else {
        header("Location: ./landing.php");
        exit();
    }
    
?>

<html>
<head>
	<title>SDSU AI Student Survey Dashboard</title>
    <link rel="apple-touch-icon" sizes="180x180" href="https://ou-resources.sdsu.edu/crimson/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="https://ou-resources.sdsu.edu/crimson/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="https://ou-resources.sdsu.edu/crimson/icons/favicon-16x16.png">
	<script src = "https://cdn.jsdelivr.net/npm/sweetalert2@11.3.10/dist/sweetalert2.all.min.js"></script>
    <script>
        function info() {
            const {value: option} = Swal.fire({
                allowEscapeKey: false,
                allowOutsideClick: false,
                backdrop: false,
                confirmButtonColor: "#869bdd",
                confirmButtonText: "Select",
                title: "Select log",
                input: "select",
                inputOptions: {
                    queries: "Dashboard queries",
                    users: "Dashboard users"
                },
                showCancelButton: false,
            }).then((result) => {
                window.location.replace("download.php?option=" + result.value);
                info();
            });
        }
    </script>
</head>
<body onload = "info();">
</body>
</html>