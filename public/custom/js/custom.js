document.addEventListener('DOMContentLoaded', function()
{
    $('.product-type-id').on('change',function()
    {
        var val = $(this).val();

        var sub = $('.product-type-category-id');
        $('option',sub).filter(function()
        {
            if($(this).attr('data-group')===val||$(this).attr('data-group')==='SHOW')
            {
                if($(this).parent('span').length)
                {
                    $(this).unwrap()
                }
            }else
            {
                if(!$(this).parent('span').length)
                {
                    $(this).wrap("<span>").parent().hide()
                }
            }
        })
    });

    $('.product-type-id').trigger('change');
});