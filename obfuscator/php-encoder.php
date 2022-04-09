<?php

$php_code = file_get_contents("decoded.php");
//$_F=__FILE__;
$_X='?>'.$php_code;
$_X=strtr($_X,'aouie123456','123456aouie');
$_X=base64_encode($_X);
//$_R=preg_replace('/__FILE__/',"'".$_F."'",$_X);
$result = "<?php \$_F=__FILE__;\$_X='".$_X."';
		eval(base64_decode('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCcxMjM0NTZhb3VpZScsJ2FvdWllMTIzNDU2Jyk7JF9SPXByZWdfcmVwbGFjZSgnL19fRklMRV9fLycsIiciLiRfRi4iJyIsJF9YKTtldmFsKCRfUik7JF9SPTA7JF9YPTA7'));?>";
file_put_contents("encoded.php", $result); 
echo str_replace('<','&lt',str_replace('>','&gt',$result));
?>