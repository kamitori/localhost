<?php 
echo "i'm here <br/>";

$path = "E:\/Free\/frost\/downloads";
$arr_date = array();
function listFolderFiles($dir,&$arr_date){
    $ffs = scandir($dir);
    //echo '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            //echo '<li>'.$ff;
            if(is_dir($dir.'/'.$ff)){
            	listFolderFiles($dir.'/'.$ff,$arr_date);
            } else{
				$tmp = array();
				$tmp['name'] = iconv("UTF-8", "ISO-8859-1//IGNORE", $dir.'/'.$ff);
				@$tmp['date'] = fileatime(iconv("UTF-8", "ISO-8859-1//IGNORE", $dir.'/'.$ff));
				$arr_date[] = $tmp;
            }
            //echo '</li>';
        }
    }
    //echo '</ol>';
}
listFolderFiles($path,$arr_date);
$sort_date = array();
foreach ($arr_date as $key => $value) {
	$sort_date[] = $value['date'];
}
array_multisort($sort_date, SORT_DESC, $arr_date);
$text = '';
foreach ($arr_date as $key => $value) {
	$text.=$value['name']."\r\n";
}
file_put_contents('E:\/Free\/list.txt', $text);
echo "i'm done <br/>";
// echo '<pre>';
// print_r($arr_date);
// echo '</pre>';

