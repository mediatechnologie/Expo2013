(function(window, document, undefined) {

	window.onload = function() {
		var more_btn  = document.getElementById('toggle-more');
		more_btn.href = (location.hash == '#more') ? '#' : '#more';
	}

	window.onhashchange = function() {
		var more_btn  = document.getElementById('toggle-more');
		more_btn.href = (location.hash == '#more') ? '#' : '#more';
	}

})(window, document);