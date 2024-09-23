document.addEventListener('DOMContentLoaded', function()
{
    $(".reset-user-password-form").validator().on("submit", function (event) 
    {
        if (event.isDefaultPrevented()) 
        {
            //submitMSG(false, "All fields must be filled");
        } else 
        {
            event.preventDefault();

            var app_url = $('#app_url').val();
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            
            $('#reset-user-password-spinner').show();

            $.ajax({
                url: ''+app_url+'reset-password',
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
                        $('#reset-user-password-spinner').hide();
                        submitMSG(true, data.reason);

                        window.setTimeout(function() 
                        {
                            location.reload();
                        }, 100);
                    }else 
                    {
                        $('#reset-user-password-spinner').hide();
                        submitMSG(false, data.reason);
                    }
                }
            });
        }
    });

    function submitMSG(valid, msg)
    {
        var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
        $("#reset-user-password-response").removeClass().addClass(msgClasses).text(msg);
    }
}); 
