<?php 
session_start();
require_once 'connect.php';

if (!isset($_SESSION['admin-id'])) {
    header('location:admin-login.php');
}

if (isset($_POST['submit'])) {
    $nom=$_POST['nom'];
    $prix=$_POST['prix'];


    $q0="SELECT * FROM `medicament` where nom='$nom'";
    $r0=mysqli_query($dbc,$q0);
    $num0=mysqli_num_rows($r0);

        if ($num0==0) {

                $q1="INSERT INTO `medicament`(`nom`, `prix`) VALUES ('$nom','$prix')";
                $r1=mysqli_query($dbc,$q1);
                $msg="le médicament est ajouté avec success";
        }else{
            $msg="le médicament  déjà existe";
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

<body class="bg-gradient-white">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Ajouter un médicament</h1>
                            </div>

                            <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                            <form class="user" action="add-medicament.php" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nom"
                                        placeholder="Nom médicament" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="prix"
                                        placeholder="Prix " required>
                                </div>
                               
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Ajouter">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="medicaments-management.php">Gestion des médicaments</a>
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