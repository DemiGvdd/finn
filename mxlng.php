<?php
require 'mxlng_setting/phpmailer/PHPMailerAutoload.php';
require 'mxlng_setting/phpmailer/class.phpmailer.php';
require 'mxlng_setting/phpmailer/class.smtp.php';
require 'mxlng_setting/mxlng.config.php';
require 'mxlng_setting/mxlng.function.php';
                                                  
echo "                                                             @@@@@@  @@@  @@@ @@@       @@@@@@  @@@  @@@  @@@@@@@      \n";
echo "                                                            @@!  @@@ @@!  !@@ @@!      @@!  @@@ @@!@!@@@ !@@           \n";
echo "                                                            @!@  !@!  !@@!@!  @!!      @!@  !@! @!@@!!@! !@! @!@!@     \n";
echo "\e[0;31m                                                            !!:  !!!  !: :!!  !!:      !!:  !!! !!:  !!! :!!   !!:     \e[0\n";
echo "\e[0;31m                                                             : :. :  :::  ::: : ::.: :  : :. :  ::    :   :: :: :      \e[0\n";
echo "\e[0;31m                                                                                  ╔╦╗╔═╗╦╦  ╔═╗╦═╗                 \n";
echo "\033[1;32m                                                                                  ║║║╠═╣║║  ║╣ ╠╦╝                 \n";
echo "\e[0;31m                                                                                  ╩ ╩╩ ╩╩╩═╝╚═╝╩╚═                 \n";
function SmtpType($smtp)
{
    if (preg_match('/\bsendgrid\b/',$smtp))
    {
        $type = 'SENDGRID';
    }
    else if (preg_match('/\bgmail\b/',$smtp))
    {
        $type = 'G-SUITE';
    }
    else if (preg_match('/\bsecuresmtp\b/',$smtp))
    {
        $type = 'T-ONLINE';
    }
    else if (preg_match('/\boffice365\b/',$smtp))
    {
        $type = 'OFFICE 365';
    }
    else if (preg_match('/\bemailsrvr\b/',$smtp))
    {
        $type = 'RACKSPACE';
    }
    else
    {
        $type = 'CRACKED';
    }
    return $type;
}

