var id_focus_channel;
var id_focus_toggle="toggle_now_day";
var id_focus_day=get_date();

$(document).ready(
function()
        {
            //функции отследивания нажатия, установка/снятие фокуса, ajax запрос
            $("div[id='toggle_all_day']").bind("click",function()
            {
                if(id_focus_toggle!=$(this).attr('id')){
                    id_focus_toggle=$(this).attr('id');
                    setfocus_toggle_day(id_focus_toggle);
                    get_schedule();
                    set_default_to_AddChannels();
                    AddChannels();
                }
            });
            $("div[id='toggle_now_day']").bind("click",function()
            {
                if(id_focus_toggle!=$(this).attr('id')){
                    id_focus_toggle=$(this).attr('id');
                    setfocus_toggle_day(id_focus_toggle);

                    dontfocus_day(id_focus_day);
                    id_focus_day=get_date(); //
                    setfocus_day(id_focus_day);

                    get_schedule();
                    set_default_to_AddChannels();
                    AddChannels();
                }
            });


            $("td[class = 's']").bind("click",function()
            {
                if(id_focus_channel!=$(this).attr('id')){
                    dontfocus_channel(id_focus_channel);//снимаем фокус
                    id_focus_channel = $(this).attr('id'); //извлекаем содердимое из атрибута id
                    setfocus_channel(id_focus_channel);//ставим фокус
                    get_schedule(); //ajax запрос
                }
            });

            $("div[class = 'tvday_item']").bind("click",function()
            {
                if(id_focus_toggle=='toggle_now_day'){
                    if(id_focus_day!=$(this).attr('id')){
                        id_focus_toggle='toggle_all_day';
                        setfocus_toggle_day(id_focus_toggle);

                        dontfocus_day(id_focus_day); //снимаем фокус
                        id_focus_day = $(this).attr('id');
                        setfocus_day(id_focus_day); //ставим фокус
                        get_schedule(); //ajax запрос
                        set_default_to_AddChannels();
                        AddChannels();
                    }
                }else{
                    dontfocus_day(id_focus_day); //снимаем фокус
                    id_focus_day = $(this).attr('id');
                    setfocus_day(id_focus_day); //ставим фокус
                    get_schedule(); //ajax запрос
                    set_default_to_AddChannels();
                    AddChannels();
                }
            });
            set_default();

        });




function set_default(){
    id_focus_channel=$('.channel_list tr td').attr('id');
    setfocus_day(id_focus_day);
    setfocus_channel(id_focus_channel);
    setfocus_toggle_day(id_focus_toggle);
    get_schedule();
    AddChannels();
}

function get_date(){

    var date = new Date();

    var dd = date.getDate();
    if (dd < 10) dd = '0' + dd;
    var mm = date.getMonth() + 1; // месяц 1-12
    if (mm < 10) mm = '0' + mm;

    return date.getFullYear()+""+mm+""+dd;
}

function get_schedule(){
    $.ajax({
        url:"ViewProgramForOneDay.php",
        type:"POST",
        data:(
        {
            id: id_focus_channel,
            date: id_focus_day,
            schedule:id_focus_toggle
        }),
        dataType:"html",
        beforeSend: funcBefore,
        success:funcSuccess
    });
}
function funcBefore()
{
    $("#block").html('<div class="preloader"><img src="http://localhost/EPG/imgtvchannel/preloader.png"/></div>');
}

function funcSuccess(url) {
    $("#block").html(url);
}
function set_default_to_AddChannels(){
    Start=0;
    newDiv.innerHTML='';

}

/*для работы со списком каналов под главной частью*/
var newDiv = document.createElement('div');
function Success_request(url) {
    var adds = window.document.getElementById("addSchedule");
    newDiv.innerHTML += url;
    adds.appendChild(newDiv);
    remove_scroll();
}

var Start = 0;//начальная позиция
var kolChannels = 2;//количество каналов
function AddChannels() {
        $.ajax({
            url: "ViewProgramForAllChannels.php",
            type: "POST",
            data: ({
                kolChannels: kolChannels,
                start: Start,
                date: id_focus_day,
                schedule:id_focus_toggle
            }),
            dataType: "html",
            success: Success_request
        });
        Start += kolChannels;
}
$(window).scroll(function(){
    remove_scroll();
});
function remove_scroll(){
    if($('#addSchedule').offset().top+$('#addSchedule').height()<$(window).height()+$(window).scrollTop()){
        AddChannels();
    }
}