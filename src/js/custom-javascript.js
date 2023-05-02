document.addEventListener('DOMContentLoaded', function() {

	if (jQuery(window).width() < 768 ) {
		jQuery('.navbar .dropdown > a').click(function(event) {
			event.preventDefault();
			if (!jQuery(this).hasClass("parent-clicked")) {
				jQuery(this).addClass("parent-clicked");
			} else {
			location.href = this.href;
			}
		});
	}

	window.addEventListener('scroll', function() {
		if (window.scrollY > 10) {
			jQuery('#wrapper-navbar').addClass('sticky-top');
		} else {
			jQuery('#wrapper-navbar').removeClass('sticky-top');
		} 
	});

	jQuery('.btn').click(function(event) {
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			'event': 'btn_clicked',
			'btn_text': jQuery(this).text()
		});
	});

	jQuery(".circle-blue").on("click", function(e){
		e.preventDefault();
		
		var target_offset = jQuery( "a[name='start']" ).offset().top - jQuery('#wrapper-navbar').outerHeight();

		jQuery('html, body').animate({
			scrollTop: target_offset 
		}, 500);

	});

	jQuery("#show-rodo-more").on("click", function(e){
		e.preventDefault();

		jQuery("#rodo-more").toggleClass('inline');

		if(jQuery(this).html() == 'Więcej' ) {
			jQuery(this).html('Mniej');
		} else {
			jQuery(this).html('Więcej');
		}
	});

	var mouseEvent = function(e) {

		var shouldShowExitIntent = 
        ( !e.toElement ||
        !e.relatedTarget) &&
        e.clientY < 10;

		if (shouldShowExitIntent) {
			document.removeEventListener('mouseout', mouseEvent);
			
			jQuery('.exit_popup').addClass('visible'); 
		}
	};

	setTimeout(function(){
		document.addEventListener('mouseout', mouseEvent);
	}, 10000); 

	
	jQuery('.exit_popup_close').on("click", function(e){
		e.preventDefault();
		
		jQuery('.exit_popup').removeClass('visible'); 

	});

	jQuery('.accordion .collapse').on('show.bs.collapse', function(e) {
		var card = jQuery(this).closest('.card');
		var open = jQuery(jQuery(this).data('parent')).find('.collapse.show');
		
		var additionalOffset = 0;
		if(card.prevAll().filter(open.closest('.card')).length !== 0)
		{
			  additionalOffset =  open.height() + jQuery('#wrapper-navbar').height() + 50;
		}
		jQuery('html,body').animate({
		  scrollTop: card.offset().top - additionalOffset
		}, 500);
	  });

	
	function counter() {
		
		var counterContainer = jQuery('.counter .numbers');

		if(counterContainer.length) {
			var counter = 0;
			var limit = 100;
			var img0 = jQuery('<img class="nolazy" />');
			var img1 = jQuery('<img class="nolazy" />');
			var img2 = jQuery('<img class="nolazy" />');

			counterContainer.append(img0);
			counterContainer.append(img1);
			counterContainer.append(img2);

			var timer = setInterval(function () {
				
				var number = counter.toString().split('');

				if(number[0]) {
					img0.attr('src', 'wp-content/themes/understrap-child/img/svg/' + number[0] + '.svg');
				}

				if(number[1]) {
					img1.attr('src', 'wp-content/themes/understrap-child/img/svg/' + number[1] + '.svg');
				}

				if(number[2]) {
					img2.attr('src', 'wp-content/themes/understrap-child/img/svg/' + number[2] + '.svg');
				}

				if (counter === limit) {
					clearInterval(timer)
				}
	
				counter++;
			}, 25);
		}
	}						
	
	counter();
});


