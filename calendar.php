<?php
//настройки времени
date_default_timezone_set("Europe/Minsk");

//числа дней недели ПН-ВС
$day_1=date ("d.m", time() - (date("N")-1) * 24*60*60);
$day_2=date ("d.m", time() - (-1+date("N")-1) * 24*60*60);
$day_3=date ("d.m", time() - (-2+date("N")-1) * 24*60*60);
$day_4=date ("d.m", time() - (-3+date("N")-1) * 24*60*60);
$day_5=date ("d.m", time() - (-4+date("N")-1) * 24*60*60);
$day_6=date ("d.m", time() - (-5+date("N")-1) * 24*60*60);
$day_7=date ("d.m", time() - (-6+date("N")-1) * 24*60*60);

//id каналов на неделю в формате: год месяц день
$date_1=date ("Ymd", time() - (date("N")-1) * 24*60*60);
$date_2=date ("Ymd", time() - (-1+date("N")-1) * 24*60*60);
$date_3=date ("Ymd", time() - (-2+date("N")-1) * 24*60*60);
$date_4=date ("Ymd", time() - (-3+date("N")-1) * 24*60*60);
$date_5=date ("Ymd", time() - (-4+date("N")-1) * 24*60*60);
$date_6=date ("Ymd", time() - (-5+date("N")-1) * 24*60*60);
$date_7=date ("Ymd", time() - (-6+date("N")-1) * 24*60*60);


//HTML блок
echo "
    <div class='tv_calendar'>
        <div id='$date_1' class='tvday_item'>
            <div class='item'>
                Пн<br>$day_1
            </div>
        </div>
        <div id='$date_2' class='tvday_item'>
            <div class='item'>
                Вт<br>$day_2
            </div>
        </div>
        <div id='$date_3' class='tvday_item'>
            <div class='item'>
                Ср<br>$day_3
            </div>
        </div>
        <div id='$date_4' class='tvday_item'>
            <div class='item'>
                Чт<br>$day_4
            </div>
        </div>
        <div id='$date_5' class='tvday_item'>
            <div class='item'>
                Пт<br>$day_5
            </div>
        </div>
        <div id='$date_6' class='tvday_item'>
            <div class='item'>
                Сб<br>$day_6
            </div>
        </div>
        <div id='$date_7' class='tvday_item'>
            <div class='item'>
                Вс<br>$day_7
            </div>
        </div>

        <!--переключатель: весь день / сейчас-->
        <div class='toggle_schedule'>
            <div id='toggle_all_day' class='toggle_schedule_item border_left_item'>
                Весь день
            </div>
            <div id='toggle_now_day' class='toggle_schedule_item border_right_item'>
                Сейчас
            </div>
        </div>
    </div>
";



