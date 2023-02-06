
/* Check all checkboxes in cart */

// function check_all(){
    
//     // Get a list of all the checkboxes in the table
//   var checkboxes = document.querySelectorAll('input[type="checkbox"]');

//   // Iterate through the list of checkboxes
//   for (var i = 0; i < checkboxes.length; i++) {
//     // Set the checked property of each checkbox to the checked property of the main checkbox
//     checkboxes[i].checked = true;
//   }
  
// }


// $(".checkout-cta").click(function(){
//   if(confirm("Are you sure you want to delete the selected records?")){
//     var selectedRecords = $("input[name='delete[]']").map(function(){
//       return $(this).val();
//     }).get();
//     $.ajax({
//       url: "cart.php",
//       type: "POST",
//       data: { delete: selectedRecords },
//       success: function(data){
//         alert("Selected records have been deleted!");
//       }
//     });
//   }
// });

