function listClients(){
    $.ajax({
        url : {{route('users.store')}},
        type : 'post',
        data : $("#form-create-users").serialize(),
        beforeSend : function(){
        // chamar loading.
        }
    })
    .done(function(msg){
        // chamar função de acerto.
    })
    .fail(function(jqXHR, textStatus, msg){
        // alert(msg);
        // chamar função de erro
    });
}