$(document).ready(function() {
    // Esconde o campo de resposta no início
    $('#response-field').hide();

    // Mostra o campo de resposta quando um item de feedback é clicado
    $('.list-group-item').click(function(event) {
        event.stopPropagation();
        $('#response-field').show();
    });
});
