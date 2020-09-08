<?php
require_once('../includes/upi.php');
$upi=new Upi();
$beneficiaryName='Rohit Arya';
$upiID='rohitarya@upi';
$link=$upi->linkWithoutAmount($beneficiaryName,$upiID);
echo $link;
?>