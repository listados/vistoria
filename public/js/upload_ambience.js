
  //VARIÁVEL PARA CONFIRMAR SE DEU CERTO O UPLOAD
  confirm_complet = false;
  Dropzone.autoDiscover = false;
  myDropzone = new Dropzone('#form-dropzone-upload', {
  	url: domain_complet + '/vistoria/upload',
  	dictDefaultMessage: "Arraste seus arquivos para essa área ou click para localizar",
  	paramName: "img_photo",
  	autoProcessQueue: false,
	maxFilesize: 6,// MB
	clickable: true,
	parallelUploads: 10,
	uploadMultiple: true,
	acceptedFiles: "image/*,.xlsx,.xls,.pdf,.doc,.docx",
	maxFiles: 10,
	addRemoveLinks: true,
	createImageThumbnails: true,
	dictRemoveFile: 'Excluir',
	dictFileTooBig: "O tamanho máximo é de 6mb",//mensagem de qndo o arquivo é maior q definido em maxFilesize
	dictMaxFilesExceeded: 'Máximo de arquivos são 10',//mensagem qndo excede o total de arquivos para enviar
	dictResponseError: "Ocorreu um erro, atualize a página e tente novamente.",
	resizeWidth: 500,
	resizeHeight: 500,
	dictResponseError: true,
	headers: {
		'X-CSRFToken': $('meta[name="token"]').attr('content')
	},
	init: function() {
		var submitButton = document.querySelector("#send_file_upload")
		myDropzone = this; // closure

		submitButton.addEventListener("click", function() {
		//   myDropzone.processQueue(); // Tell Dropzone to process all queued files.
		});
		 // this.on('error', function(file, response) {
   //          // (assuming your response object has an errorMessage property...)
   //         new PNotify({
			// 	title: 'Erro',
			// 	text: 'Upload realizado com sucesso',
			// 	styling: 'fontawesome',       
			// 	type: 'error',
			// 	icon: 'true',
			// 	animation: 'fade',
			// 	delay: 5000,
			// 	animate_speed: "slow"
			// });

   //      });
	}

}).on("complete", function(file) {
	myDropzone.removeFile(file);
	new PNotify({
		title: 'Sucesso',
		text: 'Upload realizado com sucesso',
		styling: 'fontawesome',       
		type: 'success',
		icon: 'true',
		animation: 'fade',
		delay: 5000,
		animate_speed: "slow"
	});

});

