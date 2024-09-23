document.addEventListener('DOMContentLoaded', function()
{
    $('.create-user').click(function(e)
    {
        e.preventDefault();
        
        $("#create-user").offcanvas("toggle");

        $(".create-user-form").validator().on("submit", function (event) 
        {
            if (event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.create-user-spinner').show();

                $.ajax({
                    url: ''+app_url+'create-user',
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
                            $('.create-user-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.create-user-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#create-user-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
