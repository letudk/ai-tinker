/*!
*smartkid check brower view see cho download nhay s
 */
;(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], function ($) {
        	return factory(root, $);
        });
    } else if (typeof exports === 'object') {
        module.exports = factory(root, require('jquery'));
    } else {
        factory(root, jQuery);
    }
}(typeof window !== 'undefined' ? window : this, function(window, $, undefined) {
	"use strict";

	var
		document = window.document,
		property, 
		vendorPrefixes = ['webkit', 'o', 'ms', 'moz', ''],
		$support = $.support || {},
		eventName = 'onfocusin' in document && 'hasFocus' in document ?
			'focusin focusout' :
			'focus blur';

	var prefix;
	while ((prefix = vendorPrefixes.pop()) !== undefined) {
		property = (prefix ? prefix + 'H': 'h') + 'idden';
		$support.pageVisibility = document[property] !== undefined;
		if ($support.pageVisibility) {
			eventName = prefix + 'visibilitychange';
			break;
		}
	}
	function updateState() {
		if (property !== 'hidden') {
			document.hidden = $support.pageVisibility ? document[property] : undefined;
		}
	}
	updateState();

	$(/blur$/.test(eventName) ? window : document).on(eventName, function(event) {
		var type = event.type;
		var originalEvent = event.originalEvent;
		if (!originalEvent) {
			return;
		}

		var toElement = originalEvent.toElement;
		if (
			!/^focus./.test(type) || (
				toElement === undefined &&
				originalEvent.fromElement === undefined &&
				originalEvent.relatedTarget === undefined
			)
		) {
			$(document).triggerHandler(
					property && document[property] || /^(?:blur|focusout)$/.test(type) ?
						'hide' :
						'show'
			);
		}
		updateState();
	});
}));