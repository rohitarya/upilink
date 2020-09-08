<?php
require_once('../includes/upi.php');
$upi=new Upi();
$beneficiaryName='Rohit Arya';
$upiID='rohitarya@upi';
$amount=10.00;
$logo='https://bharatbills.com/wp-content/uploads/2019/05/Bharat-Bills_Loadeer_1.png';
$link=$upi->linkWithAmount($beneficiaryName,$upiID,$amount);
$imagename=$upi->genQRWithLogo($link,$logo);
?>
<img height=360px; src="<?php echo $imagename;?>">