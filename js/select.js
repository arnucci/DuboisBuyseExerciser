$('#select').click(function() {

    placecheckbox = $('input:checkbox[name="place[]"]');

    placecheckbox.each(function() {

        $(this).attr('checked', 'checked');
    });
});
