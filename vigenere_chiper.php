<?php
# Vigenere Chiper with PHP
# Rosdyana Kusuma - rosdyana.kusuma@gmail.com
# Encrypt and Decrypt with Vigenere Chiper
 
class vigenere_main{
	function __construct($text, $key, $isEncrypt){
		$isEncrypt = strtoupper($isEncrypt);
		if(empty($text) || empty($key) || empty($isEncrypt)
			|| ($isEncrypt!='-E') || ($isEncrypt!='-D')){
			$this->help();
			exit;
		}
 
		if($isEncrypt=='-E'){
			$this->encrypt($text, $key);
		}
		else if ($isEncrypt=='-D'){
			$this->decrypt($text, $key);
		}
	}
	function vigenere($text, $key, $isEncrypt){
		$alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 
		$text = strtoupper($text);
		$key = strtoupper($key);
		$original = $key;
 
		while(strlen($key) < strlen($text)) $key.= $original;
 
		$result = '';
 
		for($i = 0; $i < strlen($text); $i++) {
			if($text[$i] == ' ') {
				$result.=$text[$i]; continue;
			}
			$index = strpos($alphabet,$text[$i]);
 
			if($index < 0) $result .= $text[$i];
			else {
				$k = strpos($alphabet,$key[$i]);
 
				$index+=$isEncrypt?$k:strlen($alphabet)-$k;
 
				$result.=$alphabet[$index % strlen($alphabet)];
			}
		}
		print $result;
	}
 
	function encrypt($text, $key) {
		return $this->vigenere($text, $key, true);
	}
 
	function decrypt($text, $key) {
		return $this->vigenere($text, $key, false);
	}
 
	function help(){
		echo("
____   ____.__                                           
\   \ /   /|__| ____   ____   ____   ___________   ____  
 \   Y   / |  |/ ___\_/ __ \ /    \_/ __ \_  __ \_/ __ \ 
  \     /  |  / /_/  >  ___/|   |  \  ___/|  | \/\  ___/ 
   \___/   |__\___  / \___  >___|  /\___  >__|    \___  >
             /_____/      \/     \/     \/            \/ 
			");
		print "\nHow to use it:\n";
		print "vigenere_chiper.php < 'text'> <key> < -d for decrypt -e for encrypt>\n";
		print "vigenere_chiper.php 'aku sayang kamu' 11nov -e\n";
	}
}
 
$vigenere_chiper = new vigenere_main($argv[1], $argv[2], $argv[3]);
 
?>
