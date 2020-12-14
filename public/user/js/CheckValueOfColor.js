
var color = $('.attribute-fieldset.select_data.color').find('.color_data').val(null);
var size = $('.attribute-fieldset.select_data.size').find('.size_data').val(null);
var size = $('.attribute-fieldset.select_data.size').find('.color_id').val(null);
var item_id = $('.item_id').val();

$('.color_select').on('click', function(){
    var color_data = $(this).attr('data-value')
    var color_id = $(this).attr('data-id')
    $('.color_select').removeClass('is-select')
    $('.size_select').removeClass('is-select')
    $(this).addClass('is-select')
    $('.attribute-fieldset.select_data.color').find('.color_data').val(color_data);
    $('.attribute-fieldset.select_data.color').find('.color_id').val(color_id);
    $('.attribute-fieldset.select_data.size').find('.size_data').val(null);
    $('.size_wrapper').removeClass('is-open');
    $('.color_'+color_id).addClass('is-open');
    $('.quantity_value').html("Hãy chọn size");
})
$('.size_select').on('click', function(){
    var size_data = $(this).attr('size-value')
    var quantity = $(this).attr('quantity-value')
    $('.size_select').removeClass('is-select')
    $(this).addClass('is-select')
    $('.attribute-fieldset.select_data.size').find('.size_data').val(size_data);
    $('.item_order').attr("max", quantity);
    $('.quantity_value').html("Trong kho còn: "+quantity);

})