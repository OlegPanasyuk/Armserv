<?php
Function DateDiff ($interval,$date1,$date2) {
    // �������� ���������� ������ ����� ����� ������ 
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
       //������ ������������������ ������� 
        $nod = array (31,31,28,31,30,31,30,31,31,30,31,30,31,31); 
		if ($ac_year%4==0) {$nod[2]=29;} 
        return $nod[$ac_month];
}

function getMonthName($ac_month) 
{//������ �������� ������� 
         $mon_name = array 
        ( 
        "�������","������","�������","����","������","���","����", 
        "����","������","��������","�������","������","�������","������" 
        ); 
        return $mon_name[$ac_month-0];
}

function rdate($date=0,$format='') { 
  // � �������� ���� �������� unix timestamp � date ��� datetime �� mysql 
  // ������ - ������� ������ date() � ����� ����������� 
  // \P (����������) - ������� �������� ������ � ������������ ������ 
  // \p (����������) - ������� �������� ������ � ����������� ������ 

  if (!$date) $date=time(); 
  elseif (preg_match('!(\d{4})-(\d{2})-(\d{2})( (\d{2}):(\d{2}):(\d{2}))?!',$date,$m)) { 
    if (!isset($m[4])) $m[5]=$m[6]=$m[7]=0; 
     $date=mktime($m[5],$m[6],$m[7],$m[2],$m[3],$m[1]);

  } 
  if(!$format) { 
    $format='d.m.y H:i:s'; 
    if (!isset($m[4])) $format='d.m.y'; 
  } 
  $rmon=array('���','���','���','���', 
  '���','���','���','���','���', 
  '���','���','���'); 
  $format=str_replace('\P',$rmon[date('n',$date)-1],$format); 
  $rmon=array('������','�������','�����','������', 
  '���','����','����','�������','��������', 
  '�������','������','�������'); 
  $format=str_replace('\p',$rmon[date('n',$date)-1],$format); 
  return date($format,$date); 

} 

//�������: 
//echo rdate().'<br>'; 
//echo rdate(0,'d \p Y ����').'<br>'; 
//echo rdate(0,' \P-Y �').'<br>'; 

function format_date_html($mysql_date,$case)
{
$array=explode('-',$mysql_date); //��������� mysql ���� �� ������

//������� ������� �������� ������� ��� ����������� ������
$month['01']='������';
$month['02']='�������';
$month['03']='�����';
$month['04']='������';
$month['05']='���';
$month['06']='����';
$month['07']='����';
$month['08']='�������';
$month['09']='��������';
$month['10']='�������';
$month['11']='������';
$month['12']='�������';

if($array[2]<10) //���� ���� ������ ������ ������, �� ������� ���� ����� ������
{
$array[2]=str_replace(0,'',$array[2]);
}

$day=date('d',mktime(0,0,0,$array[1],$array[2],$array[0])); //�������� ���� ������ ��� ������ ����

if($case==2) //���� $case=2, �� ���������� ��� ������ � ����������� ������
{
$weekday['mon']='�����������';
$weekday['tue']='�������';
$weekday['wed']='�����';
$weekday['thu']='�������';
$weekday['fri']='�������';
$weekday['sat']='�������';
$weekday['sun']='�����������';
}
else //� ���� ���, �� � ������������
{
$weekday['mon']='�����������';
$weekday['tue']='�������';
$weekday['wed']='�����';
$weekday['thu']='�������';
$weekday['fri']='�������';
$weekday['sat']='�������';
$weekday['sun']='�����������';
}

//���������� ����������������� ����
return $weekday[$day] . ', ' . $array[2] . ' ' . $month[$array[1]] . ' ' . $array[0] . ' ����';
}  

 $filename='include/options.ini';
 $options = parse_ini_file($filename)or die("���������� ��������� ���� ��������!"); 
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
