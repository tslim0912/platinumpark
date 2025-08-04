<?php

if (!function_exists("_currency_format")) {

    function _currency_format($text) {
        
        return number_format($text, 2, '.', ',');
    }

}

if (!function_exists("_number_format")) {

    function _number_format($number) {
        
        return $number + 0;
    }

}

if (!function_exists("_alc_date_format")) {

    function _alc_date_format($text) {

        if($text == 0){
            return "-";
        }
        return Carbon\Carbon::createFromFormat('dmY', str_pad($text, 8, '0', STR_PAD_LEFT))->format('Y-m-d');
    }

}


if (!function_exists("_dmy_display_format")) {

    function _dmy_display_format($text) {

        if($text == 0){
            return "-";
        }
        return Carbon\Carbon::createFromFormat('Y-m-d', str_pad($text, 8, '0', STR_PAD_LEFT))->format('d-m-Y');
    }

}

if (!function_exists("_add_rank_column")) {

    function _add_rank_column($row, $index) {
        $row->rank = $index+1;
        return $row;
    }

}

if (!function_exists("_yearmonth_display_format")) {

    function _yearmonth_display_format($text) {

        if($text == 0){
            return "-";
        }
        return Carbon\Carbon::createFromFormat('Ym', $text)->format('F Y');
    }

}

if (!function_exists("_issued_date")) {

    function _issued_date() {
        $file_date = App\PolicyFile::orderby('file_date', 'desc')->first()->file_date ?? date('Y-m-d');
        return \Carbon\Carbon::parse($file_date)->format('d-m-Y');
    }

}

if (!function_exists("_submission_date")) {

    function _submission_date() {
        if(config('general.lock_submission_report_date') != ''){
            return \Carbon\Carbon::parse(config('general.lock_submission_report_date'))->format('d-m-Y');
        }
        return \Carbon\Carbon::now()->format('d-m-Y');
    }

}

if (!function_exists("_last_commission_file_date")) {

    function _last_commission_file_date() {

        $system_date = _system_date();
        $last_commission_file_date = \App\CommissionFile::whereDate('file_date', '<=', $system_date->today)
                                                ->orderby('file_date', 'desc')
                                                ->first();

        return $last_commission_file_date ? \Carbon\Carbon::parse($last_commission_file_date->file_date)->format('d-m-Y') : '-';
    }

}

if (!function_exists("_yearmonth_dash_format")) {

    function _yearmonth_dash_format($text) {

        if($text == 0){
            return "-";
        }
        return Carbon\Carbon::createFromFormat('Ym', $text)->format('Y-m');
    }

}

if (!function_exists("_system_date")) {

    function _system_date() {
        $year = date('Y');
        $month = date('m');
        $today = date('Y-m-d');
    
        if(config('general.lock_submission_report_date') != ''){
            $year = substr(config('general.lock_submission_report_date'), 0, 4);
            $month = substr(config('general.lock_submission_report_date'), 4, 2);
            $today = Carbon\Carbon::createFromFormat('Ymd', config('general.lock_submission_report_date'))->format('Y-m-d');
        }

        $system_date = new stdClass();
        $system_date->year = $year;
        $system_date->yearmonth = $year.$month;
        $system_date->month = $month;
        $system_date->today = $today;

        return $system_date;
    }

}

if (!function_exists("_generate_strong_password")) {

    function _generate_strong_password($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';

        $all = '';
        $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];

        $password = str_shuffle($password);

        if(!$add_dashes)
            return $password;

        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

}