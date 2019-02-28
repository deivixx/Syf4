require('jquery');

$('.custom-file-input').on('change',function(){
    var fileName = document.getElementById("note_attachedFile").files[0].name; 
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
})

