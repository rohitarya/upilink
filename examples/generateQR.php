<?php
require_once('../includes/upi.php');
$upi=new Upi();
$beneficiaryName='Rohit Arya';
$upiID='rohitarya@upi';
$amount=10.00;
$link=$upi->linkWithAmount($beneficiaryName,$upiID,$amount);
$imagename=$upi->genQR($link);
?>
<img height=360px; src="<?php echo $imagename;?>">