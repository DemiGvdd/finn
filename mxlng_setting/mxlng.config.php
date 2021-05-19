<?php
$mxlng_setup =[
"priority" => 0, 
"sleeptime"=> 0, 
"ratio"    => 0, 
"userremoveline" => 0, 
"sendAttach" => 0, 
"redirect" => 0, 
"replacement" => 1, 
"msgfile" => "mxlng_file/mxlng_letter/letter.html",
"lead"     => "mxlng_file/mxlng_lead/list.txt",
"attchFlder" => "mxlng_file/mxlng_attach/attach.html",
"attchName" => "<[mxlng_domain0]>.html",


"fromname_encrypt" => 0, 
"fromname"=> [
"<[mxlng_domain0]>", 
],

"subject_encrypt" => 0, 
"subject"=> [
"Check Issue on maiI #<[mxlng_randstring]>", 
],

"frommail"=> "<[mxlng_domain0]>@resurrectionlutheran.org",

"scampage" => [
"https://fb.com/", 
],
  
];

$smtp_acc = [
["host" => "secure.emailsrvr.com","port" => "587","username" => "pastor@resurrectionlutheran.org","password" => "491torage"], 
  
];



?>