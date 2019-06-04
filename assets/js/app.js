/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)

import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import '../less/app.less';
//import '../css/app.css';

document.addEventListener("DOMContentLoaded", function(event) { 
	var selectors = document.querySelectorAll('.main-navigation-trigger, .main-navigation-overlay');
	
	for (var i = 0; i < selectors.length; i++) {
	    (selectors[i]).addEventListener("click", function(){
	        document.body.classList.toggle('main-navigation-expanded');
	        (document.getElementsByClassName('main-navigation-overlay')[0]).classList.toggle('visible');
	        const elementClassList = ((document.getElementsByClassName('main-navigation-trigger')[0]).querySelectorAll('.fas')[0]).classList;
	        elementClassList.toggle('fa-bars');
	        elementClassList.toggle('fa-times')
	    });
	}

	var selectors = document.querySelectorAll('.form-group-login-code .form-control');
	for (var i = 0; i < selectors.length; i++) {
		(selectors[i]).addEventListener("keyup", function(){
	        if (this.value.length == this.maxLength) {
	        	const nextElement = this.parentElement.nextElementSibling;
	        	if (nextElement) {
	        		nextElement.querySelectorAll('.form-control')[0].focus();
	        	}
	        }
	    });
	}
});