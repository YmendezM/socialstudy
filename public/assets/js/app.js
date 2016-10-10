$(document).ready(function(){

	var alert = new Alert('#notifications');

	function VoteFrom(form, button, buttonRevert){
		var ticket = button.closest('.ticket'); 
		var id = ticket.data('id');
		var action = form.attr('action').replace(':id', id); 
		var voteCount = ticket.find('.votes-count');

		buttonRevert = ticket.find(buttonRevert);
		button.addClass('hidden');

		this.getVotes = function(){
			return parseInt(voteCount.text().split('')[0]);//split Regresa un array 

		};

		this.updateCount = function (votes){
			voteCount.text(votes == 1 ? '1 voto' : votes + 'votos'); 

		};

		this.submit = function(success){
			$.post(action, form.serialize(), function (response)
			{

				buttonRevert.removeClass('hidden');
				success(response); 

			}).fail(function()
			{
				button.removeClass('hidden');
				alert.error('Ocurrio un Error :(');
			});

		};

		

	}

	$('.btn-vote').click(function (e){

		e.preventDefault(); 

		var voteFrom = new VoteFrom($('#form-vote'), $(this), '.btn-unvote');

		voteFrom.submit(function (response){
			if(response.success){
				alert.success('Gracias por Tu Voto Cacaguate!!!!!');
				voteFrom.updateCount(voteFrom.getVotes() + 1);
			}
		});
	});
	$('.btn-unvote').click(function (e){

		e.preventDefault(); 

		var voteFrom = new VoteFrom($('#form-unvote'), $(this), '.btn-vote');

		voteFrom.submit(function (response){
			if(response.success){
				alert.error('Quitaste Tu Voto Cacaguate!!!!!');
				voteFrom.updateCount(voteFrom.getVotes()-1);
			}
		});
	});
});

/*
//---------------------------Agregar Voto-------------------------------------------------
$(document).ready(function(){

	var alert = new Alert('#notifications');
	$('.btn-vote').click(function (e){

		e.preventDefault(); 

		var form = $('#form-vote');	

		var button = $(this); 
		var ticket = button.closest('.ticket'); 
		var id = ticket.data('id');

		var action = form.attr('action').replace(':id', id); 

		button.addClass('hidden');

		$.post(action, form.serialize(), function (response){

			ticket.find('.btn-unvote').removeClass('hidden');

			alert.success('Gracias por Tu Voto Cacaguate!!!!!');

			var voteCount = ticket.find('.votes-count');

			var votos = parseInt(voteCount.text().split('')[0]);//split Regresa un array 
			votos++;
			voteCount.text(votos == 1 ? '1 voto' : votos + 'votos'); 

		}).fail(function(){

			button.removeClass('hidden');
			alert.error('Ocurrio un Error :(');
		});
	});
});
//-------------------------------Quitar Voto--------------------------------------------

$(document).ready(function(){

	var alert = new Alert('#notifications');
	$('.btn-unvote').click(function (e){

		e.preventDefault(); 

		var form = $('#form-unvote');	

		var button = $(this); 
		var ticket = button.closest('.ticket'); 
		var id = ticket.data('id');

		var action = form.attr('action').replace(':id', id); 

		button.addClass('hidden');

		$.post(action, form.serialize(), function (response){

			ticket.find('.btn-vote').removeClass('hidden');

			alert.success('Quitaste Tu Voto Cacaguate!!!!!');

			var voteCount = ticket.find('.votes-count');

			var votos = parseInt(voteCount.text().split('')[0]);//split Regresa un array 
			votos--;
			voteCount.text(votos == 1 ? '1 voto' : votos + 'votos'); 

		}).fail(function(){

			button.removeClass('hidden');
			alert.error('Ocurrio un Error :(');
		});
	});
});
}]*/

