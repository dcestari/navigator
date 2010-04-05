$(function () {
	var url = $("#data #uri").html() + "?scale=";
	var x = parseInt($("#data #x-offset").html());
	var y = parseInt($("#data #y-offset").html());
	var reload = function () {
		scale = $("#zoom").slider('value') / 100.0;
		location.href = url + scale + "&x=" + x + "&y=" + y;
	};
	$("#zoom").slider({
		orientation: 'vertical',
		value: 100.0 * parseFloat($("#data #scale").html()),
		change: function (event, ui) {
			reload();
		}
	});
	$("#move-left").click(function () {
		if (x > 0) {
			x -= 1;
			reload();
		}
	});
	$("#move-right").click(function () {
		x += 1;
		reload();
	});
	$("#move-up").click(function () {
		if (y > 0) {
			y -= 1;
			reload();
		}
	});
	$("#move-down").click(function () {
		y += 1;
		reload();
	});
	$("#reload").click(function () {
		reload();
	});
});

