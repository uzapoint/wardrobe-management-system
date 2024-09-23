document.addEventListener('DOMContentLoaded', function()
{
    $('.create-user-cloth').click(function()
    {
        $("#create-user-cloth").offcanvas("toggle");

        $(".create-user-cloth-form").validator().on("submit", function (event) 
        {
            if(event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.btn-create-user-cloth').prop('disabled', true);
                setTimeout(function()
                {
                    $('.btn-create-user-cloth').prop('disabled', false);
                }, 80000);
                
                $('.create-user-cloth-spinner').show();

                $.ajax({
                    url: ''+app_url+'create-user-cloth',
                    type: 'POST',
                    data: new FormData(this),
                    contentType: false,
                    cache: false, 
                    processData: false,
                    dataType: 'JSON',
                    success : function(data)
                    {
                        if(data.status == "ok")
                        {
                            $('.create-user-cloth-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.create-user-cloth-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#create-user-cloth-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
