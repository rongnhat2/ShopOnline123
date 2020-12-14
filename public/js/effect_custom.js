
// copy clipboard multi
$('.image-tile').click(function(event){
	// console.log(this)
	// console.log($(this).find(".image_url")[0])
	var item = $(this).find(".image_url")[0];
    var range = document.createRange();
    range.selectNode(item);
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
    // hông được none đối tượng
});
$(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
        	    	$('#lightgallery').append(
        	    		'<div class="image-tile">'+
                        '    <img src="'+ event.target.result +'" alt="image small" />'+
                        '</div>'				
			    		); 
                    }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };
    $('#LoadImage').on('change', function() {
        $('#lightgallery').find('.image-tile').remove();
        imagesPreview(this, '.upload-image');
    });
});


          
$('.image-select').on('click', function(e){
    var image = $(this).find('.image_url').text()
    var image_id = $(this).find('img').attr('image_id')
    // console.log(image_id)
    $('.image_loading').find('img').attr('src', image)
    $('.image_loader').find('input').attr('value', image_id)
    
})

$('.image_loader').on('click', function(){
    console.log(1)
    $('.lightGallery').find('.image-tile').remove();                                   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/gallery/getLibrary",
        type: "GET",
        success:function(data){ //dữ liệu nhận về
            // console.log(data)
            for (var i = 0; i < data.length; i++) {
                 console.log(data[i].url)
                $('.lightGallery').append( 
                    '<div class="image-tile image-select" onclick="showSwal(\'append-image\')">'+
                    '    <div class="image_url">'+
                    '        http://' + window.location.host + '/' + data[i].url +
                    '    </div>'+
                    '    <img src="http://' + window.location.host + '/' + data[i].url + '" image_id="'+data[i].id+'" />'+
                    '</div>'                              
                );
            }  
            $('.image-select').on('click', function(e){
                var image = $(this).find('.image_url').text()
                var image_id = $(this).find('img').attr('image_id')
                // console.log(image_id)
                $('.image_loading').find('img').attr('src', image)
                $('.image_loader').find('input').attr('value', image_id)
                
                var item = $(this).find(".image_url")[0];
                var range = document.createRange();
                range.selectNode(item);
                window.getSelection().removeAllRanges(); // clear current selection
                window.getSelection().addRange(range); // to select text
                document.execCommand("copy");
                window.getSelection().removeAllRanges();// to deselect
            })              
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })

})    


$('.dropify-clear').on('click', function(){
    $('#lightgallery').find('.image-tile').remove()
})



//  NEW loadimage and change data


try{
    $('.input_render').each(function(index){
        var data_name = $(this).attr('input-data')
        var data_value = $(this).val()
        $('.I-preview').find('.'+data_name).html(data_value)
    });
}catch(err){ }

$('.get_image_gallery').on('click', function(){
    $('.lightGallery').find('.image-tile').remove();                                   
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/admin/gallery/getLibrary",
        type: "GET",
        success:function(data){ //dữ liệu nhận về
            // console.log(data)
            for (var i = 0; i < data.length; i++) {
                 console.log(data[i].url)
                $('.lightGallery').append( 
                    '<div class="image-tile image-select" onclick="showSwal(\'append-image\')">'+
                    '    <div class="image_url">'+
                    '        http://' + window.location.host + '/' + data[i].url +
                    '    </div>'+
                    '    <img src="http://' + window.location.host + '/' + data[i].url + '" image_id="'+data[i].id+'" />'+
                    '</div>'                              
                );
            }  
            $('.image-select').on('click', function(e){
                var image = $(this).find('.image_url').text()
                var image_id = $(this).find('img').attr('image_id')
                // console.log(image_id)
                $('.image_resurt').attr('src', image)
                $('.get_image_gallery').find('input').attr('value', image_id)
                $('.get_image').attr('value', "2")
            })              
        },
        error: function (request, status, error) {
            alert(request.responseText);
        }
    })
})    
$('.input_render').on('keyup', function(){
    var data_name = $(this).attr('input-data')
    var data_value = $(this).val()
    $('.I-preview').find('.'+data_name).html(data_value)
}) 
$('.input_render').on('change', function(){
    var data_name = $(this).attr('input-data')
    var data_value = $(this).val()
    $('.I-preview').find('.'+data_name).html(data_value)
})
$('.change_language-button.en_button').on('click', function(){
    $('.change_language_item-en').removeClass('item_language_none')
    if (!$('.change_language_item-jp').hasClass('item_language_none')) {
        $('.change_language_item-jp').addClass('item_language_none')
    }
    $('.change_language-button').removeClass('is-select')
    $(this).addClass('is-select')
})
$('.change_language-button.jp_button').on('click', function(){
    $('.change_language_item-jp').removeClass('item_language_none')
    if (!$('.change_language_item-en').hasClass('item_language_none')) {
        $('.change_language_item-en').addClass('item_language_none')
    }
    $('.change_language-button').removeClass('is-select')
    $(this).addClass('is-select')
})

$(function() {
    var imagesPreview = function(input, placeToInsertImagePreview, e) {
        var img = new Image;
        img.src = URL.createObjectURL(e.target.files[0]);
        img.onload = function() {
            $(placeToInsertImagePreview).attr('src', URL.createObjectURL(e.target.files[0]))
            $('.get_image').attr('value', "1")
        }
    };
    $('#upload_image').on('change', function(e) {
        imagesPreview(this, '.image_resurt', e);
    });
    var css_icon = $('.nation_icon').find('i').attr('title');
    $('.option_nation').find('.flag-icon-'+css_icon).parent().addClass('is-select');

    try{
        var data_icon_setup = $('.distance.is-select').html().slice(0, 57);
        $('.nationality').val(data_icon_setup);
        $('.nationality_data').html(data_icon_setup);
    }catch(ex){
        
    }
});


$('.select_nation').on('click', function(){
    $('.option_nation').toggleClass('is-open')
})
$('.distance').on('click', function(){
    $('.distance').removeClass('is-select');
    $(this).addClass('is-select');
    var data_icon = $(this).html().slice(0, 57);
    $('.nation_icon').find('i').remove();
    $('.nation_icon').append(data_icon);
    $('.card_location').find('i').remove();
    $('.card_location').append(data_icon);
    $('.nationality').val(data_icon);
    $('.option_nation').removeClass('is-open')
})
