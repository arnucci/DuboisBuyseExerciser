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

$('#selectcl').click(function() {

    $('.checkclasse').each(function() {
        $(this).prop('checked', 'checked');
    });
});

$('#unselectcl').click(function() {

    $('.checkclasse').each(function() {

        $(this).prop('checked', false);
    });
});

