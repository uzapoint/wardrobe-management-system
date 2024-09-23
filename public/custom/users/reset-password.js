document.addEventListener('DOMContentLoaded', function()
{
    $('.reset-password').click(function(e)
    {
        e.preventDefault();
        
        $('.user_id').val($(this).attr('href'));
        
        $("#reset-password").offcanvas("toggle");

        $(".reset-password-form").validator().on("submit", function (event) 
        {
            if (event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.reset-password-spinner').show();

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
                            $('.reset-password-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.reset-password-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#reset-password-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
