$(document).ready(function(){
    $('form').on('submit', function(){

        swal({
            title: 'Aguarde...',
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading()
            }
        });
        $("button[type=submit]").attr('disabled', 'true').html("Aguarde ...");
    });

    /*Iniciar o tooltip*/
    $('[data-toggle="tooltip"]').tooltip(); 
    
    $('[data-toggle="popover"]').popover({trigger: 'hover'}); 

    $('button.confirmation').on('click', function(e){
        e.preventDefault();
        Swal({
            title: 'Atenção!!!',
            text: 'Você tem certeza disso?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, tenho!',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#d33',
            allowOutsideClick: false
        }).then((result) => {
            if (result.value) {
                $(this).closest('form').submit();
            }
        })
    });
    
});