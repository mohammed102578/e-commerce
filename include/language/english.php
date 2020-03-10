<?php

function lang($phrase){

static $lang= array(
	//navbar link
'brand'          =>'Home',
"fetures"        =>"Categoreis",
'ITEMS'          =>'Items',
'MEMPERS'        =>'Mempers',
'COMMENT'        =>'Comment',
'STATISTICS'     =>'Statistics',
'LOGS'           =>'Logs',
''=>'',
''=>'',
''=>'',
''=>'',
''=>'',
''=>'',
''=>'',
''=>'',

);

return $lang[$phrase];
  


}




?>