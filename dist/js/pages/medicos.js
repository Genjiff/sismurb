$(function () {
    $('#listademedicos').DataTable({"language": {
        "lengthMenu": "Mostrar _MENU_ por página",
        "zeroRecords": "Nenhum médico encontrado",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhuma informação disponível",
        "infoFiltered": "(Filtrando de _MAX_ registros)",
        "search": "Busca:",
        "paginate": {
            "previous" : "Anterior",
            "next" : "Próximo"
            }
        }
    });

    $(".excluir").click(function(e){
        var link = $(this).attr("href");
        $("#seguirExclusao").attr("href", $(this).attr("href"));
        $("#confirmacao").modal("show");
        e.preventDefault();
    });
});
