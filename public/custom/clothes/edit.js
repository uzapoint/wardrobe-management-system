document.addEventListener('DOMContentLoaded', function()
{
    $('.edit-user-cloth').click(function(e)
    {
        e.preventDefault();

        $('.user-cloth-id').val($(this).attr('href'));
        $('.color').val($(this).attr('color'));
        $('.user-cloth-type-id').val($(this).attr('userClothTypeId')).trigger('change');
        
        $("#edit-user-cloth").offcanvas("toggle");

        $(".edit-user-cloth-form").validator().on("submit", function (event) 
        {
            if (event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.edit-user-cloth-spinner').show();

                $.ajax({
                    url: ''+app_url+'update-user-cloth',
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
                            $('.edit-user-cloth-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.edit-user-cloth-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#edit-user-cloth-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
