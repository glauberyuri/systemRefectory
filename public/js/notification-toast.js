

    // Success Type
    function successmsg(msg = null, title = null){
        toastr.success((msg != null ? msg : 'Informações salvas com sucesso'), (title != null ? title : 'Ação realizada com sucesso!'));
    };

    // info Type
    function infomsg(msg = null, title = null) {
        toastr.info((msg != null ? msg : 'OK!'), (title != null ? title : 'Aviso'));
    };

    // warning Type
    function warningmsg(msg = null, title = null) {
        toastr.warning((msg != null ? msg : 'Cuidado ao realizar está ação!'), (title != null ? title : 'Atenção!'));
    };

    // Error Type
    function errormsg(msg = null, title = null){
            toastr.error((msg != null ? msg : 'Ocorreu um erro ao salvar as informações'), (title != null ? title : 'Ocorreu um erro!'));   
    }


