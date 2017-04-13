$(document).ready(function(){

$('header nav .toggle').click(function(){
    $('header nav .links').toggleClass('toggled');
});

$('.delete-link').click(function(e){
	var that = $(this);
	e.preventDefault();
	swal({
		title: "Sigurno?",
		text: that.attr('data-swal-text'),
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Da, provedi akciju!",
		//closeOnConfirm: false
	},
		function(){
			location.href=that.attr('href');
		}
	);
});

});
