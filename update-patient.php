<?php 
session_start();
require_once 'connect.php';
include_once 'function_inc.php';

if (!isset($_SESSION['hopital-id'])) {
    header('location:admin-login.php');
}else{
    $id=$_SESSION['hopital-id'];
}

if (isset($_GET['id'])) {
    $get_id=$_GET['id'];
}else{
    header('location:patient-management.php');
}

if (isset($_POST['updateInfo'])) {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $dn=$_POST['dn'];
    $ln=$_POST['ln'];
    $adr=$_POST['adr'];
    $grp_sanguin=$_POST['grp_sanguin'];
    $nom_ass=$_POST['nom_ass'];


            $q1="SELECT * FROM `patient` where id='$get_id'";
            $r1=mysqli_query($dbc,$q1);
            $row1=mysqli_fetch_assoc($r1);

            if ($row1['nom']==$nom) {
                $q1="UPDATE `patient` SET `nom`='$nom',`prenom`='$prenom',`dn`='$dn',`ln`='$ln',`adr`='$adr',`grp_sanguin`='$grp_sanguin',`nom_ass`='$nom_ass' WHERE id='$get_id'";
                $r1=mysqli_query($dbc,$q1);
             
                $msg="Le patient est modifié avec success";
            }else{
                $q2="SELECT * FROM `patient` where nom='$nom'";
                $r2=mysqli_query($dbc,$q2);   
                $num2=mysqli_num_rows($r2);

            if ($num2==0) {
                $q1="UPDATE `patient` SET `nom`='$nom',`prenom`='$prenom',`dn`='$dn',`ln`='$ln',`adr`='$adr',`grp_sanguin`='$grp_sanguin',`nom_ass`='$nom_ass' WHERE id='$get_id'";
                $r1=mysqli_query($dbc,$q1);
             
                $msg="Le patient est modifié avec success";
            }else{
                $msg="Le patient  déjà existé";
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
                                <h1 class="h4 text-gray-900 mb-4">Modifier un acte médical</h1>
                            </div>

                            <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                                    <?php
                                    $patientInfo=getInfoById('patient',$get_id);
                                     ?>

                            <form class="user" action="update-patient.php?id=<?= $get_id ?>" method="post">
                                <label>Nom</label>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nom"
                                        value="<?= $patientInfo['nom'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>prenom</label>
                                    <input type="text" class="form-control form-control-user" name="prenom"
                                        value="<?= $patientInfo['prenom'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Date de Naissance </label>
                                    <input type="text" class="form-control form-control-user" name="dn"
                                        value="<?= $patientInfo['dn'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Lieu de naissance </label>
                                    <input type="text" class="form-control form-control-user" name="ln"
                                        value="<?= $patientInfo['ln'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <input type="text" class="form-control form-control-user" name="adr"
                                        value="<?= $patientInfo['adr'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Groupe S</label>
                                    <input type="text" class="form-control form-control-user" name="grp_sanguin"
                                        value="<?= $patientInfo['grp_sanguin'] ?>" required>
                                </div>

                                
                                <div class="form-group">
                                <label for="sels1">Choisir l'organisme assurant</label>
                                <select class="form-control" name="nom_ass" require>
                                <option  value=""></option>
                                <?php
                                $q="SELECT nom FROM `org_assurance`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                    <option value="<?= $row['nom'] ?>"><?= $row['nom'] ?></option>
                                <?php } ?>
                                </select>
                                </div>
                            
                                <input type="submit" name="updateInfo" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form><br>
                            <?php 
                                    if (isset($msg2)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg2 ?>
                                        </div>
                                    <?php } ?>

                           
                            <hr>
                            <div class="text-center">
                                <a class="small" href="patient-management.php">Gestion des patient</a>
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