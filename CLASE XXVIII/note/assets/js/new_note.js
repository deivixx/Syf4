require('jquery');
require('../css/new_note.css');



$('.custom-file-input').on('change', function () {
    var fileName = document.getElementById("note_attachedFile").files[0].name;
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});



// setup an "add a tag" link
var $addItemLink = $('<a href="#" class="add_item_link">Añade elemento</a>');
var $newLinkLi = $('<div></div>').append($addItemLink);

jQuery(document).ready(function () {

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

    addRemoveButtonToItems();
    inject();
});

function addItemForm($collectionHolder, $newLinkLi) {
    // Obtenemos prototype
    var prototype = $collectionHolder.data('prototype');

    // Guardamos index
    var index = $collectionHolder.data('index');

    // Reemplazamos name por index en el prototype
    var newForm = prototype.replace(/__name__/g, index);

    // Incrementamos index 
    $collectionHolder.data('index', index + 1);

    // Ponemos nuevo formulario dentro de div
    var $newForm = $('<div></div>').append('<a href="#" class="remove-item"><img  class="inject-me icon red-icon" src="../open-iconic/svg/x.svg" alt="Eliminar"/></a>');

    // Añadimos botón borrar
    $newForm.append(newForm);

    // Finalmente añadimos formulario
    $newLinkLi.after($newForm);

    addRemoveClickEvent();
    inject();

    //$('.datepicker').datepicker($.datepicker.regional["es"]);
}



function addRemoveButtonToItems() {

    $("div.form-inline").each(function () {
        $(this).prepend('<a href="#" class="remove-item"><img  class="inject-me icon red-icon" src="../open-iconic/svg/x.svg" alt="Eliminar"/></a>');
    });
    addRemoveClickEvent();
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