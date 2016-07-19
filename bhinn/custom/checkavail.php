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