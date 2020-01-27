/* global $ */

$(() => {
	$('select[data-select="true"]').select2();
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