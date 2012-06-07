$(window).load(function() {

	// Make images draggable	
	$('div.an-image').draggable({
		containment: "#canvas",
		scrollSpeed: 40,
		stop: function (event, ui) {
			$.ajax({
				url: $("input[name=callback_url]").val(),
				// dataType: 'json',
				data: {
					action: 'move_image',
					image_file_name : $(this).find('input').val(),
					album_folder : $("input[name=album_folder]").val(),
					position_top : $(this).position().top,
					position_left :	$(this).position().left
				}
			})
		}
	});
	
	
// Make canvas resizable
	$("#canvas").resizable({
		stop: function (event, ui) {
			$.ajax({
				url: $("input[name=callback_url]").val(),
				// dataType: 'json',
				data: {
					action: 'resize_canvas',
					album_folder : $("input[name=album_folder]").val(),
					width : $(this).width(),
					height : $(this).height()
				}
			})
		}		
	});


// Make images resizable	
	$('div.an-image').each(function(item) {
		$(this).resizable({
			// alsoResize: "#" + $(this).find('img').attr('id'),
			aspectRatio: true,
			containment: "#canvas",
			resize: function(event, ui) {
				var $this = $(this);
				var parentwidth = $this.innerWidth();
				var parentheight = $this.innerHeight();
				$(this).find('img').css({'width':parentwidth, 'height':parentheight});
			},
			stop: function (event, ui) {
				$.ajax({
					url: $("input[name=callback_url]").val(),
					// dataType: 'json',
					data: {
						action: 'resize_image',
						image_file_name : $(this).find('input').val(),
						album_folder : $("input[name=album_folder]").val(),
						width : $(this).width(),
						height : $(this).height()
					}
				})
			}			
		});

	});
});


/*
* Creates diealog for canvas resizing
*/
$(function() {
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		var width = $( "#width" ),
			height = $( "#height" ),
			allFields = $( [] ).add( width ).add( height ),
			tips = $( ".validateTips" );

	// Vars for image params dialog			
		var image_width = $( '#image-width'),
			image_height = $( '#image-height' ),
			image_position_top = $( '#image-position-top'),
			image_position_left = $( '#image-position-left' ),
			imageParamsAllFields = $([]).add(image_width).add(image_height).add(image_position_left).add(image_position_top);
			
		// Current image for dimensions dialog
		var currentImage = null;			

		function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}

		function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}

		function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
		
		// Set Current image
		function setCurrentImage (anImage) {
			currentImage = anImage;
		} 
		
		// Get Current image
		function getCurrentImage () {
			return currentImage;
		}		
		
		// Change canvas params dialog
		$( "#change-canvas-size-form" ).dialog({
			autoOpen: false,
			height: 300,
			width: 350,
			modal: true,
			buttons: {
				"Update canvas size": function() {
					var bValid = true;
					allFields.removeClass( "ui-state-error" );

					bValid = bValid && checkLength( width, "width", 3, 16 );
					bValid = bValid && checkLength( height, "height", 3, 16 );
					
					if ( bValid ) {

						$.ajax({
							url: $("input[name=callback_url]").val(),

							data: {
								action: 'resize_canvas',
								album_folder : $("input[name=album_folder]").val(),
								width : width.val(),
								height : height.val()
							}
						});
				
						$('#canvas').css({
							'width' : width.val(),
							'height' : height.val()
						});

						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});
		
		//
		//
		// Change image params dialog
		//
		//
		$( "#change-image-params-form" ).dialog({
			autoOpen: false,
			height: 375,
			width: 350,
			modal: true,
			buttons: {
				"Update image params": function() {
					var bValid = true;
					imageParamsAllFields.removeClass( "ui-state-error" );

					// bValid = bValid && checkLength( image_width, "width", 3, 16 );
					// bValid = bValid && checkLength( image_height, "height", 3, 16 );
					
					if ( bValid ) {

						$.ajax({
							url: $("input[name=callback_url]").val(),
							data: {
								action: 'resize_image',
								image_file_name : getCurrentImage().find('input').val(),
								album_folder : $("input[name=album_folder]").val(),
								width : image_width.val(),
								height : image_height.val()
							}
						});
						
						$.ajax({
							url: $("input[name=callback_url]").val(),
							data: {
								action: 'move_image',
								image_file_name : getCurrentImage().find('input').val(),
								album_folder : $("input[name=album_folder]").val(),
								position_top : image_position_top.val(),
								position_left :	image_position_left.val()
							}
						});						
						
						getCurrentImage().css({
							'width': image_width.val(),
							'height': image_height.val(),
							'top' : image_position_top.val() + "px",
							'left' : image_position_left.val() + "px",							
														
						});	

						getCurrentImage().find('img').css({
							'width': getCurrentImage().innerWidth(), 
							'height': getCurrentImage().innerHeight(),
							
						});
						

						$( this ).dialog( "close" );
					}
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});		

		// Show dimensions and position dialog by double clicking on the image
		$('div.an-image').dblclick(function () {
			setCurrentImage($(this));
			image_width.val($(this).width());
			image_height.val($(this).height());			
			image_position_top.val($(this).position().top);
			image_position_left.val($(this).position().left);			
			$( "#change-image-params-form" ).dialog( "open" );
		});
		
		$('#image-width').change(function () {
			ratio = parseFloat(getCurrentImage().height()) / parseFloat(getCurrentImage().width());
			
			$('#image-height').val(Math.round($('#image-width').val() * ratio));
		});
		
		
		$('#image-height').change(function () {
			ratio = parseFloat(getCurrentImage().width()) / parseFloat(getCurrentImage().height());
			
			$('#image-width').val(Math.round($('#image-height').val() * ratio));			
		});
			
		$( "#change-canvas-size-button" )
			.button()
			.click(function() {
				$("#change-canvas-size-form label[for=width]").text('Width (current ' + $('#canvas').width() + 'px)');
				$("#change-canvas-size-form label[for=height]").text('Height (current ' + $('#canvas').height() + 'px)');				
				$( "#change-canvas-size-form" ).dialog( "open" );
			});
});