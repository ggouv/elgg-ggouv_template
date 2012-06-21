<?php
/**
 * Elgg text output
 * Displays some text that was input using a standard text field
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['value'] The text to display
 */

echo mb_substr(htmlspecialchars($vars['value'], ENT_QUOTES, 'UTF-8', false), 0, 140);