<?php
require_once("sdata-modules.php");
/**
 * @Author: Eka Syahwan
 * @Date:   2017-12-11 17:01:26
 * @Last Modified by:   Eka Syahwan
 * @Last Modified time: 2018-05-20 10:47:25
 */

echo "┬┌┬┐┌─┐┌┬┐┬┌─┬ ┬ ┌─┐┌─┐┌┬┐ Eka Syahwan\r\n";
echo "│ │ ├┤ │││├┴┐│ │ │  │ ││││\r\n";
echo "┴ ┴ └─┘┴ ┴┴ ┴└─┘o└─┘└─┘┴ ┴\r\n";
echo "============================\r\n";
echo "Analisa penjualan produk\r\n";
echo "============================\r\n\n";
echo "[+] Masukan Url : ";
$answer =  rtrim( fgets( STDIN ));

$idTarget = $answer;
$e = explode("/", $idTarget);

echo "\r\n[+] Sedang meminta data [".$idTarget."][".$e[5]."]\r\n";
echo "[+] Meminta data page . . . ";

$getURL = "https://itemku.com/testimonial/".$e[5]."?page=";
$url[] 	= array('url' => $getURL."1");
$result = $sdata->sdata($url); $sdata->session_remove($result);
unset($url);
preg_match_all('/(.*?) of (.*?)$/m', $result[0][respons], $matches);

echo "[Done - Total Page : ".$matches[2][0]."]\r\n";

for ($i=0; $i < ($matches[2][0]+1); $i++) {
	$url[] = array('url' => $getURL.$i);
}
echo "[+] Sedang meminta data ulasan . . .";
$result = $sdata->sdata($url); $sdata->session_remove($result);
echo " [Done]\r\n\n===============================================\r\n";
foreach ($result as $key => $value) {
	preg_match_all( '/<span class="text-grey text-medium display-block">(.*?)<\/span>/m', $value['respons'], $matches);
	foreach ($matches[1] as $key => $value) {
		$value = str_replace("</b>", "", $value);
		$value = str_replace("<b>", "", $value);
		$value = str_replace("Ulasan untuk produk ", "", $value);
		$array[data][$value][] = $value; 
	}
}
foreach ($array[data] as $key => $value) {
	$namaProduk[] 	= $key;
	$ulsan[] 		= count($value);
}
asort($ulsan);
foreach ($ulsan as $key => $value) {
	echo "[+] ".$namaProduk[$key]." ==[Total Penjualan : ".$value."]==\r\n";
}