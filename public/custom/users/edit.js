document.addEventListener('DOMContentLoaded', function()
{
    $('.edit-user').click(function(e)
    {
        e.preventDefault();
        
        $('.user-id').val($(this).attr('href'));
        $('.username').val($(this).attr('username'));
        $('.phone').val($(this).attr('phone'));
        $('.email').val($(this).attr('email'));

        $("#edit-user").offcanvas("toggle");

        $(".edit-user-form").validator().on("submit", function (event) 
        {
            if (event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');

                $('.edit-user-spinner').show();

                $.ajax({
                    url: ''+app_url+'update-user',
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
                            $('.edit-user-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.edit-user-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#edit-user-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
