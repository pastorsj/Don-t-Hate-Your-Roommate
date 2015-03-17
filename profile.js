"use strict";

window.onload = function() {

	var profile = $('#profileInfo');

	var matches = $('#profileMatches');
	var survey = $('#profileSurvey');
	var survey2 = $('#profileSurvey2');
	var photo = $('#profilePhoto');

	profile.click(function() {
		$('#infoTab').show();
		$('#matchTab').hide();
		$('#surveyTab').hide();
		$('#photoTab').hide();
		$('#viewPhoto').show();
		$('#pictureHeading').show();
	});

	matches.click(function() {
		$('#infoTab').hide();
		$('#matchTab').show();
		$('#surveyTab').hide();
		$('#photoTab').hide();
		profile.removeClass('active');
	});

	survey.click(function() {
		$('#infoTab').hide();
		$('#matchTab').hide();
		$('#surveyTab').show();
		$('#photoTab').hide();
		$('#photoTab').hide();
		profile.removeClass('active');
	});
	
	photo.click(function() {
		$('#infoTab').hide();
		$('#matchTab').hide();
		$('#surveyTab').hide();
		$('#photoTab').show();
		profile.removeClass('active');
	});
	
	survey2.click(function() {
		$('#infoTab').hide();
		$('#matchTab').hide();
		$('#surveyTab').show();
		$('#photoTab').hide();
		profile.removeClass('active');
	});

};
