(function(window, document, undefined) {

    function fadeOut(elementToFade, callback) {

        var element = document.getElementById(elementToFade);
        element.style.opacity -= 0.075;

        if(element.style.opacity < 0.0) {
            element.style.opacity = 0.0;
            callback();
        } else {
            setTimeout(function() {
                fadeOut(elementToFade, callback);
            }, 16);
        }
    }

    // onload also waits for images :), documentready is already done
    window.onload = function() {
        document.getElementById('overlay').style.opacity = '1';
        fadeOut('overlay', function() {
            document.getElementById('overlay').style.display = 'none';
        });
    }

})(window, document);