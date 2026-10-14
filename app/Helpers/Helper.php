<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

function slugify($text)
{
    // replace non letter or digits by -
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);

    // check if the string is valid UTF-8 before attempting transliteration
    if (mb_check_encoding($text, 'UTF-8')) {
        // transliterate to ASCII
        $text = @iconv('UTF-8', 'US-ASCII//TRANSLIT', $text);
    } else {
        // If the input is not valid UTF-8, handle it accordingly (e.g., log, or skip iconv)
        // Optionally remove invalid characters or fallback to some safe handling
        $text = preg_replace('/[^\x20-\x7E]/', '', $text); // Removes non-ASCII characters
    }

    // remove unwanted characters
    $text = preg_replace('~[^-\w]+~', '', $text);

    // trim leading/trailing hyphens
    $text = trim($text, '-');

    // remove duplicate hyphens
    $text = preg_replace('~-+~', '-', $text);

    // convert to lowercase
    $text = strtolower($text);

    // fallback to 'n-a' if resulting slug is empty
    if (empty($text)) {
        return 'n-a';
    }

    return $text;
}

function amountInWords($num = false)
{
    $num = str_replace(',', '', $num);
    $num = number_format($num, 2, '.', '');
    $num_arr = explode('.', $num);
    $num = $num_arr[0];
    $num_dec = $num_arr[1];
    $words = '';
    $list1 = array(
        "",
        "one",
        "two",
        "three",
        "four",
        "five",
        "six",
        "seven",
        "eight",
        "nine",
        "ten",
        "eleven",
        "twelve",
        "thirteen",
        "fourteen",
        "fifteen",
        "sixteen",
        "seventeen",
        "eighteen",
        "nineteen"
    );
    $list2 = array(
        "",
        "ten",
        "twenty",
        "thirty",
        "forty",
        "fifty",
        "sixty",
        "seventy",
        "eighty",
        "ninety"
    );
    $list3 = array(
        "",
        "thousand",
        "million",
        "billion",
        "trillion",
        "quadrillion",
        "quintillion",
        "sextillion",
        "septillion",
        "octillion",
        "nonillion"
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ($tens < 20) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
        } else {
            $tens = (int) ($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words .= ($hundreds . $tens . $singles);
        if ($levels && $num_levels[$i]) {
            $words .= ' ' . $list3[$levels] . ' ';
        }
    }
    if (empty($words)) {
        $words = 'zero';
    }
    $words = trim($words);
    $words = ucfirst($words);
    $words = preg_replace('/\s+/', ' ', $words);

    if ($num_dec > 0) {
        $words .= ' Taka and ' . amountInWords($num_dec) . ' Paisa';
    } else {
        $words .= ' Taka';
    }

    return $words;
}

function phoneNumberFormat($number)
{
    $number = preg_replace('/\D/', '', $number);
    $number = substr($number, -11);
    if (strlen($number) != 11) {
        return false;
    } else {
        return '+88' . $number;
    }

    return false;
}

function sendSms($number, $message)
{
    $apiUrl = 'https://smsplus.sslwireless.com/api/v3/send-sms';
    $api_token = "yt6a58ui-yaagpraa-mydezi2g-imlosbsv-ph8dlylg";
    $sid = 'ALIFSUPERNON';
    $msisdn = $number;
    $sms = $message;
    $csms_id = '4473433434pZ684333401';

    $response = Http::post($apiUrl, [
        'api_token' => $api_token,
        'sid' => $sid,
        'msisdn' => $msisdn,
        'sms' => $sms,
        'csms_id' => $csms_id
    ]);
    Log::info('SMS Send: ' . $response->body());
}

function upload_pdf($file)
{
    $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // without extension
    $extension = $file->getClientOriginalExtension();
    $slug = slugify($originalName);
    $filename = $slug . '-' . time() . '.' . $extension;
    $path = 'uploads/pdfs/';
    $file->move(public_path($path), $filename);

    return $path . $filename;
}

function deletePdf($file)
{
    if (file_exists(public_path($file))) {
        @unlink(public_path($file));
    }
}

function setting()
{
    return DB::table('settings')->first();
}

function hasPermission(array $permissions = []): bool
{
    $user = auth()->user();
    if ($user->hasRole('Super Admin')) {
        return true;
    }

    return $user->canAny($permissions);
}

