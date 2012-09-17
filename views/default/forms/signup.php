<?php
/**
 * Elgg register form
 *
 * @package Elgg
 * @subpackage Core
 */

$password = $password2 = '';
$username = get_input('u');
$email = get_input('e');
$name = get_input('n');
$location = get_input('l');

if (elgg_is_sticky_form('register')) {
	extract(elgg_get_sticky_values('register'));
	elgg_clear_sticky_form('register');
}

?>
<br/><div>
	<label><?php echo elgg_echo('Choisissez un pseudo'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'username',
		'value' => $username,
		'class' => 'elgg-autofocus required namecheckcar',
		'minlength' => 4,
		'maxlength' => 30
	));
	?>
</div>
<div class="mtm">
	<label><?php echo elgg_echo('Votre nom réel'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'name',
		'value' => $name,
		'class' => 'required',
		'maxlength' => 90
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('email'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'email',
		'value' => $email,
		'class' => 'required email',
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('Code postal'); ?></label><br />
	<?php
	echo elgg_view('input/text', array(
		'name' => 'location',
		'value' => $location,
		'class' => 'required digits',
		'minlength' => 5,
		'maxlength' => 5
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('password'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'id' => 'password',
		'name' => 'password',
		'value' => $password,
		'class' => 'required',
		'minlength' => 6,
	));
	?>
</div>
<div>
	<label><?php echo elgg_echo('passwordagain'); ?></label><br />
	<?php
	echo elgg_view('input/password', array(
		'name' => 'password2',
		'value' => $password2,
		'class' => 'required',
		'equalTo' => '#password',
		'minlength' => 6,
	));
	?>
</div>

<?php
// view to extend to add more fields to the registration form
echo elgg_view('register/extend');

// Add captcha hook
echo elgg_view('input/captcha');

echo '<div class="elgg-foot">';
echo elgg_view('input/hidden', array('name' => 'friend_guid', 'value' => $vars['friend_guid']));
echo elgg_view('input/hidden', array('name' => 'invitecode', 'value' => $vars['invitecode']));
echo elgg_view('input/submit', array('name' => 'submit', 'value' => elgg_echo('register')));
echo '</div>';