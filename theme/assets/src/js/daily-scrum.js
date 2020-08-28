$('#dailyscrum-sprint_id').on('change', function(){
    var id = $(this).val();
    $.ajax({
        url: 'daily-scrum/daily',
        type: 'POST',
        data: {
            id: id,
            _csrf : $('meta[name=csrf-token]').attr('content')
        },
        beforeSend: function(){
            loader('show');
        },
        success: function(result, status){
            var res = JSON.parse(result);
            $('#scrum').html('').html(res.html);
        },
        complete: function(result, status){
            loader('hide');
        },
        error: (result, status, error) => {}
    });
});
