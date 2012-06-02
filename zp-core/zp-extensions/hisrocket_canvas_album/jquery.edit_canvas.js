$(window).load(function() {
	$('div.an-image').draggable({
		containment: "#canvas",
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
	// $('#canvas').droppable({
	//         accept : 'div.an-image',
	//         drop : function(event, ui) {
	//                 // $(this).append(ui.draggable);
	// 			alert("aaaa");
	// 			
	// 		}
	// });
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

		$( "#change-canvas-size-button" )
			.button()
			.click(function() {
				$("#change-canvas-size-form label[for=width]").text('Width (current ' + $('#canvas').width() + 'px)');
				$("#change-canvas-size-form label[for=height]").text('Height (current ' + $('#canvas').height() + 'px)');				
				$( "#change-canvas-size-form" ).dialog( "open" );
			});
});