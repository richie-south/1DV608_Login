<?php

namespace view;

class DateTimeView {


	public function show() {

		date_default_timezone_set('Europe/Stockholm');
		$timeString = Date('l, \t\h\e jS \o\f F Y, \T\h\e \t\i\m\e \i\s h:i:s');

		return '<p>' . $timeString . '</p>';
	}
}
