$(() => {

	/* Output of user agent information */

	(function getUserInfo() {
		window.name = 'welcome';

		let info = '' +
		// window: name
		'<li><b>window name</b>: ' + window.name + '</li>' +
		// navigator: user language
		'<li><b>language</b>: ' + navigator.language + '</li>' +
		// location: URL & port
		'<li><b>URL</b>: ' + location.href + '</li>' +
		'<li><b>port</b>: ' + (location.port || 'default (80)') + '</li>' +
		// history: size 
		'<li><b>history size</b>: ' + history.length + '</li>' +
		// screen: height & width
		'<li><b>screen size</b>: ' + screen.width + ' x ' + + screen.height + '</li>';

		$('#user-info').html(info);
	})();

});