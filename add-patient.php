<?php 
session_start();
require_once 'connect.php';

if (!isset($_SESSION['hopital-id'])) {
    header('location:login.php');
}

if (isset($_POST['submit'])) {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $dn=$_POST['dn'];
    $ln=$_POST['ln'];
    $adr=$_POST['adr'];
    $grp_sanguin=$_POST['grp_sanguin'];
    $nom_hop=$_POST['nom_hop'];
    $nom_ass=$_POST['nom_ass'];
    $password=$_POST['password'];



    $q0="SELECT * FROM `patient` where nom='$nom'";
    $r0=mysqli_query($dbc,$q0);
    $num0=mysqli_num_rows($r0);

        if ($num0==0) {

                $q1="INSERT INTO `patient`(`nom`, `prenom`, `dn`, `ln`, `adr`, `grp_sanguin`,`nom_hop`,`nom_ass`,`password`) VALUES ('$nom','$prenom','$dn','$ln','$adr','$grp_sanguin','$nom_hop','$nom_ass','$password')";
             
                $r1=mysqli_query($dbc,$q1);
                $msg="le patient est ajouté avec success";
        }else{
            $msg="le patient  déjà existe";
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
                                <h1 class="h4 text-gray-900 mb-4">Ajouter un patient</h1>
                            </div>

                            <?php 
                                    if (isset($msg)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                            <form class="user" action="add-patient.php" method="post">
                                <div class="form-group">
                                <label>Nom</label>
                                    <input type="text" class="form-control form-control-user" name="nom"
                                        placeholder="Nom " required>
                                </div>
                                <div class="form-group">
                                <label>Prenom</label>
                                    <input type="text" class="form-control form-control-user" name="prenom"
                                        placeholder="prenom " required>
                                </div>
                                <div class="form-group">
                                <label>Date de naissance</label>
                                    <input type="text" class="form-control form-control-user" name="dn"
                                        placeholder="Date de naissance" required>
                                </div>
                                <div class="form-group">
                                <label>Lieu de naissance</label>
                                    <input type="text" class="form-control form-control-user" name="ln"
                                        placeholder="Lieu de naissance " required>
                                </div>
                                <div class="form-group">
                                <label>Adresse</label>
                                    <input type="text" class="form-control form-control-user" name="adr"
                                        placeholder="Adresse " required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="sels1">Choisir le groupe songin</label>
                                    <select placeholder="Groupe Songin " name="grp_sanguin" class="form-control" id="exampleFormControlSelect1">
                                    <option>O+</option>
                                    <option>O-</option>
                                    <option>A+</option>
                                    <option>A-</option>
                                    <option>B+</option>
                                    <option>B-</option>
                                    <option>AB+</option>
                                    <option>AB-</option>
                                    </select>
                                </div>

                                

                                <div class="form-group">
                                <label for="sels1">Hopital</label>
                                <select class="form-control" name="nom_hop" require>
                                <option value=""></option>
                                <?php
                                $q="SELECT nom FROM `hopital`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                    <option value="<?= $row['nom'] ?>"><?= $row['nom'] ?></option>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                <label for="sels1">Choisir l'organisme assurant</label>
                                <select class="form-control" name="nom_ass" require>
                                <option value=""></option>
                                <?php
                                $q="SELECT nom FROM `org_assurance`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                    <option value="<?= $row['nom'] ?>"><?= $row['nom'] ?></option>
                                <?php } ?>
                                </select>
                                </div>


                                <div class="form-group">
                                <label>Password</label>
                                    <input type="text" class="form-control form-control-user" name="password"
                                        placeholder="Password " required>
                                </div>
                                <br>
                                <br>

                                <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Ajouter">   </div>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="patient-management.php">Gestion des patients</a>
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