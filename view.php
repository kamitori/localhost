<?php 
// echo "i'm here <br/>";

// $path = "G:\/Free\/Frost-Next\/frost-next\/downloads\/Lolita Nude";
$path = "G:\/Free\/frost\/downloads\/Chubby Image";
$arr_file = array();
$arr_dir = array();
$arr_subdir = array();
function listFolderFiles($dir,&$arr_file,&$arr_dir){
    $ffs = scandir($dir);
    //echo '<ol>';
    foreach($ffs as $ff){
        if($ff != '.' && $ff != '..'){
            //echo '<li>'.$ff;
            if(is_dir($dir.'/'.$ff)){
                $arr_dir[] = $ff;
                $sub_dir = array();
            	listFolderFiles($dir.'/'.$ff,$arr_file,$sub_dir);
            } else{
				// $tmp = array();
				$arr_file[] = iconv("UTF-8", "ISO-8859-1//IGNORE", $dir.'\/'.$ff);
				// @$tmp['date'] = fileatime(iconv("UTF-8", "ISO-8859-1//IGNORE", $dir.'/'.$ff));
				// $arr_file[] = $tmp;
            }
            //echo '</li>';
        }
    }
    //echo '</ol>';
}

function checkBelongFolder($name_dir,$name_file){
    $arr_name_file = explode('\/', $name_file);
    unset($arr_name_file[count($arr_name_file)-1]);
    $arr_name_file = array_values($arr_name_file);
    $new_name_dir = implode('\/', $arr_name_file);
    if (strpos($new_name_dir, $name_dir) !== false) {
        return true;
    }
    else{
        return false;
    }
}

listFolderFiles($path,$arr_file,$arr_dir);

foreach ($arr_dir as $key1 => $name_dir) {
    $html = '<div style="text-align:center;">';
    if(isset($arr_dir[$key1-1])){
        $back_dir = $path.'\/'.$arr_dir[$key1-1].'.html';
        $html.='<a class="back" href="'.$back_dir.'"> <span style="font-size:200%;">Back</span> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    if(isset($arr_dir[$key1+1])){
        $next_dir = $path.'\/'.$arr_dir[$key1+1].'.html';
        $html.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="next" href="'.$next_dir.'"> <span style="font-size:200%;">Next</span> </a>';
    }
    $html.='</div>';
    foreach ($arr_file as $key2 => $name_file) {
        if(checkBelongFolder($path."/".$name_dir, $name_file)){
            $html.= "<img src='$name_file' style='width:auto; display:block; margin: 15px auto;' />";
        }
    }
    $html .= '<div style="text-align:center;">';
    if(isset($arr_dir[$key1-1])){
        $back_dir = $path.'\/'.$arr_dir[$key1-1].'.html';
        $html.='<a class="back" href="'.$back_dir.'"> <span style="font-size:200%;">Back</span> </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    if(isset($arr_dir[$key1+1])){
        $next_dir = $path.'\/'.$arr_dir[$key1+1].'.html';
        $html.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="next" href="'.$next_dir.'"> <span style="font-size:200%;">Next</span> </a>';
    }
    $html.='</div>';
    $html.='<script>
        document.onkeydown = function(e) {
            var next = document.getElementsByClassName("next")[0];
            var back = document.getElementsByClassName("back")[0];
            switch (e.keyCode) {
                case 37:
                    back.click();
                    break;
                case 39:
                    next.click();
                    break;
            }
        };
    </script>';
    file_put_contents($path.'\/'.$name_dir.'.html', $html);
    // echo $path.'\/'.$name_dir.'.html';
    // echo "<br/>";
}



// echo "<pre>";
// print_r($arr_dir);
// echo "</pre>";

// echo "<pre>";
// print_r($arr_file);
// echo "</pre>";

echo "i'm done <br/>".count($arr_dir);
// echo '<pre>';
// print_r($arr_date);
// echo '</pre>';

