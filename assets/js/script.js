function confirm_delete(){
	if(confirm("Do you want delete this record?")){
  		return true;
	} 
	else{
  		return false;
	}
}

$('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    
    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});


$( ".item:first-child").addClass('active');


remove_product = function(id){
    if(confirm('Do you want to delete this product?') == true){
        $.ajax({
            type: 'post',
            url: cartAjax,
            data: ({id: id}),
            success: function(){
                var count = parseInt($('#cart_count').html()) - 1;
                $('#cart_count').html(count);
                $('#'+id).remove();
            }
        })
    }
}

add_to_cart = function(id){
    $.ajax({
        type: 'post',
        url: insertAjax,
        data: ({id: id}),
        success: function(result){
            var count = parseInt($('#cart_count').html()) + 1;
            $('#cart_count').html(count);
            $('.icon-shopping-cart').effect("shake", {
                    times: 2
                }, 200);
        }
    })
}



$(document).ready(function(){
    $('#ex1').zoom();
});

$('.edit_slider').on('click', function(){
    $('.checkbox_input').show();
    $('.edit_slider').hide();
    $('.end_editing').addClass('end_class');
    $('.end_editing').show();
})


$('.end_editing').on('click', function(){
    $('.checkbox_input').hide();
    $('.edit_slider').show();
    $('.end_editing').hide();
})

changeSlider = function(id){
    $.ajax({
        type: 'post',
        url: selectSliderImage,
        data: ({id: id}),
            success: function(result){
        }
    })
}

$(".DragItem").draggable({
    opacity: 0.5,
    revert: "invalid",
    start: function (e, ui) {
        ui.helper.animate({
            width: 150,
            height: 100
        });
        $(this).data("origPosition", $(this).position());
    },
    helper: "clone"
});


$(".DropItem").droppable({
    hoverClass: 'add',
    accept: ".DragItem",
    drop: function(event, ui) {
    var id = ui.draggable.attr("id");
        $.ajax({
            type: 'post',
            url: insertAjax,
            data: ({id: id}),
            success: function(result){
                var count = parseInt($('#cart_count').html()) + 1;
                $('#cart_count').html(count);
                $('.icon-shopping-cart').effect("shake", {
                    times: 2
                }, 200);
            }
        })
    },
    out: function(){
        $('.DropItem .cart_img').css({'width':'33px'});
    }
});


$('.add_prod').on('keypress', function(e){
    add_prod = $(this);
    if(e.keyCode == 32) {
        $.ajax({
            success: function(result){
                var reg1 = /a/;
                var reg2 = /b/;
                var reg3 = /v/;
                var reg4= /g/;
                var reg5 = /d/; 
                var reg6 = /ye/;
                var reg7 = /yo/;
                var reg8 = /j/;
                var reg9 = /z/;
                var reg10 = /i/;
                var reg11 = /iy/;
                var reg12 = /k/; 
                var reg13 = /l/;
                var reg14 = /m/;
                var reg15 = /n/;
                var reg16 = /o/;
                var reg17 = /p/;
                var reg18 = /r/;
                var reg19 = /s/;
                var reg20 = /t/; 
                var reg21 = /y/;
                var reg22 = /f/;
                var reg23 = /x/; 
                var reg24 = /c/;
                var reg25 = /ch/; 
                var reg26 = /sh/;
                var reg27 = /shch/;
                var reg28 = /~/; 
                var reg29 = /i/;
                var reg30 = /'/;
                var reg31 = /e/;
                var reg32 = /u/; 
                var reg33 = /ya/;

                var str = add_prod.val();
                add_prod.val(str
                    .replace(reg33, 'я')
                    .replace(reg1, 'а')
                    .replace(reg2, 'б')
                    .replace(reg3, 'в')
                    .replace(reg4, 'г')
                    .replace(reg5, 'д')
                    .replace(reg6, 'е')
                    .replace(reg7, 'ё')
                    .replace(reg8, 'ж')
                    .replace(reg9, 'з')
                    .replace(reg10, 'и')
                    .replace(reg11, 'й')
                    .replace(reg12, 'к')
                    .replace(reg13, 'л')
                    .replace(reg14, 'м')
                    .replace(reg15, 'н')
                    .replace(reg16, 'о')
                    .replace(reg17, 'п')
                    .replace(reg18, 'р')
                    .replace(reg19, 'с')
                    .replace(reg20, 'т')
                    .replace(reg21, 'у')
                    .replace(reg22, 'ф')
                    .replace(reg23, 'х')
                    .replace(reg24, 'ц')
                    .replace(reg25, 'ч')
                    .replace(reg26, 'ш')
                    .replace(reg27, 'щ')
                    .replace(reg28, 'ъ')
                    .replace(reg29, 'ы')
                    .replace(reg30, 'ь')
                    .replace(reg31, 'э')
                    .replace(reg32, 'ю')
                );
            }
        })
    }
})

$('.star_li').addClass('star_anactive');
$('.star_li').hover(
    function(){
        if($(this).hasClass('star_anactive') && $(this).prevAll().hasClass('star_anactive')) {
            $(this).removeClass('star_anactive').addClass('star_wait');
            $(this).prevAll().removeClass('star_anactive').addClass('star_wait');
        }  
    },
    function(){
        if($(this).hasClass('star_active') && $(this).prevAll().hasClass('star_active')){
            $(this).nextAll().removeClass('star_wait').addClass('star_anactive');
        }
    }
)

$(document).on('click', '.star_li', function(){
    star_li = $(this);
    var id = $(this).parent().parent().data('id')
    var value = $(this).attr('value');//80
    $.ajax({
        type: 'post',
        url: rate,
        data: ({id: id, val: value}),
        success: function(result){
            star_li.prevAll().removeClass('star_wait');   
            star_li.prevAll().addClass('star_active');
            star_li.removeClass('star_wait');   
            star_li.addClass('star_active');  
        }
    })
})



























// -----------start of bin part
// $('.del_drag').draggable({
//     revert: 'invalid',
//     start: function(e, ui){
//         $(ui.helper).css("width", "100").css("height","100");
//         $(this).data("origPosition", $(this).position());
//     },
//     helper: 'clone'
// });

// $('.bin').droppable({
//     hoverClass: 'bin_hover',
//     accept: '.del_drag',
//     drop: function(event, ui){
//         id = ui.draggable.attr('id');
//         $.ajax({
//             type: 'post',
//             url: cartAjax,
//             data: ({id: id}),
//             success: function(){
//                 var count = parseInt($('#cart_count').html()) - 1;
//                 $('#cart_count').html(count);
//                 $('#'+id).remove();
//             }
//         })
//     }
// })
// -----------end of bin part

