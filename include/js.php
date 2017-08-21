<?
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!"); 
 $ip = $options['IP']; 
 $port = $options['Port']; 
 $timeout = $options['Timeout']; 
 $freq = $options['Freq']; 
echo "<script>
var IP='".$ip."';
var Port=".$port.";
var Timeout=".sprintf("%01.0f",$timeout).";
var Frequency=".sprintf("%01.0f",$freq).";
</script>";
?>
