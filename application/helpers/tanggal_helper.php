<?php if (!defined('BASEPATH')) exit('NO direct script access allowed');

function konversiBulan($angka){

	$bulan=array('I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII');
	
	$index=$angka-1;
	
	return $bulan[$index];
}
?>