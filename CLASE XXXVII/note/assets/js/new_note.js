require('jquery');
require('../css/new_note.css');


//Mostramos nombre fichero adjunto
$('.custom-file-input').on('change', function () {
    var fileName = document.getElementById("note_attachedFile").files[0].name;
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});


jQuery(document).ready(function () {

    addItemLink("");

});


function addItemLink() {
    
    // setup an "add a item" link
    var text = $('div.items').attr('text');
    var $addItemLink = $('<a href="#" class="add_item_link">'+text+'</a>');
    var $newLinkLi = $('<div></div>').append($addItemLink);


    // div que contiene items 
    var $collectionHolder = $('div.items');

    // Añadimos link para añadir items  
    $collectionHolder.prepend($newLinkLi);

    // Contamos inputs y guardamos en index
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    // Cuando hacemos click se añade formulario    
    $addItemLink.on('click', function (e) {
        e.preventDefault();
        addItemForm($collectionHolder, $newLinkLi);
    });
}


function addItemForm($collectionHolder, $newLinkLi) {
    // Obtenemos prototype
    var prototype = $collectionHolder.data('prototype');

    // Guardamos index
    var index = $collectionHolder.data('index');

    // Reemplazamos name por index en el prototype
    var newForm = prototype.replace(/__name__/g, index);

    // Incrementamos index 
    $collectionHolder.data('index', index + 1);

    removeLink=$("#removeLink").clone().attr("hidden",false);
    var $newForm = $('<div></div>').append(removeLink);
    // Añadimos botón borrar

    $newForm.append(newForm);

    // Finalmente añadimos formulario
    $newLinkLi.after($newForm);

    addRemoveClickEvent();
    inject();
}



function inject() {
    var mySVGsToInject = document.querySelectorAll('img.inject-me');
    console.log(mySVGsToInject);
    // Do the injection
    SVGInjector(mySVGsToInject);
}


function addRemoveClickEvent() {
    // Eliminamos formulario al hacer click
    $('.remove-item').click(function (e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}


module.exports = {
    inject: inject,
    addRemoveClickEvent: addRemoveClickEvent,
    addItemLink: addItemLink
};