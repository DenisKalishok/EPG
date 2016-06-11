<?php
//настройки времени
date_default_timezone_set("Europe/Minsk");

function get_title_channel($db,$id){
    $inf=$db->query("SELECT * FROM `channel`");
    if(sqlite3_num_rows($inf)!=0){
        while($r=$inf->fetchArray()){
            if($r['channel_id']==$id){
                echo "<div class='title'><img width='40' height='40' align='center' src='imgtvchannel /",$r['channel_id'],".png' />&nbsp;&nbsp;",$r['channel_name'],"</div>";
                //break;
            }
        }

   }else{
        echo 'Нету канала с id: '.$id;
    }
}
function get_program_list($db, $id, $date, $schedule){
    //чтение бд
    $inf = $db->query("SELECT * FROM `program` WHERE  program_id = '$id' AND (program_time_beg LIKE '%$date%')");
    if(sqlite3_num_rows($inf)==0){
        echo '<table><tr><td></td><td><span>Извините, расписание временно недоступно.</span></td></tr></table>';
    }else{
        $counter=0; //счетчик количества вывода программ в режиме сейчас
        $counter2=0; //счетчик количества выведеных программ
        echo "<table>";

        while($r = $inf->fetchArray())
        {
            if(($schedule=='toggle_now_day')&&$counter<5){ //если стоит 'сегодня' выводим мах 5 каналов
                if(($r['program_time_beg']<=date('YmdHis'))&&($r['program_time_end']>=date('YmdHis'))){
                    //жирным
                    echo "<tr><td class='in'>",substr($r['program_time_beg'],-6,2),":",substr($r['program_time_beg'],-4,2),"</td><td class='in'><span>", $r['program_title'],"<span></td></tr>";
                    $counter+=1;
                    $counter2+=1;
                }
                if(($r['program_time_beg']>date('YmdHis'))&&($r['program_time_end']>date('YmdHis'))){
                    //просто черным
                    echo "<tr><td>",substr($r['program_time_beg'],-6,2),":",substr($r['program_time_beg'],-4,2),"</td><td><span>", $r['program_title'],"<span></td></tr>";
                    $counter+=1;
                    $counter2+=1;
                }
            }
            elseif($schedule=='toggle_all_day'){ //если стоит 'весь день'
                if(($r['program_time_beg']<date('YmdHis'))&&($r['program_time_end']<date('YmdHis'))){
                    //серым
                    echo "<tr><td class='before'>",substr($r['program_time_beg'],-6,2),":",substr($r['program_time_beg'],-4,2),"</td><td class='before'><span>", $r['program_title'],"<span></td></tr>";
                    $counter2+=1;
                }
                if(($r['program_time_beg']<=date('YmdHis'))&&($r['program_time_end']>=date('YmdHis'))){
                    //жирным
                    echo "<tr class='in'><td>",substr($r['program_time_beg'],-6,2),":",substr($r['program_time_beg'],-4,2),"</td><td><span>", $r['program_title'],"<span></td></tr>";
                    $counter2+=1;
                }
                if(($r['program_time_beg']>date('YmdHis'))&&($r['program_time_end']>date('YmdHis'))){
                    //просто черным
                    echo "<tr><td>",substr($r['program_time_beg'],-6,2),":",substr($r['program_time_beg'],-4,2),"</td><td><span>", $r['program_title'],"<span></td></tr>";
                    $counter2+=1;
                }
            }
        }
        if($counter2<1){ //если в выборке есть программы но ничего не выводилось
            echo '<tr><td></td><td><span>ТВ-программа закончилась.</span></td></tr>';
        }
        echo"</table>";
    }
}

function get_table_schedule($db,$beg,$kolChannels,$date,$schedule){
    $inf = $db->query("SELECT * FROM `channel` ORDER BY channel_number LIMIT $beg,$kolChannels");
    if(sqlite3_num_rows($inf)!=0){
        echo'<table><tr>';
        while($r=$inf->fetchArray()){  //перебераем $kolChannels считаных канала
            $id=$r['channel_id'];
            echo'<td>';
            get_title_channel($db,$id); //вернет div (шапку) логотип и название канала
            get_program_list($db,$id,$date,$schedule); //вернет таблицу из списка программ
            echo '</td>';
        }
        echo'</tr></table><hr>';
    }
}

//получения списка каналов помещенные в таблицу
function get_table_channel_list($db){
    //берем все таблицы channel
    $inf = $db->query("SELECT * FROM `channel` ORDER BY channel_number");
    echo "
    <table class='channel_list'>
        <tr>
            <th>Список каналов:</th>
        </tr>";

    while($r = $inf->fetchArray())
    {
        //оборачиваем данные в строки таблицы
        echo "<tr><td id='",$r['channel_id'],"' class='s'><img width='22' height='22' align='center'
         src='imgtvchannel/",$r['channel_id'],".png'/>&nbsp;",$r['channel_name'],"</td></tr>";
    }
    echo "</table>";
}

function sqlite3_num_rows($result) {
    $c = 0;
    while($result->fetchArray()) {
        $c++;
    }
    return $c;
}