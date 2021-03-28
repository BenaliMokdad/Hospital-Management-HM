<?php
session_start();
require_once 'connect.php';
include_once 'function_inc.php';
if (!isset($_SESSION['hopital-id'])) {
    header('location:login.php');
}else{
    $id=$_SESSION['hopital-id'];

}
if (isset($_GET['id'])) {
    $get_id=$_GET['id'];
 
}


$q1="INSERT INTO `fiche_navette`(`id_patient`, `id_hopital`) VALUES ('$get_id','$id')";
$r1=mysqli_query($dbc,$q1);

if($r1){

            $q1="SELECT id FROM `fiche_navette`";
            $r1=mysqli_query($dbc,$q1);
            $row1=mysqli_fetch_assoc($r1);
            while($row1=(mysqli_fetch_assoc($r1))){
            $idfn=$row1['id'];
    header('location:add-fichenavette.php?id=' .$idfn );}

}


?>