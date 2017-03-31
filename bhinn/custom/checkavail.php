<?php
/* check avail / bookingbutton  */


if (!function_exists('booking_button_link')) {
	function booking_button_link( $atts ) {
		// assumes that you have fields on the page with ids: date-arrive, date-depart, number-rooms, number-adults & number-kids

		$atts = shortcode_atts( array(
			'button_text' => 'Check Availability',
			'channelcode' => 'barharbordirect',
			'locallang' => 'en',
			'baz' => 'default baz'
		), $atts, 'bookingbutton' );
		// javascript for the onClick event
		$js_out .= '<script>function booking_button_funct(){';
		$js_out .= '  var win_target = "https://app.thebookingbutton.com/properties/'.$atts['channelcode'].'?local='.$atts['locallang'].'"; ';
		$js_out .= '  var startdate = document.getElementById("date-arrive").value; ';
		$js_out .= '  var enddate = document.getElementById("date-depart").value; ';
		$js_out .= '  var num_adults = document.getElementById("number-adults").value; ';
		$js_out .= '  var num_kids = document.getElementById("number-kids").value; ';
		$js_out .= '  if (startdate) {  win_target += "&check_in_date=" + startdate; }';
		$js_out .= '  if (enddate) {  win_target += "&check_out_date=" + enddate; }';
		$js_out .= '  if (num_adults) {  win_target += "&number_adults=" + num_adults; }';
		$js_out .= '  if (num_kids) {  win_target += "&number_children=" + num_kids; }';
		$js_out .= '  window.open(win_target, "_blank");' ;
		$js_out .= '  return false; }';
		$js_out .= '</script>';
		// html for the button.
		$html_out = '';
		$html_out .= '<a class="fusion-button button-1 button-large button-default" href="#" onClick="booking_button_funct()">';
		$html_out .= '<span class="fusion-button-text">'.$atts['button_text'].'</span>';
		$html_out .= '</a>';
		return $js_out.$html_out;
	}
}
add_shortcode( 'bookingbutton', 'booking_button_link' );

if (!function_exists('travellink_button_link')) {
	function travellink_button_link( $atts ) {
		// assumes that you have fields on the page with ids: date-arrive, number-nights, number-rooms, number-adults & number-kids
		$atts = shortcode_atts( array(
			'button_text' => 'Check Availability',
			'hotelid' => '101365',
		), $atts, 'travelclick' );
		$window_target = "https://reservations.travelclick.com/".$atts['hotelid']; // not sure why we need it here too, but we do.
		// javascript for the onClick event
		$js_out .= '<script>function travellink_button_funct(){';
		$js_out .= '  var win_target = "'.$window_target.'?hotelid='.$atts['hotelid'].'"; ';
		$js_out .= '  var str_indate = document.getElementById("date-arrive").value; ';
		$js_out .= '  var num_nights = document.getElementById("number-nights").value; ';
		$js_out .= '  var num_adults = document.getElementById("number-adults").value; ';
		$js_out .= '  var num_kids = document.getElementById("number-kids").value; ';
		$js_out .= '  if (str_indate) {  ';
		$js_out .= '     var d_startdate = new Date(str_indate);';
		$js_out .= '	 var today = new Date();';
		$js_out .= '     if (d_startdate < today) { d_startdate = today; }'; // cant be in past.
		$js_out .= '     var mm = d_startdate.getMonth() + 1;';
		$js_out .= '	 mm = (mm <10)? "0" + mm : mm;';
		$js_out .= '	 var dd = d_startdate.getUTCDate();';  // watch out for Daylight savings time s.t. need UTCDate
		$js_out .= ' 	 dd = dd < 10 ? "0" + dd : dd;';
		$js_out .= '     var yyyy = d_startdate.getFullYear();';
		$js_out .= '     win_target += "&datein=" + mm + "/" + dd + "/" + yyyy; ';
		$js_out .= '  	 if (num_nights > 0) {  win_target += "&nights=" + num_nights; } else { win_target += "&nights=1";}';  // cant send 0 nights.
		$js_out .= '  }';
		$js_out .= '  if (num_adults) {  win_target += "&adults=" + num_adults; ';
		$js_out .= '     if (num_kids) {  win_target += "&children=" + num_kids; }';
		$js_out .= '  }';
		$js_out .= '  window.open(win_target, "_blank");' ;
		//$js_out .= 'alert(win_target);';
		$js_out .= '  return false; }';
		$js_out .= '</script>';
		// html for the button.
		$html_out = '';
		$html_out .= '<a class="fusion-button button-1 button-large button-default" href="#" onClick="travellink_button_funct()">';
		$html_out .= '<span class="fusion-button-text">'.$atts['button_text'].'</span>';
		$html_out .= '</a>';
		return $js_out.$html_out;
	}
}
add_shortcode( 'travellinkbutton', 'travellink_button_link' );
