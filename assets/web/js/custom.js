(function($) {
    "use strict";
	
	/* ..............................................
	Loader 
    ................................................. */
	
	$(window).on('load', function() { 
		$('.preloader').fadeOut(); 
		$('#preloader').delay(550).fadeOut('slow'); 
		$('body').delay(450).css({'overflow':'visible'});
	});
	
	/* ..............................................
    Fixed Menu
    ................................................. */
    
	$(window).on('scroll', function () {
		if ($(window).scrollTop() > 50) {
			$('.top-header').addClass('fixed-menu');
		} else {
			$('.top-header').removeClass('fixed-menu');
		}
	});
	
	/* ..............................................
    Gallery
    ................................................. */
	
	$('#slides').superslides({
		inherit_width_from: '.cover-slides',
		inherit_height_from: '.cover-slides',
		/*play: 5000,*/
		animation: 'fade',
		
	});
	
	$( ".cover-slides ul li" ).append( "<div class='overlay-background'></div>" );
	
	/* ..............................................
    Map Full
    ................................................. */
	
	$(document).ready(function(){ 
		$(window).on('scroll', function () {
			if ($(this).scrollTop() > 100) { 
				$('#back-to-top').fadeIn(); 
			} else { 
				$('#back-to-top').fadeOut(); 
			} 
		}); 
		$('#back-to-top').click(function(){ 
			$("html, body").animate({ scrollTop: 0 }, 600); 
			return false; 
		}); 
	});
	
	/* ..............................................
    Special Menu
    ................................................. */
	
	var Container = $('.container');
	Container.imagesLoaded(function () {
		var portfolio = $('.special-menu');
		portfolio.on('click', 'button', function () {
			$(this).addClass('active').siblings().removeClass('active');
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({
				filter: filterValue
			});
		});
		var $grid = $('.special-list').isotope({
			itemSelector: '.special-grid'
		});
	});
	
	/* ..............................................
    BaguetteBox
    ................................................. */
	
	baguetteBox.run('.tz-gallery', {
		animation: 'fadeIn',
		noScrollbars: true
	});
	
	
	
	/* ..............................................
    Datepicker
    ................................................. */
	
	$('.datepicker').pickadate();
	
	$('.time').pickatime();
	
	
	
	
	
}(jQuery));


var dt_obj= new Date();
function addOption(selectbox,text,value )
{
	var optn = document.createElement("OPTION");
	optn.text = text;
	optn.value = value;
	selectbox.options.add(optn);
}
///////////// date //////////////////
var today_date= dt_obj.getDate();
function addOption_list1(){
for (var i=1; i < 32;++i){
addOption(document.drop_list.dt_list, i, i);
if(i== today_date){document.drop_list.dt_list.options[i].selected=true;}
}
addOption_list2();
}
//////////////End of Date //////////


///////////// Month //////////////////
var current_month=dt_obj.getMonth() +1;
function addOption_list2(){
var month = new Array("January","February","March","April","May","June","July","August","September","October","November","December");
for (var i=0; i < month.length;++i){
addOption(document.drop_list.Month_list, month[i], month[i]);
if(i== current_month){document.drop_list.Month_list.options[i].selected=true;}
}
addOption_list3();

}
//////////////End of Month //////////


///////////// Year //////////////////
var current_year=dt_obj.getFullYear();
function addOption_list3(){
for (var i=0; i < 7;++i){
var j=current_year+i-2;
match_year=current_year+i;
addOption(document.drop_list.year_list, j, j);
if((j-1)== current_year ){document.drop_list.year_list.options[i].selected=true;}
}

}




$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the minimum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Sorry, the maximum value was reached');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


script = {
	addCart: function($id){
		alert($id)
	}
};
/*var buttonPlus = $('.button-plus');
var buttonMin = $('.button-minus');
var quantity = $('.quantity-field');*/
/*For plus and minus buttons*/
/*$buttonPlus.click(function(){
  $quantity.val( parseInt($quantity.val()) + 1 );
});
$buttonMin.click(function(){
  $quantity.val( parseInt($quantity.val()) - 1 );
});*/

/*$(document).ready(function(){
  $("#hide").click(function(){
    $("p").hide();
  });
  $("#show").click(function(){
    $("p").show();
  });
});*/