<?php
// $dir    = 'D:/wamp/www/budgeting';
// $files1 = scandir($dir);
// $files2 = scandir($dir, 1);

// var_dump($files1);
// var_dump($files2);
?>


<?php if (!empty($_POST)): ?>

	<?php if ($_POST["type"]=="encode"): ?>

		<!-- ENCODER -->
		<?php
		$php_code = $_POST["source"];
		$_X='?>'.$php_code;
		$_X=strtr($_X,'aouie123456','123456aouie');
		$_X=base64_encode($_X);
		$result = "<?php \$_F=__FILE__;\$_X='".$_X."';
		eval(base64_decode('JF9YPWJhc2U2NF9kZWNvZGUoJF9YKTskX1g9c3RydHIoJF9YLCcxMjM0NTZhb3VpZScsJ2FvdWllMTIzNDU2Jyk7JF9SPXByZWdfcmVwbGFjZSgnL19fRklMRV9fLycsIiciLiRfRi4iJyIsJF9YKTtldmFsKCRfUik7JF9SPTA7JF9YPTA7'));?>";
		$results = str_replace('<','&lt',str_replace('>','&gt',$result));
		?>

	<?php else: ?>

		<!-- DECODER -->
		<?php
		$_F=__FILE__;
		$encode = $_POST["source"];
		$_X = substr($encode, strpos($encode, "='") + 2, strpos($encode, "';") - strpos($encode, "='") - 2);
		$_X=base64_decode($_X);
		$_X=strtr($_X,'123456aouie','aouie123456');
		$_R=preg_replace('/__FILE__/',"'".$_F."'",$_X);
		$_R=substr($_R, 2, strlen($_R)-2); 
		$results = str_replace('<','&lt',str_replace('>','&gt',$_R));
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
		<textarea name="source" cols="100" rows="20"></textarea>

		<br/>

		<input type="submit" value="Execute">

		<br/>
		<br/>
		<br/>

		Result :
		<hr/>
		<textarea name="result" cols="100" rows="20"><?php echo $results ?></textarea>
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
	<textarea name="source" cols="100" rows="20"></textarea>

	<br/>

	<input type="submit" value="Execute">

	<br/>
	<br/>
	<br/>

	Result :
	<hr/>
	<textarea name="result" cols="100" rows="20"></textarea>
	</form>

	</body>
	</html>


<?php endif; ?>

