<?
$filename="include/options.ini";
$options = @parse_ini_file($filename)or die("Невозможно прочитать файл настроек!"); 
 $path = $options['Path']; 
echo "<script language=\"VBScript\">
folder=\"".$path."\"
</script>\n";
?>
