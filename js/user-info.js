$(() => {

	/* Output of user agent information */

	(function getUserInfo() {
		window.name = 'gratz';

		let info = '<li>' +
		// window: name & status bar
		'window name: ' + window.name + '; status bar: ' + window.status + '</li>' +
		// navigator: processor type & user language
		'<li>processor: ' + navigator.product + '; language: ' + navigator.language + '</li>' +
		// location: URL & port
		'<li>URL: ' + location.href + '; port: ' + (location.port || 'default (80)') + '</li>' +
		// history: size 
		'<li>history size: ' + history.length + '</li>' +
		// screen: height & width
		'<li>screen height: ' + screen.availHeight + '; screen width: ' + screen.width + '</li>';

		$('#user-info').html(info);
	})();

});