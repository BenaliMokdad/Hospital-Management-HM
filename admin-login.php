<?php
require_once 'connect.php';

if (isset($_SESSION['admin-id'])) {
    header('location:index.php');
}

if (isset($_POST['submit'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password=md5($password);

    $q0="SELECT * FROM `admin` where username='$username' and password='$password'";
    $r0=mysqli_query($dbc,$q0);
    $num0=mysqli_num_rows($r0);

    if ($num0==1) {
        $row0=mysqli_fetch_assoc($r0);

        session_start();

        $_SESSION['admin-id']=$row0['id'];
        $_SESSION['admin-username']=$row0['username'];
        $_SESSION['admin-date']=$row0['date'];

        header('location:dashboard.php');

    }else{
        $msg="Le pseudo ou mot de passe est incorect";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMH</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Content de te revoir!</h1>
                                    </div>

                                    <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-danger">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>
                                     
                                    <form class="user" action="admin-login.php" method="post"> 
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" placeholder="Nom d'utilisateur" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Connexion">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Page d'accueil</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>