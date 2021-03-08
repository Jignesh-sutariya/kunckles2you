<?php defined('BASEPATH') OR exit('No direct script access allowed');

function my_crypt($string, $action = 'e' )
{
    $secret_key = sha1(APP_NAME).'_key';
    $secret_iv = sha1(APP_NAME).'_iv';

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    if( $action == 'e' ) 
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    
    else if( $action == 'd' )
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );

    return $output;
}

function re($array='')
{
    echo "<pre>";
    print_r($array);
    exit;
}

function admin($url='')
{
    return "adminPanel/$url";
}

function web($url='')
{
    return "web/$url";
}

function e_id($id)
{
    return $id * 44545;
}

function d_id($id)
{
    return $id / 44545;
}

function day()
{
    return getdate(time())['weekday'];
}

function flashMsg($success, $succmsg, $failmsg, $redirect)
{
    $CI =& get_instance();
    
    if ($success)
        $CI->session->set_flashdata('success',$succmsg);
    else
        $CI->session->set_flashdata('error', $failmsg);
    
    return redirect($redirect);
}