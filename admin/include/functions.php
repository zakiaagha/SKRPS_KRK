<?php
function redirect($url) {

    echo "<script>\n";
    echo "<!-- hide from old browser\n\n";

    echo "window.location = \"" . $url . "\";\n";

    echo "-->\n";
    echo "</script>\n";

    return true;
}

function set_rights($menus, $menuRights, $topmenu) {
    $data = array();

    for ($i = 0, $c = count($menus); $i < $c; $i++) {


        $row = array();
        for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
            if ($menuRights[$j]["mfr_modulecode"] == $menus[$i]["mf_modulecode"]) {
                if (authorize($menuRights[$j]["mfr_create"]) || authorize($menuRights[$j]["mfr_edit"]) ||
                        authorize($menuRights[$j]["mfr_delete"]) || authorize($menuRights[$j]["mfr_view"])
                ) {

                    $row["menu"] = $menus[$i]["mf_groupcode"];
                    $row["menu_name"] = $menus[$i]["mf_modulename"];
                    $row["folder_name"] = $menus[$i]["mf_groupfoldername"];
                    $row["page_name"] = $menus[$i]["mf_modulepagename"];
                    $row["create"] = $menuRights[$j]["mfr_create"];
                    $row["edit"] = $menuRights[$j]["mfr_edit"];
                    $row["delete"] = $menuRights[$j]["mfr_delete"];
                    $row["view"] = $menuRights[$j]["mfr_view"];

                    $data[$menus[$i]["mf_groupcode"]][$menuRights[$j]["mfr_modulecode"]] = $row;
                    $data[$menus[$i]["mf_groupcode"]]["top_menu_name"] = $menus[$i]["mf_groupname"];
                }
            }
        }
    }
    
    return $data;
}

function authorize($module) {
    return $module == "yes" ? TRUE : FALSE;
}

function get_numerics($str) {
    return floatval(preg_replace('/[^\d.]/', '', $str));
}

function generateRandomString($length) {
    return substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function GetRomawiFromNumber($n){
    $result = "";
    $iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",
                                20=>"XX",30=>"XXX",40=>"XL",50=>"L",60=>"LX",
                                          70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",
                                          300=>"CCC",400=>"CD",500=>"D",600=>"DC",
                                          700=>"DCC",800=>"DCCC",
                                          900=>"CM",1000=>"M",
                                          2000=>"MM",3000=>"MMM");
    if(array_key_exists($n,$iromawi)){
          $result = $iromawi[$n];
    }elseif($n >= 11 && $n <= 99){
          $i = $n % 10;
          $result = $iromawi[$n-$i] . GetRomawiFromNumber($n % 10);
    }elseif($n >= 101 && $n <= 999){
          $i = $n % 100;
          $result = $iromawi[$n-$i] . GetRomawiFromNumber($n % 100);
    }else{
          $i = $n % 1000;
          $result = $iromawi[$n-$i] . GetRomawiFromNumber($n % 1000);
    }
     return $result;
  }
  
function generateNumber($abs, $no){

    //Setting transaction number format
    $flag_number = str_pad($no, 3, '0', STR_PAD_LEFT); 
    
    $generate = $abs.$flag_number;

    return $generate;

}

function terbilang_get_valid($str,$from,$to,$min=1,$max=9){
  $val=false;
  $from=($from<0)?0:$from;
  for ($i=$from;$i<$to;$i++){
    if (((int) $str{$i}>=$min)&&((int) $str{$i}<=$max)) $val=true;
  }
  return $val;
}
function terbilang_get_str($i,$str,$len){
  $numA=array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
  $numB=array("","se","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
  $numC=array("","satu ","dua ","tiga ","empat ","lima ","enam ","tujuh ","delapan ","sembilan ");
  $numD=array(0=>"puluh",1=>"belas",2=>"ratus",4=>"ribu", 7=>"juta", 10=>"milyar", 13=>"triliun");
  $buf="";
  $pos=$len-$i;
  switch($pos){
    case 1:
        if (!terbilang_get_valid($str,$i-1,$i,1,1))
          $buf=$numA[(int) $str{$i}];
      break;
    case 2: case 5: case 8: case 11: case 14:
        if ((int) $str{$i}==1){
          if ((int) $str{$i+1}==0)
            $buf=($numB[(int) $str{$i}]).($numD[0]);
          else
            $buf=($numB[(int) $str{$i+1}]).($numD[1]);
        }
        else if ((int) $str{$i}>1){
            $buf=($numB[(int) $str{$i}]).($numD[0]);
        }       
      break;
    case 3: case 6: case 9: case 12: case 15:
        if ((int) $str{$i}>0){
            $buf=($numB[(int) $str{$i}]).($numD[2]);
        }
      break;
    case 4: case 7: case 10: case 13:
        if (terbilang_get_valid($str,$i-2,$i)){
          if (!terbilang_get_valid($str,$i-1,$i,1,1))
            $buf=$numC[(int) $str{$i}].($numD[$pos]);
          else
            $buf=$numD[$pos];
        }
        else if((int) $str{$i}>0){
          if ($pos==4)
            $buf=($numB[(int) $str{$i}]).($numD[$pos]);
          else
            $buf=($numC[(int) $str{$i}]).($numD[$pos]);
        }
      break;
  }
  return $buf;
}

function toTerbilang($nominal){
  $buf="";
  //$str=$nominal."";
  $str=floor($nominal)."";
  $len=strlen($str);
  for ($i=0;$i<$len;$i++){
    $buf=trim($buf)." ".terbilang_get_str($i,$str,$len);
  }
  return trim($buf);
}

function toBulan($bulan_no)
{
  $bulan = array("January","February","March","April","May","June","July","August","September","October","November","December");

  return $bulan[$bulan_no-1];
}

function toBulanIdn($bulan_no)
{
  $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");

  return $bulan[$bulan_no-1];
}
?>