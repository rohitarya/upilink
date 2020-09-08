<?php
/**
 * Class for UPI link generation
 *
 *
 * @author Rohit Arya, <arya.rohit13@gmail.com>
 * @version 1.0
 */
class Upi {
	
	/**
	 * Function to generate UPI Link With Amount
	 *
	 *
	 * @param pn Payee Name
	 * @param pa UPI Address of Payee
	 * @param am Amount
	 */
	public function linkWithAmount($pn=NULL,$pa=NULL,$am=NULL){
		if($pn==NULL || $pa==NULL || $am==NULL)
			return 'All fields are mandatory';
		else
		{
			$am=number_format($am,2,'.','');
			$data = "upi://pay?pn=".urlencode($pn)."&pa=";
            $data.=$pa;
            $data.='&cu=INR';
            $data.="&am=".$am;
			return $data;
		}
	}
	
	/**
	 * Function to generate UPI Link Without Amount
	 *
	 *
	 * @param pn Payee Name
	 * @param pa UPI Address of Payee
	 */
	public function linkWithoutAmount($pn=NULL,$pa=NULL){
		if($pn==NULL || $pa==NULL)
			return 'All fields are mandatory';
		else
		{
			$data = "upi://pay?pn=".urlencode($pn)."&pa=";
            $data.=$pa;
            $data.='&cu=INR';
			return $data;
		}
	}
	
	/**
	 * Function to generate QR Code using google chart
	 *
	 *
	 * @param data Link generated from above functions
	 * 
	 */
	public function genQR($data){
		$size = '400x400';
		$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
		$imagename="qr/".uniqid().'.png';
		imagepng($QR,$imagename);
		imagedestroy($QR);
		return $imagename;
	}
	
	/**
	 * Function to generate QR Code using google chart
	 *
	 *
	 * @param data Link generated from above functions
	 * @logo Address of image to be shown on payment QR
	 */
	public function genQRWithLogo($data,$logo){
		$size = '400x400';
		$QR = imagecreatefrompng('https://chart.googleapis.com/chart?cht=qr&chld=H|1&chs='.$size.'&chl='.urlencode($data));
		if($logo !== FALSE){
            	$logo = imagecreatefromstring(file_get_contents($logo));
            
            	$QR_width = imagesx($QR);
            	$QR_height = imagesy($QR);
            	
            	$logo_width = imagesx($logo);
            	$logo_height = imagesy($logo);
            	
            	// Scale logo to fit in the QR Code
            	$logo_qr_width = $QR_width/3;
            	$scale = $logo_width/$logo_qr_width;
            	$logo_qr_height = $logo_height/$scale;
            	
            	imagecopyresampled($QR, $logo, $QR_width/3, $QR_height/3, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
        }
		$imagename="qr/".uniqid().'.png';
		imagepng($QR,$imagename);
		imagedestroy($QR);
		return $imagename;
	}
}