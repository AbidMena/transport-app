<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Authorize.net Account Info
$send = getsettingsdetails();
$config['api_login_id'] = $send->authorize_id;
$config['api_transaction_key'] = $send->authorize_key;
$config['api_url'] = $send->authorize_net_url; // TEST URL*/
//$config['api_url'] = 'https://secure.authorize.net/gateway/transact.dll'; // PRODUCTION URL

/* EOF */

/*$config['api_login_id'] = '5Cvr8Z5e';
$config['api_transaction_key'] = '2nTNQcg3748C9krK';
$config['api_url'] = 'https://test.authorize.net/gateway/transact.dll';*/