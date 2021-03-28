<?php 
session_start();
require_once 'connect.php';

if (isset($_SESSION['hopital-id'])) {
    if (isset($_GET['fn'])) {
        $fn_id=$_GET['fn'];
    }

    if (isset($_GET['id'])) {
    $get_id=$_GET['id'];

    	$q1="DELETE FROM `fn_dt` WHERE `id`='$get_id'";
    	$r1=mysqli_query($dbc,$q1);
    	header('location:add-fichenavette.php?id='.$fn_id.'&delete=1');
    

	}else{
	    header('location:add-fichenavette.php?id='.$fn_id.'&delete=0');
	}
}else{
    header('location:login.php');
}


 ?>