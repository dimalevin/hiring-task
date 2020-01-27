/* global $ */

$(() => {
	console.debug("cookie.js loaded");

	function projectStatusLabel(status) {
		switch (status) {
			case 1:
				return 'Planned';
			case 2:
				return 'In Production';
			case 3:
				return 'Completed';
			default:
				return '?';
		}
	}
});

