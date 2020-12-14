
var stickyNav = $('body').offset().top;
window.onscroll = function() {
    NavFixed();
};
function NavFixed() {
    let scroll = window.pageYOffset > stickyNav ? true : false;
    if (scroll) {
        $('header').addClass('is-scroll')
    }else{
        $('header').removeClass('is-scroll')
    }
}

$('.overlay-content').find('.view_item').on('click', function(){
	var father = $(this).parent().parent().parent().parent().parent()
    var name = father.find('.product-titel').find('a').html()
    var link = father.find('.product-titel').find('a').attr('href')
	var image = father.find('.box-content').find('img').attr('src')
	var price = father.find('.price-box').find('.price').html()
	var detail = father.find('.overlay-content').find('p').html()

    // console.log(image)
	$('#quickview-wrapper').find('.main-image.images').find('img').attr('src', image)
	$('.product-info').find('h1').html(name)
	$('.product-info').find('.amount').html(price)
    $('.product-info').find('.quick-desc').html(detail)
    $('.product-info').find('.see-all').attr('href', link)

	var id = father.find('.id_item').val()
	$.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/product_view',
        type: "GET",
        data: {
            id: id,
        },
        success:function(data){ //dữ liệu nhận về
            console.log(data)
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })
})
$.fn.hasAttr = function(name) {  
   return this.attr(name) !== undefined;
};
$('.edit_type').on('click', function(){
    var obj = $(this);
    var father = $(this).parent().parent();
    var attr = father.find('input').attr('disabled');
    if (father.find('input').hasAttr('disabled')) {
        $(this).html('Khóa')
        father.find('input').removeAttr('disabled');
    }else{
        $(this).html('Thay đổi')
        father.find('input').attr('disabled', 'true');
    }
})

$('.shop-icon').find('a').on('click', function(){
    var father = $(this).parent().parent().parent().parent().parent()
    var name = father.find('.pro-name').html()
    var image = father.find('.product-img').find('img').attr('src')
    var link = father.find('.pro-name').attr('href')
    var price = father.find('.list-pro-price').find('.old').html()
    var detail = father.find('.single-pro-content').find('p').html()
    var id = father.find('.id_item').val()
    // console.log(father)
    $('#quickview-wrapper').find('.main-image.images').find('img').attr('src', image)
    $('.product-info').find('h1').html(name)
    $('.product-info').find('.amount').html(price)
    $('.product-info').find('.quick-desc').html(detail)
    $('.product-info').find('.see-all').attr('href', link)

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/product_view',
        type: "GET",
        data: {
            id: id,
        },
        success:function(data){ //dữ liệu nhận về
            console.log(data)
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })
})
$('.search-area').find('a').on('click', function(){
    $(this).parent().find('.header-search').toggleClass('is-open');
})

// check valid and select data 
// var color = $('.attribute-fieldset.select_data.color_size').find('.color_data').val();
// var size = $('.attribute-fieldset.select_data.color_size').find('.size_data').val();
// $('.attribute-fieldset.select_data.color_size').find('.color_size_data.has_buy').each(function(index){
//     if($(this).attr('color-value') == color && $(this).attr('size-value') == size){
//         $(this).addClass('is-select')
//     }
//     $(this).on('click', function(){
//         $('.attribute-fieldset.select_data.color_size').find('.color_size_data.has_buy').removeClass('is-select')
//         $(this).addClass('is-select')
//         $('.attribute-fieldset.select_data.color_size').find('.color_data').val($(this).attr('color-value'));
//         $('.attribute-fieldset.select_data.color_size').find('.size_data').val($(this).attr('size-value'));
//     })
// });
