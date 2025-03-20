document.addEventListener('DOMContentLoaded', function() {
	var eyes = document.querySelectorAll('.show-password .wrapper');
	for (var i = 0; i < eyes.length; i++) {
		eyes[i].closest('.show-password').querySelector('input').addEventListener('focus', function(e) {
			e.currentTarget.closest('.show-password').querySelector('.wrapper').classList.toggle('focused');
		});
		eyes[i].closest('.show-password').querySelector('input').addEventListener('blur', function(e) {
			e.currentTarget.closest('.show-password').querySelector('.wrapper').classList.toggle('focused');
		});
		eyes[i].addEventListener('click', function(e) {
			var container = e.currentTarget.closest('.show-password');
			var input = container.querySelector('input');
			var icon = e.currentTarget.querySelector('.fa');
			if (input.getAttribute('type') == 'password') {
				input.setAttribute('type', 'text');
			} else {
				input.setAttribute('type', 'password');
			}

			icon.classList.toggle('fa-eye');
			icon.classList.toggle('fa-eye-slash');
		})
	}



	if (document.querySelectorAll('.js-user-privileges').length == 1) {
		document.querySelectorAll('.js-user-type-administrator-control')[0].addEventListener('change', function(e) {
			document.querySelectorAll('.js-user-type-standard')[0].classList.add('d-none');
		});
		document.querySelectorAll('.js-user-type-standard-control')[0].addEventListener('change', function(e) {
			document.querySelectorAll('.js-user-type-standard')[0].classList.remove('d-none');
		});

		document.querySelectorAll('.js-privileges-monitors-viewall-control')[0].addEventListener('change', function(e) {
			var checked = e.currentTarget.checked;
			var dependentControls = document.querySelectorAll('.js-privileges-monitors-viewall-dependent');
			for (var i = 0; i < dependentControls.length; i++) {
				if (dependentControls[i].tagName == 'INPUT') {
					dependentControls[i].disabled = !checked;
					if (!checked) {
						dependentControls[i].checked = false;
					}

				}
			}
		});

	}
});
