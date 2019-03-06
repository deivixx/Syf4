const addLink = require('./new_note.js').addItemLink;
const addRemoveClickEvent = require('./new_note.js').addRemoveClickEvent;
const inject = require('./new_note.js').inject;
require('../css/edit_note.css');

jQuery(document).ready(function () {

    addLink();
    addRemoveButtonToItems();
    inject();
});


function addRemoveButtonToItems() {

    $("div.form-inline").each(function () {
        var deleteLink = $('<div></div>').append('<a href="#" class="remove-item"><img  class="inject-me icon red-icon" src="../../open-iconic/svg/x.svg" alt="Eliminar"/></a>');
        deleteLink.append($(this))
        $('.items').append(deleteLink)
    });
    addRemoveClickEvent();
}

