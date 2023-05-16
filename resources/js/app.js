try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {

}

require('./bootstrap');
require('livewire-sortable')


//nice select
require('jquery-nice-select');

/*jQuery( document ).ready(function() {
    jQuery('select').niceSelect();
});*/

// alpine
import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse'

Alpine.plugin(collapse);
window.Alpine = Alpine;

Alpine.start();

//custom-select
$(".custom-select").each(function (index) {
    if ($(this).children('option:first-child').is(':selected')) {
        $(this).addClass('placeholder');
    }
});

//scroll to last position
$('.remove').on('click', function (event) {
    setTimeout(function () {
        $("body, html").animate({
            scrollTop: $('#current-form').offset().top - 20
        }, 'slow');
    }, 200);
});
// $(".custom-select").on('change', function () {
//     if ($(this).children('option:first-child').is(':selected')) {
//         $(this).addClass('placeholder');
//     } else {
//         $(this).removeClass('placeholder');
//     }
// });

$('.group-remove').on('click', function (event) {
    let groupKey = $(this).attr('group_key');
    if (groupKey[groupKey.length - 1] != 0) {
        groupKey = groupKey - 1;
    }
    setTimeout(function () {
        $('.scroll').animate({
            scrollTop: $('#group-key-' + groupKey).offset().top - 200
        }, 'slow');
    }, 100);
});

$('#myButton').on('click', function (event){
    $(this).addClass('active');
});



tippy('[data-tippy-content]', {
    theme: 'light',
    maxWidth: 300,
    allowHTML: true,
    placement: 'top',
    interactive: true,
    duration: 800,
});

tippy('[data-tippy-content]', {
    theme: 'light',
    maxWidth: 300,
    delay: 300,
    allowHTML: true,
    placement: 'top',
    interactive: true,
    duration: 800,
    onMount(instance) {
        let cont = instance.reference.dataset.tippyContent;
        instance.setContent(cont);
    },
});
