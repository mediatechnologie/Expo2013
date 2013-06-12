(function(window, document, undefined) {

	//var projects = <?php echo json_encode(include('projects.php')); ?>;
	//var current  = '<?php echo $location; ?>';

	function previousProject() {

		var index = projects.indexOf(current);
		if(--index < 0) {
			index = projects.length - 1;
		}

		window.location = '../' + projects[index] + '/';
	}

	function nextProject() {

		var index = projects.indexOf(current);
		if(++index > projects.length - 1) {
			index = 0;
		}

		window.location = '../' + projects[index] + '/';
	}

	window.onload = function() {
		var more_btn  = document.getElementById('toggle-more');
		more_btn.href = (location.hash == '#more') ? '#' : '#more';
	}

	window.onhashchange = function() {
		var more_btn  = document.getElementById('toggle-more');
		more_btn.href = (location.hash == '#more') ? '#' : '#more';
	}

	window.onkeydown = function(evt) {
	    evt = evt || window.event;
	    switch (evt.keyCode) {
	        case 37:
	            previousProject();
	            break;
	        case 39:
	            nextProject();
	            break;
	    }
	};

})(window, document);