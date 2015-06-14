<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
*@author: Abu Sayem
*@email: sayem@asteriskbd.com
*/

$config['useragent'] = 'CodeIgniter';
$config['protocol'] = 'smtp';
//$config['mailpath'] = 'ssl://smtp.googlemail.com';
$config['smtp_host'] = 'tls://smtp.googlemail.com';
$config['smtp_user'] = 'your google account';
$config['smtp_pass'] = 'Password';
$config['smtp_port'] = 465; 
$config['smtp_timeout'] = 20;
$config['wordwrap'] = TRUE;
$config['wrapchars'] = 76;
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['validate'] = FALSE;
$config['priority'] = 3;
$config['crlf'] = "\r\n";
$config['newline'] = "\r\n";
$config['bcc_batch_mode'] = FALSE;
$config['bcc_batch_size'] = 200;
