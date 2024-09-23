document.addEventListener('DOMContentLoaded', function()
{
    $('.password-content').hide();
    $('.user-share-buy-back-content').hide();

    var app_url = $('#app_url').val();
    var userPasswordBody = $('.content');
    userPasswordBody.empty(); // Clear previous content

    //RESET PASSWORD--------------------------------------------------------------
    $('.update-user-password').click(function(e) 
    {
        e.preventDefault(); 

        var passwordResetForm = '<input type="hidden" name="user_id" value="'+$(this).attr('href')+'"> '+

        '<div class="row"> '+
            '<div class="col-md-6"> '+
                '<div class="form-group"> '+
                    '<label for="field-5" class="control-label"> New password </label> '+
                    '<input type="password" name="new_password" class="form-control" required autocomplete="off"> '+
                    '<div class="help-block with-errors text-danger"></div> '+
                '</div> '+
            '</div> '+

            '<div class="col-md-6"> '+
                '<div class="form-group"> '+
                    '<label for="field-5" class="control-label"> Confirm password </label> '+
                    '<input type="password" name="confirm_password" class="form-control" required autocomplete="off"> '+
                    '<div class="help-block with-errors text-danger"></div> '+
                '</div> '+
            '</div> '+
        '</div>'+ '';

        $('.no-content').empty();
        userPasswordBody.empty();
        userPasswordBody.append(passwordResetForm);

        $('.user-share-buy-back-content').hide();
        $('.password-content').show();
    });

    //PULL PURCHASED SHARES----------------------------------------------------

    $('.user-buy-back-shares').click(function(e) 
    {
        e.preventDefault(); 

        $('.password-content').hide();
        $('.user-share-buy-back-content').show();
    });
}); 
