$(function () {
    $('#listadepacientes').DataTable({"language": {
        "lengthMenu": "Mostrar _MENU_ por página",
        "zeroRecords": "Nenhum paciente encontrado",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "Nenhuma informação disponível",
        "infoFiltered": "(Filtrando de _MAX_ registros)",
        "paginate": {
            "previous" : "Anterior",
            "next" : "Próximo"
            }
        }
    });
})
