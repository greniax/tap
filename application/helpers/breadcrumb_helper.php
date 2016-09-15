<?php
if (!function_exists('generaBreadcrumb')) {
	function generaBreadcrumb() {
		$CI =&get_instance();
	#	$CI->load->helper('url_helper');
		$i = 1;
		$url = $CI->uri->segment($i);
		$link = '
			<div class="pageheader">
			'/*<h2><i class="fa fa-edit"></i>'. $CI->uri->segment($i). '</h2>*/.'
			<div class="breadcrumb-wrapper">
			<ol class="breadcrumb">
			<a href="'.site_url().'/">Inicio </a> / ';

		while ($url != '') {
			$prep_link ='';
			for ($j = 1;$j <= $i;$j++) {
				$prep_link .=$CI->uri->segment($j). '/';
			}

			if($CI->uri->segment($i + 1) == '') {
				$link .= '<li class="active"><a href="'.site_url($prep_link).'">';
				$link .= $CI->uri->segment($j).'</a></li>';
			}
			else {
				$link .= '<li><a href="'. site_url($prep_link).'">';
				$link .= $CI->uri->segment($i).'</a><span class="divider"></span></li> ';
			}
			$i++;
			$url = $CI->uri->segment($i);
		}
		$link .= '</ol></div></div>';
		return $link;
	}
}
?>
