document.addEventListener('DOMContentLoaded', function()
{
    $('.login-user').click(function(e)
    {
        e.preventDefault();
        
        $("#login-user").modal("show");

        $(".login-user-form").validator().on("submit", function (event) 
        {
            if(event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            }else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.login-user-spinner').show();

                $.ajax({
                    url: ''+app_url+'login-user',
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
                            $('.login-user-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                window.location.href = ""+app_url+"cart-products";
                                //location.reload();
                            }, 100);
                        }else 
                        {
                            $('.login-user-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#login-user-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
