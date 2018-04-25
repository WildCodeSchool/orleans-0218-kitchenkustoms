$('#deleteButton').click(function (e) {
    e.preventDefault();
    let deleteBike = confirm("Voulez-vous supprimer cet élément ?");

    if (deleteBike) {
        $('#delete').submit();
    }
});