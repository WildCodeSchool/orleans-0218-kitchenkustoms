$(".deleteButton").click(function(e) {
    e.preventDefault();
    let deleteItem = confirm("Voulez-vous supprimer cette Item ?");
    if (deleteItem) {
        $(".deleteButton").submit();
    }
});