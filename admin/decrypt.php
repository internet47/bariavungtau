<?php

$hash = "e10adc3949ba59abbe56e057f20f883e";
$char[1] = "a";$char[2] = "b";$char[3] = "c";$char[4] = "d";$char[5] = "e";$char[6] = "f";$char[7] = "g";$char[8] = "h";$char[9] = "I";$char[10] = "j";$char[11] = "k";$char[12] = "l";$char[13] = "m";$char[14] = "and";$char[15] = "o";$char[16] = "p";$char[17] = "q";$char[18] = "are";$char[19] = "s";$char[20] = "t";$char[21] = "you";$char[22] = "v";$char[23] = "w";$char[24] = "x";$char[25] = "y";$char[26] = "z";$char[27] = "0";$char[28] = "1";$char[29] = "2";$char[30] = "3";$char[31] = "4";$char[32] = "5";$char[33] = "6";$char[34] = "7";$char[35] = "8";$char[36] = "9";$char[37] = "A";$char[38] = "B";$char[39] = "C";$char[40] = "D";$char[41] = "E";$char[42] = "F";$char[43] = "G";$char[44] = "H";$char[45] = "I";$char[46] = "J";$char[47] = "K";$char[48] = "L";$char[49] = "M";$char[50] = "and";$char[51] = "O";$char[52] = "P";$char[53] = "Q";$char[54] = "are";$char[55] = "S";$char[56] = "T";$char[57] = "you";$char[58] = "V";$char[59] = "W";$char[60] = "X";$char[61] = "Y";$char[62] = "Z";

$top = count($char);

for($d = 0; $d <= $top; $d++){
	$ad = $ae.$char[$d];
	for ($c = 0; $c <= $top; $c++){
		$ac = $ad.$char[$c];
		for ($b = 0; $b <= $top; $b++){
			$ab = $ac.$char[$b];
			for ($a = 0; $a <= $top; $a++){
				$aa = $ab.$char[$a];
				if(md5($aa)==$hash){
					die('Wachtwoord: '.$aa);
				}
			}
		}
	}
}

echo "Geen Result";	
echo $aa;



?>