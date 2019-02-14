<script>
	$('.upvote').click(function(){
		console.log($(this).data('value'));
		$.ajax('/votes/create', {
			type: "POST",
			data: {
				vote: 1,
				review: $(this).data('value'),
				_token: "{{ csrf_token() }}"
			}
		}).fail(function(e) {
			console.log(e.responseText);
		}).done(function(response) {
			console.log(response, 'response');
			$('#' + response[1]).html(response[0]);
			$('.up-' + response[1]).addClass('upmod');
			$('.score-' + response[1]).addClass('likes');
			$('.down-' + response[1]).removeClass('downmod');
			$('.score-' + response[1]).removeClass('dislikes');
		});
	});

	$('.downvote').click(function(){
		console.log($(this).data('value'));
		$.ajax('/votes/create', {
			type: "POST",
			data: {
				vote: 0,
				review: $(this).data('value'),
			  _token: "{{ csrf_token() }}"
			} 
		}).done(function(response) {
			console.log(response, 'response');
			$('#' + response[1]).html(response[0]);
			$('.down-' + response[1]).addClass('downmod');
			$('.score-' + response[1]).addClass('dislikes');
			$('.up-' + response[1]).removeClass('upmod');
			$('.score-' + response[1]).removeClass('likes');
		});
	});
</script>