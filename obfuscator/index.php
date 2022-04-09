
<?php if (!empty($_POST)): ?>

	<?php if ($_POST["type"]=="encode"): ?>

		<!-- ENCODER -->
		<?php
		recurse_copy_encode($_POST["source"],$_POST["destination"]);
		?>

	<?php else: ?>


		<?php
		recurse_copy_decode($_POST["source"],$_POST["destination"]);
		?>

		
	<?php endif ?>


	<!DOCTYPE html>
		<html>
		<head>
			<title>Tarkiman Obfuscator</title>
		</head>
		<body>

		<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

		<select name="type">
			<option value="encode">ENCODE</option>
			<option value="decode">DECODE</option>		
		</select>
		<hr/>

		Source :
		<hr/>
		<textarea name="source" cols="100" rows="1">D:/wamp/www/pharmacy</textarea>
		<br/>

		Destination :
		<hr/>
		<textarea name="destination" cols="100" rows="1">D:/wamp/www/pharmacy_encode</textarea>
		<br/>
		<br/>

		<input type="submit" value="Execute">
		</form>

		</body>
	</html>


<?php else: ?>

    <!DOCTYPE html>
	<html>
	<head>
		<title>Tarkiman Obfuscator</title>
	</head>
	<body>

	<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">

	<select name="type">
		<option value="encode">ENCODE</option>
		<option value="decode">DECODE</option>		
	</select>
	<hr/>

	Source :
	<hr/>
	<textarea name="source" cols="100" rows="1">D:/wamp/www/pharmacy</textarea>
	<br/>


	Destination :
	<hr/>
	<textarea name="destination" cols="100" rows="1">D:/wamp/www/pharmacy_encode</textarea>
	<br/>
	<br/>

	<input type="submit" value="Execute">


	</form>

	</body>
	</html>


<?php endif; ?>

<?php 

function recurse_copy_encode($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
            	//var_dump($file);
                recurse_copy_encode($src . '/' . $file,$dst . '/' . $file); 
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


function recurse_copy_decode($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
            	//var_dump($file);
                recurse_copy_decode($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 

                if(substr($file, -4)=='.php'){

                	//var_dump($dst . '/' . $file);

                	$file_php = $dst . '/' . $file;

                	/*TARKIMAN OBFUSCATOR*/

                	$_F=__FILE__;
					$encode = file_get_contents($file_php);
					$_X = substr($encode, strpos($encode, "='") + 2, strpos($encode, "';") - strpos($encode, "='") - 2);
					$_X=base64_decode($_X);
					$_X=strtr($_X,'123456aouie','aouie123456');
					$_R=preg_replace('/__FILE__/',"'".$_F."'",$_X);
					$_R=substr($_R, 2, strlen($_R)-2); 
					file_put_contents($file_php, $_R);
					/*TARKIMAN OBFUSCATOR*/

                }
            } 
        } 
    } 
    closedir($dir); 
}


?>

