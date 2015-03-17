window.onload = function() {
	$(document).foundation({tab: {toggleable: false}});
	console.log("TEST");
};

var openModel = function() {
	$("#reveal-modal").foundation('reveal', 'open');

}; 