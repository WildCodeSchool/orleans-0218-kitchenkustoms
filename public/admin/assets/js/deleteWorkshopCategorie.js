$('.delete').click(function (e) {
   e.preventDefault();
   let deleteBike = confirm("Voulez-vous supprimer la catégorie ?");

   if (deleteBike) {
        $(this).parent().submit();
   }
});