$(function () {
    var empty_fields = <?php echo $empty_fields; ?>;

    for (var i in empty_fields) {
        $("#" + empty_fields[i]).parent().addClass("has-error");
    };

    //Initialize Select2 Elements
    $(".select2").select2();

    $("#cpf").inputmask("999.999.999-99", {"placeholder": "___.___.___-__"});

    $("#datadenascimento").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/aaaa"});

    $("#telefone").inputmask("(99) 9999-9999", {"placeholder": "(__) ____-____"});
});
