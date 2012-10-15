<?php
	header("Content-type: image/png");
	$cp = $_GET['cp'];
	$size = $_GET['size'];
	
	if ($size == 'large') {
		$im = @imagecreate(200, 200) or die("Cannot Initialize new GD image stream");
		
		$rand = rand(0, 255);
		$background_color = imagecolorallocate($im, $rand, 255-$rand, 255);
		$text_color = imagecolorallocate($im, 30, 30, 30);
		
		if (strlen($cp) <= 2) { //département à 2 chiffres (le guid peut être de 1 à 2 chiffres de 1 à 95)
			if ($cp < 10) $cp = '0'.$cp;
			imagettftext($im, 60, 0, -5, 137, $text_color, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 80, 0, 65, 134, $text_color, 'Arial_Bold.ttf', $cp);
		} else if (strlen($cp) == 3) { //département à 3 chiffres 971 à 988
			imagettftext($im, 50, 0, -10, 135, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 65, 0, 45, 134, $text_color, 'Arial_Bold.ttf', $cp);
		} else { // commune
			if ($cp < 10000) $cp = '0'.$cp;
			imagettftext($im, 60, 0, -5, 97, $text_color, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 80, 0, 65, 94, $text_color, 'Arial_Bold.ttf', substr($cp, 0, 2));
			imagettftext($im, 80, 0, 10, 187, $text_color, 'Arial_Bold.ttf', substr($cp, 2, 3));
		}
	} else {
		$im = @imagecreate(40, 40) or die("Cannot Initialize new GD image stream");
		
		$rand = rand(0, 255);
		$background_color = imagecolorallocate($im, $rand, 255-$rand, 255);
		$text_color = imagecolorallocate($im, 30, 30, 30);
		
		if (strlen($cp) <= 2) { //département à 2 chiffres (le guid peut être de 1 à 2 chiffres de 1 à 95)
			if ($cp < 10) $cp = '0'.$cp;
			imagettftext($im, 12, 0, -2, 27, $text_color, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 16, 0, 13, 27, $text_color, 'Arial_Bold.ttf', $cp);
		} else if (strlen($cp) == 3) { //département à 3 chiffres 971 à 988
			imagettftext($im, 10, 0, -2, 26, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 13, 0, 10, 26, $text_color, 'Arial_Bold.ttf', $cp);
		} else { // commune
			if ($cp < 10000) $cp = '0'.$cp;
			imagettftext($im, 12, 0, -1, 20, $text_color, 'ggouv-webfont-exclam.ttf', '!');
			imagettftext($im, 16, 0, 13, 20, $text_color, 'Arial_Bold.ttf', substr($cp, 0, 2));
			imagettftext($im, 16, 0, 2, 37, $text_color, 'Arial_Bold.ttf', substr($cp, 2, 3));
		}
	}
	
	imagepng($im);
	imagedestroy($im);
?>