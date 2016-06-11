
//поставить / снять фокус на день недели
    function setfocus_day( id ) {
        window.document.getElementById(id).className = "focus_tvday_item";
        window.document.getElementById(id).childNodes[1].className = "focus_item";
    }

    function dontfocus_day( id ) {
        window.document.getElementById(id).className = "tvday_item";
        window.document.getElementById(id).childNodes[1].className = "item";
    }

//постаить / снять фокус на канал
    function setfocus_channel( id ) {
        window.document.getElementById(id).className = "focus_channel_list";
    }

    function dontfocus_channel( id ) {
        window.document.getElementById(id).className = "";
    }
//поставить снять фокус на переключатель
    function setfocus_toggle_day(id){
        if(id=='toggle_all_day'){
            window.document.getElementById('toggle_all_day').className = "focus_toggle_schedule_item border_left_item";
            window.document.getElementById('toggle_now_day').className = "toggle_schedule_item border_right_item";
        }
        if(id=='toggle_now_day'){
            window.document.getElementById('toggle_now_day').className = "focus_toggle_schedule_item border_right_item";
            window.document.getElementById('toggle_all_day').className = "toggle_schedule_item border_left_item";
        }
    }