$(function () {

	// Get the form.
	var form = $('#contact-form');

	// Get the messages div.
	var formMessages = $('.ajax-response');

	// Set up an event listener for the contact form.
	$(form).submit(function (e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData,
			dataType: 'json' // On précise qu'on attend du JSON
		})
			.done(function (response) {
				// Make sure that the formMessages div has the 'success' class.
				$(formMessages).removeClass('error').addClass('success');

				// Web3Forms renvoie le message dans response.message
				$(formMessages).text("Merci ! Votre message a été envoyé avec succès.");

				// Clear the form.
				$('#contact-form input,#contact-form textarea').val('');
				// On ne vide pas le access_key !
				$('#contact-form input[type="hidden"]').val('28b949cd-1538-437b-a8a2-594a05581739');
			})
			.fail(function (data) {
				$(formMessages).removeClass('success').addClass('error');

				// Si Web3Forms renvoie une erreur JSON
				if (data.responseJSON && data.responseJSON.message) {
					$(formMessages).text(data.responseJSON.message);
				} else {
					$(formMessages).text('Oups ! Une erreur est survenue lors de l\'envoi.');
				}
			});
	});

});