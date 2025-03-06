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
});
