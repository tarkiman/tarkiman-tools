<?php 

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
            	//var_dump($file);
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 

                if(substr($file, -4)=='.php'){

                	//var_dump($dst . '/' . $file);

                	$file_php = $dst . '/' . $file;

                	/*TARKIMAN OBFUSCATOR*/

                	$php_code = file_get_contents($file_php);
					//$_F=__FILE__;
					$_X='?>'.$php_code;
					$_X=strtr($_X,'aouie123456','123456aouie');
					$_X=base64_encode($_X);
					//$_R=preg_replace('/__FILE__/',"'".$_F."'",$_X);
					$result = "<?php \$_F=__FILE__;\$_X='".$_X."';
							eval(base64_decode('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCcxMjM0NTZhb3VpZScsJ2FvdWllMTIzNDU2Jyk7JF9SPXByZWdfcmVwbGFjZSgnL19fRklMRV9fLycsIiciLiRfRi4iJyIsJF9YKTtldmFsKCRfUik7JF9SPTA7JF9YPTA7'));?>";
					file_put_contents($file_php, $result); 
					//echo str_replace('<','&lt',str_replace('>','&gt',$result));
					/*TARKIMAN OBFUSCATOR*/

                }
            } 
        } 
    } 
    closedir($dir); 
}

recurse_copy('D:/wamp/www/pharmacy','D:/wamp/www/pharmacy_golive');
?>