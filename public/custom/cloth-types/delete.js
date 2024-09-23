document.addEventListener('DOMContentLoaded', function()
{
    $('.delete-user-cloth-type').click(function(e)
    {
        e.preventDefault();
        var record_id = $(this).attr('href');

        $('#delete-user-cloth-type').modal('show');

        $('.yes-delete-user-cloth-type').click(function()
        {
            $('.delete-user-cloth-type-spinner').show();
            var app_url = $('#app_url').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('.yes-delete-user-cloth-type').prop('disabled', true);
            setTimeout(function()
            {
                $('.yes-delete-user-cloth-type').prop('disabled', false);
            }, 80000);

            $.ajax({
                url: ''+app_url+'delete-user-cloth-type/'+record_id+'',
                type: 'get',
                contentType: false,
                cache: false, 
                processData: false,
                dataType: 'JSON',
                success : function(data)
                {
                    if (data.status == "ok")
                    {
                        $('.delete-user-cloth-type-spinner').hide();
                        submitMSG(true, data.reason);

                        window.setTimeout(function() 
                        {
                            location.reload();
                        }, 100);
                    }else 
                    {
                        $('.delete-user-cloth-type-spinner').hide();
                        submitMSG(false, data.reason);
                    }
                }
            }); 
        })
    });

    function submitMSG(valid, msg)
    {
        var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
        $("#delete-user-cloth-type-response").removeClass().addClass(msgClasses).text(msg);
    }
});