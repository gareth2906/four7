(function ($) {
	$.fn.hoverFlow = function (c, d, e, f, g) {
		if ($.inArray(c, ['mouseover', 'mouseenter', 'mouseout', 'mouseleave']) == -1) {
			return this
		}
		var h = typeof e === 'object' ? e : {complete: g || !g && f || $.isFunction(e) && e, duration: e, easing: g && f || f && !$.isFunction(f) && f};
		h.queue = false;
		var i = h.complete;
		h.complete = function () {
			$(this).dequeue();
			if ($.isFunction(i)) {
				i.call(this)
			}
		};
		return this.each(function () {
			var b = $(this);
			if (c == 'mouseover' || c == 'mouseenter') {
				b.data('jQuery.hoverFlow', true)
			} else {
				b.removeData('jQuery.hoverFlow')
			}
			b.queue(function () {
				var a = (c == 'mouseover' || c == 'mouseenter') ? b.data('jQuery.hoverFlow') !== undefined : b.data('jQuery.hoverFlow') === undefined;
				if (a) {
					b.animate(d, h)
				} else {
					b.queue([])
				}
			})
		})
	}
})(jQuery);