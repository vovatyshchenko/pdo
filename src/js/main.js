function sendData()
{
    let form = '#form';
    let dataForm = $(form).serialize();
    $('*', form).removeClass('error');
    $('.invalid-feedback').empty();
    $('.form-control', form).val('');
    $.ajax({
        url: 'request.php', 
        type: 'POST',
        dataType: 'json',
        data: dataForm, 
        success: function(responce){
            for( key in responce ){
                $('[name="'+key+'"]', form).addClass('error');
                $('[name="'+key+'"]').siblings('.invalid-feedback').html( responce[key].join('<br>')  ).show();
            }
        }
    })
}