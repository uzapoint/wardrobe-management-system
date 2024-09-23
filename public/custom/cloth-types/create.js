document.addEventListener('DOMContentLoaded', function()
{
    $('.create-user-cloth-type').click(function()
    {
        $("#create-user-cloth-type").offcanvas("toggle");

        //ADD MORE
            var counter = 1;

            $('a#add-user-cloth-type').click(function () 
            {
                counter += 1;
                $('.user-cloth-type').append(
                    '<div style="padding-top: 3%;"><input name="names[]' + '" type="text" class="form-control" placeholder="Enter cloth type" autocomplete="off"></div><a class="remove text-danger" href="javascript:void(0)">Remove</a><br>');
            });

            $(document).on('click', '.remove', function()
            {
                var $this = $(this);
                $this.add($this.prev()).add($this.next()).remove();
            })
        //END

        $(".create-user-cloth-type-form").validator().on("submit", function (event) 
        {
            if(event.isDefaultPrevented()) 
            {
                //submitMSG(false, "All fields must be filled");
            } else 
            {
                event.preventDefault();

                var app_url = $('#app_url').val();
                var csrf_token = $('meta[name="csrf-token"]').attr('content');
                
                $('.btn-create-user-cloth-type').prop('disabled', true);
                setTimeout(function()
                {
                    $('.btn-create-user-cloth-type').prop('disabled', false);
                }, 80000);
                
                $('.create-user-cloth-type-spinner').show();

                $.ajax({
                    url: ''+app_url+'create-user-cloth-type',
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
                            $('.create-user-cloth-type-spinner').hide();
                            submitMSG(true, data.reason);

                            window.setTimeout(function() 
                            {
                                location.reload();
                            }, 100);
                        }else 
                        {
                            $('.create-user-cloth-type-spinner').hide();
                            submitMSG(false, data.reason);
                        }
                    }
                });
            }
        });

        function submitMSG(valid, msg)
        {
            var msgClasses = valid ? "text-success text-center" : "text-danger text-center";
            $("#create-user-cloth-type-response").removeClass().addClass(msgClasses).text(msg);
        }
    });
}); 
