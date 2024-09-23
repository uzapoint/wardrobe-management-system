document.addEventListener('DOMContentLoaded', function()
{
    $('.deactivate-user').click(function(e)
    {
        e.preventDefault();
        var record_id = $(this).attr('href');

        $('#deactivate-user').modal('show');

        $('.yes-deactivate-user').click(function()
        {
            $('.deactivate-user-spinner').show();
            var app_url = $('#app_url').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('.yes-deactivate-user').prop('disabled', true);
            setTimeout(function()
            {
                $('.yes-deactivate-user').prop('disabled', false);
            }, 80000);

            $.ajax({
                url: ''+app_url+'deactivate-user/'+record_id+'',
                type: 'get',
                contentType: false,
                cache: false, 
                processData: false,
                dataType: 'JSON',
                success : function(data)
                {
                    if (data.status == "ok")
                    {
                        $('.deactivate-user-spinner').hide();
                        submitMSG(true, data.reason);

                        window.setTimeout(function() 
                        {
                            location.reload();
                        }, 100);
                    }else 
                    {
                        $('.deactivate-user-spinner').hide();
                        submitMSG(false, data.reason);
                    }
                }
            }); 
        })
    });

    function submitMSG(valid, msg)
    {
        var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
        $("#deactivate-user-response").removeClass().addClass(msgClasses).text(msg);
    }
});