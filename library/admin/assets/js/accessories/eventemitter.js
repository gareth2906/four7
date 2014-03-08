(function (e) {
	"use strict";
	function t() {
	}

	function n(e, t) {
		if (r)return t.indexOf(e);
		for (var n = t.length; n--;)if (t[n] === e)return n;
		return-1
	}

	var i = t.prototype, r = Array.prototype.indexOf ? !0 : !1;
	i._getEvents = function () {
		return this._events || (this._events = {})
	}, i.getListeners = function (e) {
		var t = this._getEvents();
		return t[e] || (t[e] = [])
	}, i.addListener = function (e, t) {
		var i = this.getListeners(e);
		return-1 === n(t, i) && i.push(t), this
	}, i.on = i.addListener, i.removeListener = function (e, t) {
		var i = this.getListeners(e), r = n(t, i);
		return-1 !== r && (i.splice(r, 1), 0 === i.length && this.removeEvent(e)), this
	}, i.off = i.removeListener, i.addListeners = function (e, t) {
		return this.manipulateListeners(!1, e, t)
	}, i.removeListeners = function (e, t) {
		return this.manipulateListeners(!0, e, t)
	}, i.manipulateListeners = function (e, t, n) {
		var i, r, s = e ? this.removeListener : this.addListener, o = e ? this.removeListeners : this.addListeners;
		if ("object" == typeof t)for (i in t)t.hasOwnProperty(i) && (r = t[i]) && ("function" == typeof r ? s.call(this, i, r) : o.call(this, i, r)); else for (i = n.length; i--;)s.call(this, t, n[i]);
		return this
	}, i.removeEvent = function (e) {
		return e ? delete this._getEvents()[e] : delete this._events, this
	}, i.emitEvent = function (e, t) {
		for (var n, i = this.getListeners(e), r = i.length; r--;)n = t ? i[r].apply(null, t) : i[r](), n === !0 && this.removeListener(e, i[r]);
		return this
	}, i.trigger = i.emitEvent, i.emit = function (e) {
		var t = Array.prototype.slice.call(arguments, 1);
		return this.emitEvent(e, t)
	}, "function" == typeof define && define.amd ? define(function () {
		return t
	}) : e.EventEmitter = t
})(this);