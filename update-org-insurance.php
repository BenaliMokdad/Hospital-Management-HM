<?php 
session_start();
require_once 'connect.php';
include_once 'function_inc.php';

if (!isset($_SESSION['admin-id'])) {
    header('location:admin-login.php');
}else{
    $id=$_SESSION['admin-id'];
}

if (isset($_GET['id'])) {
    $get_id=$_GET['id'];
}else{
    header('location:insurance-management.php');
}

if (isset($_POST['submit'])) {
    $nom=$_POST['nom'];

    $q0="SELECT * FROM `org_assurance` where id='$get_id'";
    $r0=mysqli_query($dbc,$q0);
    $row0=mysqli_fetch_assoc($r0);
    if ($row0['nom']==$nom) {
        $q1="UPDATE `org_assurance` SET `nom`='$nom' WHERE id='$get_id'";
        $r1=mysqli_query($dbc,$q1);
        $msg="L'organisme d'assurance est modifié avec success";
    }else{
        $q2="SELECT * FROM `org_assurance` where nom='$nom'";
        $r2=mysqli_query($dbc,$q2);
        $num2=mysqli_num_rows($r2);

        if ($num2==0) {
                $q3="UPDATE `hopital` SET `nom`='$nom' WHERE id='$get_id'";
                $r3=mysqli_query($dbc,$q3);
                $msg="L'organisme d'assurance est modifié avec success";
        }else{
            $msg="L'organisme d'assurance est déjà existé";
        }
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
                                <h1 class="h4 text-gray-900 mb-4">Modifier un organisme d'assurance</h1>
                            </div>

                            <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    $orgAssuranceInfo=getInfoById('org_assurance',$get_id);
                                     ?>

                            <form class="user" action="update-org-insurance.php?id=<?= $get_id ?>" method="post">
                                <div class="form-group">
                                    <label>Nom</label>
                                    <input type="text" class="form-control form-control-user" name="nom"
                                        value="<?= $orgAssuranceInfo['nom'] ?>" required>
                                </div>
                                
                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="insurance-management.php">Gestion des organismes d'assurance</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="dashboard.php">Tableau de bord</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Page d'accueil</a>
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