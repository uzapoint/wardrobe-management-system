document.addEventListener('DOMContentLoaded', function()
{
    $('.activate-user').click(function(e)
    {
        e.preventDefault();
        var record_id = $(this).attr('href');

        $('#activate-user').modal('show');

        $('.yes-activate-user').click(function()
        {
            $('.activate-user-spinner').show();
            var app_url = $('#app_url').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('.yes-activate-user').prop('disabled', true);
            setTimeout(function()
            {
                $('.yes-activate-user').prop('disabled', false);
            }, 80000);

            $.ajax({
                url: ''+app_url+'activate-user/'+record_id+'',
                type: 'get',
                contentType: false,
                cache: false, 
                processData: false,
                dataType: 'JSON',
                success : function(data)
                {
                    if (data.status == "ok")
                    {
                        $('.activate-user-spinner').hide();
                        submitMSG(true, data.reason);

                        window.setTimeout(function() 
                        {
                            location.reload();
                        }, 100);
                    }else 
                    {
                        $('.activate-user-spinner').hide();
                        submitMSG(false, data.reason);
                    }
                }
            }); 
        })
    });

    function submitMSG(valid, msg)
    {
        var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
        $("#activate-user-response").removeClass().addClass(msgClasses).text(msg);
    }
});