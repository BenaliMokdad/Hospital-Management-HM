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
    header('location:hospital-management.php');
}

if (isset($_POST['updateInfo'])) {
    $nom=$_POST['nom'];
    $adr=$_POST['adr'];
    $password=$_POST['password'];
    $password=md5($password);

    $q0="SELECT * FROM `admin` where id='$id'";
    $r0=mysqli_query($dbc,$q0);
    $row0=mysqli_fetch_assoc($r0);

        if ($row0['password']==$password) {

            $q1="SELECT * FROM `hopital` where id='$get_id'";
            $r1=mysqli_query($dbc,$q1);
            $row1=mysqli_fetch_assoc($r1);

            if ($row1['nom']==$nom) {
                $q1="UPDATE `hopital` SET `nom`='$nom',`adr`='$adr' WHERE id='$get_id'";
                $r1=mysqli_query($dbc,$q1);
                $msg="L'hopital est modifié avec success";
            }else{
                $q2="SELECT * FROM `hopital` where nom='$nom'";
                $r2=mysqli_query($dbc,$q2);   
                $num2=mysqli_num_rows($r2);

            if ($num2==0) {
                $q1="UPDATE `hopital` SET `nom`='$nom',`adr`='$adr' WHERE id='$get_id'";
                $r1=mysqli_query($dbc,$q1);
                $msg="L'hopital est modifié avec success";
            }else{
                $msg="L'hopital est déjà existé";
            }

            }

            
        }else{
            $msg="Mot de passe incorrect";
        }

    
}

if (isset($_POST['updatePass'])) {
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];

    if ($newpassword==$cpassword) {
        $newpassword=md5($newpassword);

        $q3="UPDATE `hopital` SET `password`='$newpassword' WHERE id='$get_id'";
        $r3=mysqli_query($dbc,$q3);
        $msg2="Mot de pass est modifié avec success";

    }else{
        $msg2="Les deux mots de passe ne sont pas identiques";
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
                                <h1 class="h4 text-gray-900 mb-4">Modifier un hopital</h1>
                            </div>

                            <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    $hopitalInfo=getInfoById('hopital',$get_id);
                                     ?>

                            <form class="user" action="update-hospital.php?id=<?= $get_id ?>" method="post">
                                <label>Nom</label>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nom"
                                        value="<?= $hopitalInfo['nom'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input type="text" class="form-control form-control-user" name="adr"
                                        value="<?= $hopitalInfo['adr'] ?>" required>
                                </div>
                                <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Mot de passe" required>
                                    </div>
                                <input type="submit" name="updateInfo" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form><br>

                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Mettre à jour le mot de passe</h1>
                            </div>

                            <?php 
                                    if (isset($msg2)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg2 ?>
                                        </div>
                                    <?php } ?>

                            <form class="user" action="update-hospital.php?id=<?= $get_id ?>" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="newpassword" placeholder="Mot de passe" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="cpassword" placeholder="Répéter le mot de passe" required>
                                    </div>
                                </div>
                                <input type="submit" name="updatePass" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="hospital-management.php">Gestion des hopitaux</a>
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