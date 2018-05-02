$('.deleteButton').click(function (e) {
    e.preventDefault();
    let deletion = confirm("Voulez-vous supprimer cet élément ? ...");

    if (deletion) {
        $(this).parent().submit();
    }
});