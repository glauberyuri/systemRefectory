$(function(){
    callNotificatios();

    setInterval(function(){
        callNotificatios();
    },900000);
});

function readAllNotifications(){
    $.ajax({
        url : "/notifications/readAll",
        type : 'get',
    })
    .done(function(data){

    })
    .fail(function(data){

    })

}

function callNotificatios(){
    $.ajax({
        url : "/notifications/list",
        type : 'get',
    })
    .done(function(data){
        $html = '';

        if(data.length != 0){
            $("#notification-alert").html('<span class="heartbit"></span><span class="point"></span>');

            $notificado = false;

            $.each(data, function($idx, $value){
                $date = dateFormated();
                $notificar = false;

                n_date = new Date($value['created_at']) // data que foi criada a notificação
                dia  = n_date.getDate().toString(),
                diaF = (dia.length == 1) ? '0'+dia : dia,
                mes  = (n_date.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
                mesF = (mes.length == 1) ? '0'+mes : mes,
                anoF = n_date.getFullYear();

                if($date != diaF+"/"+mesF+"/"+anoF)
                    $date_custom = diaF+"/"+mesF+"/"+anoF;
                else{
                    $date_custom = n_date.getHours() + ':' + n_date.getMinutes();
                    $date = new Date();
                    
                    if(n_date.getMinutes() > (parseFloat($date.getMinutes()) - 15))
                        $notificar = true;
                }
                
                $html +=
                '<a href="'+$value['notification_url']+'" class="message-item d-flex align-items-center border-bottom px-3 py-2">'
                    +'<span class="btn btn-light-success text-success btn-circle">'
                        +'<i class="'+$value['notifications_icon']+' fill-white"></i>'
                    +'</span>'
                    +'<div class="w-75 d-inline-block v-middle ps-3">'
                        +'<h5 class="message-title mb-0 mt-1 fs-3 fw-bold">'+$value['notification_title']+'</h5>'
                        +'<span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">'+$value['notification_body']+'</span>'
                        +'<span class="fs-2 text-nowrap d-block subtext text-muted">'+$date_custom+'</span>'
                    +'</div>'
                +'</a>';

                if($notificar == true && $notificado == false){
                    var notificacao = 
                    '<a href="'+$value['notification_url']+'" class="message-item d-flex align-items-center border-bottom px-3 py-2">'
                        +'<span class="btn btn-light-success text-success btn-circle">'
                            +'<i class="'+$value['notifications_icon']+' fill-white"></i>'
                        +'</span>'
                        +'<div class="w-75 d-inline-block v-middle ps-3">'
                            +'<h5 class="message-title mb-0 mt-1 fs-3 fw-bold">'+$value['notification_title']+'</h5>'
                            +'<span class="fs-2 text-nowrap d-block time text-truncate fw-normal text-muted mt-1">'+$value['notification_body']+'</span>'
                            +'<span class="fs-2 text-nowrap d-block subtext text-muted">'+$date_custom+'</span>'
                        +'</div>'
                    +'</a>';

                    $("#notification-popup").html(notificacao);
                    $("#notification-popup").show(500);
                    $notificado = true;
                }
            });

            setTimeout(function(){
                $("#notification-popup").hide(500);
            }, 3000)
        }

        if($html == '')
            $html = "<h5 style='text-align: center; position: relative; top: 50%; transform: translateY(-50%);'><b>Você não possui novas notificações</b></h5>"

        $("#notification-body").html($html);
    })
    .fail(function(jqXHR, textStatus, msg){
    // chamar função de erro
    });
}

function getDateTime($date = null){
    if($date)
        var data = new Date($date)
    else    
        var data = new Date();

        return data.getHours() + ':' + data.getMinutes();
}

function dateFormated($date = null){
    if($date)
        var data = new Date($date)
    else    
        var data = new Date();

    var dia  = data.getDate().toString(),
        diaF = (dia.length == 1) ? '0'+dia : dia,
        mes  = (data.getMonth()+1).toString(), //+1 pois no getMonth Janeiro começa com zero.
        mesF = (mes.length == 1) ? '0'+mes : mes,
        anoF = data.getFullYear();

    return diaF+"/"+mesF+"/"+anoF;
}