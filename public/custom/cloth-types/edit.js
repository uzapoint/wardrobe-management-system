document.addEventListener('DOMContentLoaded', function()
{
    $('.edit-user-cloth-type').click(function(e)
    {
        e.preventDefault();

        $('.user-cloth-type-id').val($(this).attr('href'));
        $('.name').val($(this).attr('name'));
        
        $("#edit-user-cloth-type").offcanvas("toggle");

        $(".edit-user-cloth-type-form").validator().on("submit", function (event) 
        {
            if (event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.edit-user-cloth-type-spinner').show();

                $.ajax({
                    url: ''+app_url+'update-user-cloth-type',
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
                            $('.edit-user-cloth-type-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.edit-user-cloth-type-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#edit-user-cloth-type-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
