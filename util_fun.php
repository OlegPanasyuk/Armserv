<?php
Function DateDiff ($interval,$date1,$date2) {
    // получает количество секунд между двумя датами 
    $timedifference = $date2 - $date1;

    switch ($interval) {
        case 'w':
            $retval = bcdiv($timedifference,604800);
            break;
        case 'd':
            $retval = bcdiv($timedifference,86400);
            break;
        case 'h':
            $retval =bcdiv($timedifference,3600);
            break;
        case 'n':
            $retval = bcdiv($timedifference,60);
            break;
        case 's':
            $retval = $timedifference;
            break;
            
    }
    return $retval;

}

function str2date($in){
$t = split("/",$in);
if (count($t)!=3) $t = split("-",$in);
if (count($t)!=3) $t = split(" ",$in);
if (count($t)!=3) return -1;
if (!is_numeric($t[0])) return -1;
if (!is_numeric($t[1])) return -2;
if (!is_numeric($t[2])) return -3;

if ($t[0]<1902 || $t[0]>2037) return -3;
return mktime (0,0,0, $t[1], $t[2], $t[0]);
}

function getDays($ac_month,$ac_year) 
{
       //Массив продолжительностей месяцев 
        $nod = array (31,31,28,31,30,31,30,31,31,30,31,30,31,31); 
		if ($ac_year%4==0) {$nod[2]=29;} 
        return $nod[$ac_month];
}

function getMonthName($ac_month) 
{//Массив названий месяцев 
         $mon_name = array 
        ( 
        "Декабрь","Январь","Февраль","Март","Апрель","Май","Июнь", 
        "Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь","Январь" 
        ); 
        return $mon_name[$ac_month-0];
}

function rdate($date=0,$format='') { 
  // в качестве даты понимает unix timestamp и date или datetime из mysql 
  // формат - обычный формат date() с одним исключением 
  // \P (латиниская) - русское название месяца в именительном падеже 
  // \p (латиниская) - русское название месяца в родительном падеже 

  if (!$date) $date=time(); 
  elseif (preg_match('!(\d{4})-(\d{2})-(\d{2})( (\d{2}):(\d{2}):(\d{2}))?!',$date,$m)) { 
    if (!isset($m[4])) $m[5]=$m[6]=$m[7]=0; 
     $date=mktime($m[5],$m[6],$m[7],$m[2],$m[3],$m[1]);

  } 
  if(!$format) { 
    $format='d.m.y H:i:s'; 
    if (!isset($m[4])) $format='d.m.y'; 
  } 
  $rmon=array('янв','фев','мар','апр', 
  'май','июн','июл','авг','сен', 
  'окт','ноя','дек'); 
  $format=str_replace('\P',$rmon[date('n',$date)-1],$format); 
  $rmon=array('января','февраля','марта','апреля', 
  'мая','июня','июля','августа','сентября', 
  'октября','ноября','декабря'); 
  $format=str_replace('\p',$rmon[date('n',$date)-1],$format); 
  return date($format,$date); 

} 

//примеры: 
//echo rdate().'<br>'; 
//echo rdate(0,'d \p Y года').'<br>'; 
//echo rdate(0,' \P-Y г').'<br>'; 

function format_date_html($mysql_date,$case)
{
$array=explode('-',$mysql_date); //Разбиваем mysql дату на массив

//Создаем русские названия месяцев для последующей замены
$month['01']='января';
$month['02']='февраля';
$month['03']='марта';
$month['04']='апреля';
$month['05']='мая';
$month['06']='июня';
$month['07']='июля';
$month['08']='августа';
$month['09']='сентября';
$month['10']='октября';
$month['11']='ноября';
$month['12']='декабря';

if($array[2]<10) //Если день месяца меньше десяти, то убераем ноль перед числом
{
$array[2]=str_replace(0,'',$array[2]);
}

$day=date('d',mktime(0,0,0,$array[1],$array[2],$array[0])); //Получаем день недели для данной даты

if($case==2) //Если $case=2, то используем дни недели в винительном падеже
{
$weekday['mon']='понедельник';
$weekday['tue']='вторник';
$weekday['wed']='среду';
$weekday['thu']='четверг';
$weekday['fri']='пятницу';
$weekday['sat']='субботу';
$weekday['sun']='воскресенье';
}
else //А если нет, то в именительном
{
$weekday['mon']='Понедельник';
$weekday['tue']='Вторник';
$weekday['wed']='Среда';
$weekday['thu']='Четверг';
$weekday['fri']='Пятница';
$weekday['sat']='Суббота';
$weekday['sun']='Воскресенье';
}

//Возвращаем отформатированную дату
return $weekday[$day] . ', ' . $array[2] . ' ' . $month[$array[1]] . ' ' . $array[0] . ' года';
}  

 $filename='include/options.ini';
 $options = parse_ini_file($filename)or die("Невозможно прочитать файл настроек!"); 
 $prec = $options['Prec']; 
 
function format($value)
{
 global $prec;
$string=str_replace("A"," ",number_format($value,$prec,".","A"));
$string = str_replace(" ", "", $string);
 return $string;
//return str_replace(".",",",$string);
// return sprintf("%01.3f",$value);
}
function format_m($value)
{
 global $prec;
$string=str_replace("A"," ",number_format($value,$prec,".","A"));
return str_replace(".",",",$string);
}
function getmicrotime(){
 list($usec, $sec) = explode(" ",microtime());
 return ((float)$usec + (float)$sec);
} 
?>
