$(document).ready(function() {
   $('tr#gift').hover(function() { 
   		$(this).toggleClass('hover');
   });
   
   $('.editable').inlineEdit({
    save: function(e, data) {
    }
  });
});