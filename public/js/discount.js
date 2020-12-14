
$('.update_discount').each(function( index ) {
	$(this).on('click', function(){
        // var data = $(this).parent().find('.value_input').val()
        var value_id = $(this).attr('value_id')

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "/discount/updateDiscount",
            type: "GET",
            data: {
                value_id: value_id,
            },
            success:function(data){ //dữ liệu nhận về
                console.log(data)
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        })
        // $('.update_discount').removeClass('bg_success')
        // $('.update_discount').removeClass('bg_danger')
        if($(this).parent().hasClass('success')){
        	$('.discount_action').removeClass('success')
        	$('.discount_action').find('a').html('Tạm Ẩn')
        }else{
        	$('.discount_action').removeClass('success')
        	$('.discount_action').find('a').html('Tạm Ẩn')
        	$(this).parent().addClass('success')
        	$(this).html('Hiển Thị')
        }
    })
});



