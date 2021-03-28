<?php 
session_start();
require_once 'connect.php';
include_once 'function_inc.php';


if (isset($_GET['id'])) {
    $get_id2=$_GET['id'];

 
}
$patientInfo2=getInfoById('fiche_navette',$get_id2);
$get_id=$patientInfo2['id_patient'];



if (isset($_POST['submit2'])) {
      $id_acte=$_POST['id_acte'];


                $q1="INSERT INTO `fn_dt`(`id_fn`, `id_acte`) VALUES ('$get_id2','$id_acte')";
        
                $r1=mysqli_query($dbc,$q1);
                $msg="L'acte médical est ajouté avec success";
        
    
}
if (isset($_POST['submit3'])) {
    $id_medicament=$_POST['id_medicament'];


              $q1="UPDATE `fn_dt` SET `id_medicament`= '$id_medicament' WHERE id_fn='$get_id2'";
            
              $r1=mysqli_query($dbc,$q1);
              $msg="Le medicament est ajouté avec success";
      
  
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
                                <h1 class="h4 text-gray-900 mb-4">Ajouter une fiche navette</h1>
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

                            <!-- <form class="user" action="update-patient.php?id=<?= $get_id ?>" method="post"> -->
                            <hr>
                            <?php  
            $q1="SELECT nom FROM `patient` where id='$get_id'";
            $r1=mysqli_query($dbc,$q1);
            $row1=mysqli_fetch_assoc($r1);

                         echo "<p> <b>Les informations du patient  $row1[nom]  </p>" ; ?> 
                             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                       
                                            <th>Nom </th>
                                            <th>Prenom  </th>
                                            <th>Date de naissance</th>
                                            <th>Lieu de naissance</th>
                                            <th>Adresse</th>
                                            <th>Groupe songin</th>
                                            <th>Assurance </th>
                                            <th>Hopital </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         
                                            <th>Nom </th>
                                            <th>Prenom  </th>
                                            <th>Date de naissance</th>
                                            <th>Lieu de naissance</th>
                                            <th>Adresse</th>
                                            <th>Groupe songin</th>
                                            <th>Assurance </th>
                                            <th>Hopital </th>
                                        </tr>
                                    </tfoot>
                                    <tbody><tr>
                                            <td><?= $patientInfo['nom'] ?></td>
                                            <td><?= $patientInfo['prenom'] ?></td>
                                            <td><?= $patientInfo['dn'] ?></td>
                                            <td><?= $patientInfo['ln'] ?></td>
                                            <td> <?= $patientInfo['adr'] ?></td>
                                            <td><?= $patientInfo['grp_sanguin'] ?></td>
                                            <td><?= $patientInfo['nom_ass'] ?></td>
                                            <td><?= $patientInfo['nom_hop'] ?></td>
                                        
                                        </tr>
                               
                                    </tbody>
                                </table>
                                <hr>  
                                <p> <b>Ajouter acte médical </p>
                                   
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                       
                                            <th>Nom acte médical 
                                            <form class="user" action="add-fichenavette.php?id=<?= $get_id2 ?>" method="post">
                                

                                        <div class="form-group">
                                        <select class="form-control" name="id_acte" required>
                                        <option value=""></option>
                                        <?php
                                        $q="SELECT * FROM `acte_m` where archived=0";
                                        $r=mysqli_query($dbc,$q);
                                        while($row=(mysqli_fetch_assoc($r))){ ?>
                                        
                                            <option value="<?= $row['id'] ?>"><?= $row['nom_acte'] ?></option>
                                        <?php } ?>
                                        </select>
                                        </div>
                                        
                                            </th>
                                            <th>Prix  </th>
                                            <th><input type ="submit" name="submit2" class="btn btn-success btn-block" value="Ajouter"></th>
                                            </form>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         
                                            <th>Nom acte médical </th>
                                            <th>Prix  </th>
                                            <th>Supprimer</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $qq="SELECT * FROM `fn_dt` WHERE `id_fn`='$get_id2'";
                                    //echo $qq; exit();
                                    $rr=mysqli_query($dbc,$qq);
                                    while($roww=mysqli_fetch_assoc($rr)){
                                        $acteInfo=getInfoById('acte_m',$roww['id_acte']);
                                        ?>
                                    
                                    <tr>
                                            <td><?= $acteInfo['nom_acte'] ?></td>
                                            <td><?= $acteInfo['prix'] ?></td>
                                            <td>
                                            <a href="delete-acte.php?fn=<?= $get_id2 ?>&id=<?= $roww['id'] ?>" class="btn btn-danger
                                             btn-block">Supprimer</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                           
                                <hr>  
                                <p> <b>Ajouter médicament</p>
                                   
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                       
                                            <th>Nom médicament
                                            <form class="user" action="add-fichenavette.php?id=<?= $get_id2 ?>" method="post">
                                

                                        <div class="form-group">
                                        <select class="form-control" name="id_medicament" required>
                                        <option value=""></option>
                                        <?php
                                        $q="SELECT * FROM `medicament` where archived=0";
                                        $r=mysqli_query($dbc,$q);
                                        while($row=(mysqli_fetch_assoc($r))){ ?>
                                        
                                            <option value="<?= $row['id'] ?>"><?= $row['nom'] ?></option>
                                        <?php } ?>
                                        </select>
                                        </div>
                                        
                                            </th>
                                            <th>Prix  </th>
                                            <th><input type ="submit" name="submit3" class="btn btn-success btn-block" value="Ajouter"></th>
                                            </form>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                         
                                            <th>Nom acte médical </th>
                                            <th>Prix  </th>
                                            <th>Supprimer</th>

                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php
                                    $qq="SELECT * FROM `fn_dt` WHERE `id_fn`='$get_id2'";
                                    //echo $qq; exit();
                                    $rr=mysqli_query($dbc,$qq);
                                    while($roww=mysqli_fetch_assoc($rr)){
                                        $medicInfo=getInfoById('medicament',$roww['id_medicament']);
                                        ?>
                                    
                                    <?php  if (isset($medicInfo['nom']) and $medicInfo['nom'] != "") {?>


                                    
                                    
                                    <tr>
                                            <td><?= $medicInfo['nom'] ?></td>
                                            <td><?= $medicInfo['prix'] ?></td>
                                            <td>
                                            <a href="delete-m2.php?fn=<?= $get_id2 ?>&id=<?= $roww['id'] ?>" class="btn btn-danger
                                             btn-block">Supprimer</a>
                                            </td>
                                        </tr>
                                               <?php } ?>
                                        <?php } ?>
                                    </tbody>
                                </table>
                           

                                <!-- <input type="submit" name="add" class="btn btn-success btn-user btn-block" value="Modifier"> -->
                            
                            <br>
                            <!-- DataTales Example -->
                            <?php 
                                    if (isset($msg2)) { ?>
                                        <div class="alert alert-info">
                                          <strong>SMH!</strong> <?= $msg2 ?>
                                        </div>
                                    <?php } ?>

                           
                            <hr>
                            <div class="text-center">
                                <a class="small" href="fichenavette-management.php">Gestion des fiches navette</a>
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