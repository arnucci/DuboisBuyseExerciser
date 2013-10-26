$('#select').click(function() {

    $('.checkplace').each(function() {
        $(this).prop('checked', 'checked');
    });
});

$('#unselect').click(function() {

    $('.checkplace').each(function() {

        $(this).prop('checked', false);
    });
});