function Kirim($email, $smtp_acc, $mxlng_setup)
{
    global $ahh, $num;
    $smtp = new SMTP;
    $smtp->do_debug = 0;

    $smtpserver = $smtp_acc['host'];
    $smtpport = $smtp_acc['port'];
    $smtpuser = $smtp_acc['username'];
    $smtppass = $smtp_acc['password'];
    $priority = $mxlng_setup['priority'];
    $sleeptime = $mxlng_setup['sleeptime'];
    $replacement = $mxlng_setup['replacement'];
    $userremoveline = $mxlng_setup['userremoveline'];
    $fromname = $mxlng_setup['fromname'];
    $frommail = $mxlng_setup['frommail'];
    $subject = $mxlng_setup['subject'];
    $lead = $mxlng_setup['lead'];
    $msgfile = $mxlng_setup['msgfile'];
	$sendAttach     = $mxlng_setup['sendAttach'];
	$attchFlder     = $mxlng_setup['attchFlder'];
    $attchName      = $mxlng_setup['attchName'];
    $randurl = $mxlng_setup['scampage'];
    $redirect = $mxlng_setup['redirect'];
    $subject_encrypt = $mxlng_setup['subject_encrypt'];
    $fromname_encrypt = $mxlng_setup['fromname_encrypt'];
    if (!$smtp->connect($smtpserver, $smtpport)) {
        //throw new Exception('Connect failed');
        echo " [ \e[0;31mPLEASE CHECK YOUR SMTP SERVER & PORT ! CHECK UR SMTP ON http://smtper.net AND MAKE SURE UR SMTP USE PORT 587\e[0m ]\r\n";
        die();
    }


    if (!$smtp->hello(gethostname())) {
        //throw new Exception('EHLO failed: ' . $smtp->getError()['error']);
        echo " [ \e[0;31mPLEASE CHECK YOUR SMTP SERVER & PORT ! CHECK UR SMTP ON http://smtper.net AND MAKE SURE UR SMTP USE PORT 587\e[0m ]\r\n";
        die();
    }

    $e = $smtp->getServerExtList();

    if (array_key_exists('STARTTLS', $e)) {
        $tlsok = $smtp->startTLS();
        if (!$tlsok) {
            //throw new Exception('Failed to start encryption: ' . $smtp->getError()['error']);
            echo " [ \e[0;31mPLEASE CHECK YOUR SMTP SERVER & PORT ! CHECK UR SMTP ON http://smtper.net AND MAKE SURE UR SMTP USE PORT 587\e[0m ]\r\n";
            die();
        }
        if (!$smtp->hello(gethostname())) {
            //throw new Exception('EHLO (2) failed: ' . $smtp->getError()['error']);
            echo " [ \e[0;31mPLEASE CHECK YOUR SMTP SERVER & PORT ! CHECK UR SMTP ON http://smtper.net AND MAKE SURE UR SMTP USE PORT 587\e[0m ]\r\n";
            die();
        }
        $e = $smtp->getServerExtList();
    }
    $smtptypez = SmtpType($smtpserver);
    if (array_key_exists('AUTH', $e)) {

        if ($smtp->authenticate($smtpuser, $smtppass)) {
            if(!is_file($msgfile)) {
                echo " [ \e[0;31m LETTER NOT FOUND - PLEASE CHECK YOUR LETTER NAME !\e[0m ]\r\n";
                die();
            }
            if($mxlng_setup['filesend'] == 1) {
                if(!is_file($mxlng_setup['attach'])) {
                    echo " [ \e[0;31m ATTACHMENT NOT FOUND - PLEASE CHECK YOUR ATTACHMENT NAME !\e[0m ]\r\n";
                    die();
                }
            }
            $randstr023 = RandString1(16);
            $mail = new PHPMailer;
            //CREATE DKIM
            $selector = 'phpmailer';
            //Path to your private key:
            $privatekeyfile = 'setting/dkim_private.pem';
            //Path to your public key:
            $publickeyfile = 'setting/dkim_public.pem';
            $mail->Encoding = 'base64'; // 8bit base64 multipart/alternative quoted-printable
            $mail->CharSet = 'UTF-8';
            $mail->headerLine("format", "flowed");
            /*  Smtp connect    */
            $mail->addCustomHeader("MIME-Version: 1.0");
            //Start SMTP
            $mail->IsSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPAutoTLS = 1;
            $mail->Host = $smtpserver;
            $mail->Port = $smtpport;
            $mail->Priority = $priority;
            $mail->Username = $smtpuser;
            $mail->Password = $smtppass;
            if ($userandom == 1) {
                $rand     = rand(1, 50);
                $fromname = randName($rand);
                $frommail = randMail($rand);
                $subject  = randSubject($rand, $email);
            }
            
			$randstr01 = RandString1(8);
            $randstr011 = RandString(5);
            $randstr012 = RandString1(5);
            $nmbr = RandNumber(5);
            
			$domains = explode('@', $email);
            $domain = $domains[1];
            $domains1 = explode('.', $domain);
            $domain0 = $domains1[0];
 
             shuffle($subject);
            $subject  = array_shift($subject);
            shuffle($fromname);
            $fromname  = array_shift($fromname);
			
            $fromnames = str_replace('<[mxlng_domain0]>', $domain0, $fromname);
            $frommails = str_replace('<[mxlng_domain0]>', $domain0, $frommail);
			
            $fromnames = str_replace('<[mxlng_randstring]> ', $randstr011, $fromnames);
            $frommails = str_replace('<[mxlng_randstring]> ', $randstr01, $frommails);
			
            $subjects = str_replace('<[mxlng_randstring]>	 ', $randstr012,  $subject);
            $subjects = subjecting($subjects, $email, $frommail, $fromname, $randurl, $subject, $redirect);
            
			$mail->setFrom($frommails, $fromnames);
            $mail->AddAddress($email);
            $mail->Subject = $subjects;
            $mail->setFrom($frommails, $fromnames);
            $mail->AddAddress($email);
            $mail->Subject = $subjects;
			if ($mxlng_setup['sendAttach'] == 1) {
				$attchFlder = str_replace('<[mxlng_email]>',$email,file_get_contents($mxlng_setup['attchFlder']));
				$attchName = str_replace('<[mxlng_domain0]>', $domain0, $mxlng_setup['attchName']);
				$mail->addStringAttachment($attchFlder, $attchName, 'base64', 'application/octetstream');
            }
			
            if ($replacement == 1)
            {
                $msg = lettering($msgfile, $email, $frommail, $fromname, $randurl, $subject, $redirect);
            }
            else
            {
                $msg = file_get_contents($msgfile);
            }
            $mail->msgHTML($msg);
            if (!$mail->send())
            {
                $halo = $mail->ErrorInfo;
                 if (preg_match('/\bquota\b/',$halo))
                {
                    $err = 1;
                }
                if ($err == 1)
                {
                    echo "[\e[0;32m" . date('d/m/Y h:i:s A') . "[0m] ";
                    echo "[\e[1;35m";
                    echo $num + 1 . "\e[0m] ";
                    echo "\e[0m[\e[1;34m$email\e[0m] ";
                    echo "\e[0m\e==> [ \e[0m(\e[0;33m$smtpuser\e[0m)] > [\e[0;31m- SMTP SEND QUOTA HAS LIMIT - NOT REMOVED\e[0m]";
                    echo "\r\n";
                }
                else
                {
                    if ($mxlng_setup['userremoveline'] == 1)
                    {
                        echo "[\e[0;32m" . date('d/m/Y h:i:s A') . "[0m] ";
                        echo "[\e[1;35m";
                        echo $num + 1 . "\e[0m] ";
                        echo "\e[0m[\e[1;34m$email\e[0m] ";
                        echo "\e[0m\e==> [\e[0m(\e[0;33m$smtpuser\e[0m)] > [\e[0;31mEMAIL NOT VALID - REMOVED\e[0m]";
                        echo "\r\n";
                        Savedata($mxlng_setup['lead'], trim(str_replace($email, "", file_get_contents($mxlng_setup['lead']))));
                        $file = fopen("mxlng_invalid.txt", "a+");
                        fwrite($file, "$email");
                        fclose($file);
                    }
                    else
                    {
                        echo "[\e[0;32m" . date('d/m/Y h:i:s A') . "[0m] ";
                        echo "[\e[1;35m";
                        echo $num + 1 . "\e[0m] ";
                        echo "\e[0m[\e[1;34m$email\e[0m] ";
                        echo "\e[0m\e==> [ \e[0m(\e[0;33m$smtpuser\e[0m)] > [\e[0;31m- EMAIL NOT VALID - NOT REMOVED\e[0m]";
                        echo "\r\n";
                    }
                    //exit();
                    
                }
            }
            else
            {
                echo "                              [\e[0;32m" . date('d/m/Y h:i:s A') . "[0m] ";
                echo "[\e[1;35m";
                echo $num + 1 . "\e[0m] ";
                echo "\e[0m[\e[1;34m$email\e[0m] ";
                echo "\e[0m==> [ \e[0m(\e[0;33m$smtpuser\e[0m)] > [\e[0;32m- EMAIL VALID - SPAMMED\e[0m]";
                echo "\r\n";
                $file = fopen("mxlng_sp4mmed.txt", "a");
                fwrite($file, "" . $email . " ");
                fclose($file);
            }
            $mail->clearAddresses();
        }
        else
        {
            echo "                       [\e[0;32m" . date('d/m/Y h:i:s A') . "[0m] ";
            echo "[\e[1;35m";
            echo $num + 1 . "\e[0m] ";;
            echo "\e[0m[\e[1;34m$email\e[0m] ";
            echo "\e[0m\e==> [ \e[0m(\e[0;33m$smtpuser\e[0m)] > [\e[0;31m- SOMETHING WRONG ON SMTP - NOT REMOVED\e[0m]";
            echo "\r\n";
            $file = fopen("mxlng_failed.txt", "a");
            fwrite($file, "" . $email . " ");
            fclose($file);
        }
    }
    $smtp->quit(true);
}
$dipake = 0;
if (!is_file($mxlng_setup['lead']))
{
    echo "                                                                        [ \e[0;31m MAILIST NOT FOUND - PLEASE CHECK YOUR MAILIST NAME !\e[0m ]";
    die();
}
$file = file_get_contents($mxlng_setup['lead']);
if ($file)
{
    $ext = explode("\n", $file);
    echo "\e[0;31m                                                  ============================= [ CAMPAIGN SCRIPT RE4DY ] =============================\e[0";
    echo "\r\n";
    $smtp_key = 0;
    $rat = $mxlng_setup['ratio'];
    $crot = 0;
    $crotmax = count($ext) - 1;
    foreach ($ext as $num => $email)
    {
        if ($smtp_key == count($smtp_acc))
        {
            $smtp_key = 0;
        }

        $ahh = $ext[$crot];
        $gx_setup['fromname'] = $ahh;
        $crot++;
        if ($crot >= $crotmax)
        {
            $crot = 0;
        }
        //kirim
        Kirim($email, $smtp_acc[$smtp_key], $mxlng_setup);
        $dipake++;
        $smtp_key++;
        $rat--;
        if ($rat == 0)
        {
            sleep($mxlng_setup['sleeptime']);
            $rat = $mxlng_setup['ratio'];

            echo "\r\n";
            echo "\e[31m                                                                      ======= CAMPAIGN $rat EMAIL(S) WITH DELAY FOR ";
            echo $mxlng_setup['sleeptime'];
            echo " SECONDS  =======\e[0m ";
            echo "\r\n";
            echo "\r\n";
        }

        if ($mxlng_setup['userremoveline'] == 1)
        {
            unset($ext[$num]);
            Savedata($mxlng_setup['lead'], implode("", $ext));
        }
    }
    echo "                                                   ============================= [ CAMPAIGN SCRIPT ENDED ] =============================";
    echo "\r\n";
}

