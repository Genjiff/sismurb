$(function () {
    var error_fields = <?php echo $error_fields; ?>;
    var error_msg = "<?php echo $error_msg; ?>";
    var success = <?php echo $success; ?>;

    for (var i in error_fields) {
        $("#" + error_fields[i]).parent().addClass("has-error");
    };

    if (error_msg != "") {
        alert = document.getElementById("msg_error");
        alert.innerHTML = ( error_msg );
        $("#erro").modal("show");
    }

    if (success) {
        $("#sucesso").modal("show");
    }

    //Initialize Select2 Elements
    $(".select2").select2();

    $("#data").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/aaaa"});

    $("#horarioinicio").inputmask("hh:mm", {"placeholder": "hh:mm"});

    $("#horariofim").inputmask("hh:mm", {"placeholder": "hh:mm"});
});
