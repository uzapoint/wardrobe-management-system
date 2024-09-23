document.addEventListener('DOMContentLoaded', function()
{
    $(".filter-users-form").validator().on("submit", function (event) 
    {
        event.preventDefault();

        $('.btn-filter-users').prop('disabled', true);
        setTimeout(function()
        {
            $('.btn-filter-users').prop('disabled', false);
        }, 3000);

        var app_url = $('#app_url').val();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        
        $('#filter-users-spinner').show();

        $.ajax({
            url: ''+app_url+'filter-users',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            cache: false, 
            processData: false,
            dataType: 'JSON',
            success : function(data)
            {
                if (data.status == "ok")
                {
                    $('#filter-users-spinner').hide();
                    submitMSG(true, data.reason);

                    window.setTimeout(function() 
                    {
                        window.location.href = ''+app_url+'found-users';
                    }, 200);
                }else 
                {
                    $('#filter-users-spinner').hide();
                    submitMSG(false, data.reason);
                }
            }
        });
    });

    function submitMSG(valid, msg)
    {
        var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
        $("#filter-user-response").removeClass().addClass(msgClasses).text(msg);
    }
}); 