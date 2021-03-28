<?php 
session_start();
require_once 'connect.php';

if (isset($_SESSION['admin-id'])) {
    if (isset($_GET['id'])) {
    $get_id=$_GET['id'];

    $q0="SELECT * FROM `org_assurance` WHERE `id`='$get_id'";
    $r0=mysqli_query($dbc,$q0);
    $num0=mysqli_num_rows($r0);

    if ($num0==1) {
    	$q1="UPDATE `org_assurance` SET `archived`=1 WHERE `id`='$get_id'";
    	$r1=mysqli_query($dbc,$q1);
    	header('location:insurance-management.php?delete=1');
    }else{
    	header('location:insurance-management.php');
    }

	}else{
	    header('location:insurance-management.php?delete=0');
	}
}else{
    header('location:admin-login.php');
}


 ?>