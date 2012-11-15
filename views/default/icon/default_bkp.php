<?php
/**
 * Generic icon view.
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['entity']     The entity the icon represents - uses getIconURL() method
 * @uses $vars['size']       topbar, tiny, small, medium (default), large, master
 * @uses $vars['href']       Optional override for link
 * @uses $vars['img_class']  Optional CSS class added to img
 * @uses $vars['link_class'] Optional CSS class for the link
 */

$entity = $vars['entity'];

$sizes = array('small', 'medium', 'large', 'tiny', 'master', 'topbar');
// Get size
if (!in_array($vars['size'], $sizes)) {
	$vars['size'] = "medium";
}

$icon_sizes = elgg_get_config('icon_sizes');
$size = $vars['size'];

if (false) {//$entity->getSubtype() == 'localgroup') {
	$cp = $entity->guid;
	
	/*$a = DecHex(mt_rand(3,13)); $b = DecHex(mt_rand(3,15)); $c = DecHex(mt_rand(0,13)); $d = DecHex(mt_rand(0,15)); $p = mt_rand(1,3);
	if ($p == 1) $hexac = 'DD' . $a . $b . $c . $d;
	if ($p == 2) $hexac = $a . $b .'DD' . $c . $d;
	if ($p == 3) $hexac = $a . $b . $c . $d . 'DD';
	
	$sizeW = $size != 'master' ? $icon_sizes[$size]['w'] : NULL;
	$sizeH = $size != 'master' ? $icon_sizes[$size]['h'] : NULL;
	//$size = $vars['size'] == 'large' ? '200px' : '40px';
	
	$style = 'style="background:#'.$hexac.';height:'.$sizeH.'px;width:'.$sizeW.'px;"';
	
	$exclam = '<span class="gwf">!</span>';
	if (strlen($cp) <= 2) { //département à 2 chiffres (le guid peut être de 1 à 2 chiffres de 1 à 95)
		$img = "<div $style class='group-info-popup $size dep2' title='$cp'>";
		if ($cp < 10) $cp = '0'.$cp;
		$img .= $exclam . '<span class="cp">' . $cp . '</span>';
	} else if (strlen($cp) == 3) { //département à 3 chiffres 971 à 988
		$img = "<div $style class='group-info-popup $size dep3' title='$cp'>";
		$img .= $exclam . '<span class="cp">' . $cp . '</span>';
	} else { // commune
		$img = "<div $style class='group-info-popup $size ville' title='$cp'>";
		if ($cp < 10000) $cp = '0'.$cp;
		$img .= $exclam . '<span class="cp">' . substr($cp, 0, 2) . '</span>';
		$img .= '<br><span class="cp2">' . substr($cp, 2, 3) . '</span>';
	}
	echo $img . '</div>';*/
	
} else {

	$class = elgg_extract('img_class', $vars, '');
	
	if (isset($entity->name)) {
		$title = $entity->name;
	} else {
		$title = $entity->title;
	}
	$title = htmlspecialchars($title, ENT_QUOTES, 'UTF-8', false);
	
	$url = $entity->getURL();
	if (isset($vars['href'])) {
		$url = $vars['href'];
	}
	
	if ($entity->getSubtype() == 'localgroup') {
		$src = elgg_get_site_url() . '/mod/elgg-ggouv_template/views/default/icon/localgroupicon.php?cp=' . $entity->guid . '&size=' . $size;
	} else {
		$src = $entity->getIconURL($vars['size']);
	}
	
	$img = elgg_view('output/img', array(
		'src' => $src,
		'alt' => $title,
		'class' => $class,
		'width' => $size != 'master' ? $icon_sizes[$size]['w'] : NULL,
		'height' => $size != 'master' ? $icon_sizes[$size]['h'] : NULL,
	));
	
	if ($url) {
		$params = array(
			'href' => $url,
			'text' => $img,
			'is_trusted' => true,
		);
		$class = elgg_extract('link_class', $vars, '');
		if ($class) {
			$params['class'] = $class;
		}
	
		echo elgg_view('output/url', $params);
	} else {
		echo $img;
	}

}
