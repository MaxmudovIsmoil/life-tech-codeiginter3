<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if ( ! function_exists('uniqe_code_genetrator'))
{
    function uniqe_code_genetrator($prefix, $last_id)
    {
    	$last_id = ++$last_id;

        $code = str_pad($last_id,  4, '0', STR_PAD_LEFT);
        return $prefix.$code;
    }
}


/** Hafta kunlari uchun */
if (! function_exists('get_week_days'))
{
    function get_week_days($dushanba, $seshanba, $chorshanba, $payshanba, $juma, $shanba, $yakshanba) {
        $week_text = "";
        if($dushanba == 1)
            $week_text .= "Dushanba, ";

        if($seshanba == 1)
            $week_text .= "Seshanba, ";

        if($chorshanba == 1)
            $week_text .= "Chorshanba, ";

        if($payshanba == 1)
            $week_text .= "Payshanba, ";

        if($juma == 1)
            $week_text .= "Juma, ";

        if($shanba == 1)
            $week_text .= "Shanba, ";

        if($yakshanba == 1)
            $week_text .= "Yakshanba, ";

        return substr($week_text, 0, -2);
    }
}




/** Telefon nomerni formatlab chiqarish uchun */
if (! function_exists('phone_format_helper') )
{
    function phone_format_helper($phone)
    {
        $reslut = "(".mb_substr($phone, 4, 2).") ".mb_substr($phone, 6, 3)."-".mb_substr($phone, 9, 2)."-".mb_substr($phone, -2);
        return $reslut;
    }
}

if (! function_exists('format_money'))
{
    function format_money($money)
    {
       return number_format($money,0,","," ");
    }
}