$('.deleteButton').click(function (e) {
    e.preventDefault();
    let deleteCatering = confirm("Voulez-vous supprimer cet élément ?");

    if (deleteCatering) {
        $('.delete').submit();
    }
});