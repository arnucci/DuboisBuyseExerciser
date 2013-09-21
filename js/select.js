$('#select').click(function() {

    placecheckbox = $('input:checkbox[name="place[]"]');

    placecheckbox.each(function() {

        $(this).attr('checked', 'checked');
    });
});

$('#unselect').click(function() {

    placecheckbox = $('input:checkbox[name="place[]"]');

    placecheckbox.each(function() {

        $(this).attr('checked', false);
    });
});

