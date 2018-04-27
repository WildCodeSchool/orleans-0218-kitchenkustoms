$('.deleteButton').click(function (e) {
   e.preventDefault();
   let deleteBike = confirm("Voulez-vous supprimer le vélo ?");

   if (deleteBike) {
        $('.delete').submit();
   }
});