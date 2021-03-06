<?php 
session_start();
require_once 'connect.php';
include_once 'function_inc.php';

if (!isset($_SESSION['hopital-id'])) {
    header('location:login.php');
}
if (isset($_GET['id'])) {
    $get_id=$_GET['id'];
}

$patientInfo2=getInfoById('fiche_navette',$get_id);
$get_id2=$patientInfo2['id'];

echo $get_id2;




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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar2.html'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

               <?php include 'topbar2.html'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    
            

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">

                            <?php
                                    $patientInfo=getInfoById('patient',$get_id);
                                   
       
                                     ?>
                             <h1 class="h3 mb-2 text-gray-800">List des fiches navette du patient <?= $patientInfo['nom'] ?></h1>
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
                                       <th>Acte m??dicaux </th>
                                       <th>M??dicaments </th>
                                       <th>Date admission </th>
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
                                       <th>Acte m??dicaux </th>
                                       <th>M??dicaments </th>
                                       <th>Date admission </th>
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


                                       <td> </td>

                                       <td><?= $patientInfo['nom_hop'] ?></td>

                                       <td><?= $patientInfo['nom_hop'] ?></td>
                                   
                                   </tr>
                             
                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php include 'footer.html'; ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>