<?php
/*
 * All action require a token. Refresh token could not be done by elgg core action handler and elgg.action in js.
 * So we have to call this file directly with ajax.

 */
include_once dirname(__FILE__) . '/../../../engine/start.php';
$ts = time();
$token = generate_action_token($ts);

echo json_encode(array('__elgg_ts' => $ts, '__elgg_token' => $token));