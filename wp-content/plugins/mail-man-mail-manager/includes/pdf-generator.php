<?php

require_once( MAIL_MAN_DIR_VENDOR . 'dompdf/dompdf_config.inc.php' );
$dompdf = new DOMPDF();

    $logo_url = dirname( __FILE__ ).'/assets/images/logo.png';
    $doc_heading = strtoupper('E-Learning Registration Form');
$html = '<style>@page{margin:0px;}body{margin:0px;}body,*{font-family:"Open Sans",Helvetica,Arial,sans-serif;} p{margin-bottom:0} th{background-color: #343434;color: white;} table{max-width:100%}th{text-align:left}.table{width:100%;margin-bottom:20px}.table > thead > tr > th,.table > tbody > tr > th,.table > tfoot > tr > th,.table > thead > tr > td,.table > tbody > tr > td,.table > tfoot > tr > td{padding:8px;line-height:1.428571429;vertical-align:top;border-top:1px solid #ddd}.table > thead > tr > th{vertical-align:bottom;border-bottom:2px solid #ddd}.table > caption + thead > tr:first-child > th,.table > colgroup + thead > tr:first-child > th,.table > thead:first-child > tr:first-child > th,.table > caption + thead > tr:first-child > td,.table > colgroup + thead > tr:first-child > td,.table > thead:first-child > tr:first-child > td{border-top:0}.table > tbody + tbody{border-top:2px solid #ddd}.table .table{background-color:#fff}.table-condensed > thead > tr > th,.table-condensed > tbody > tr > th,.table-condensed > tfoot > tr > th,.table-condensed > thead > tr > td,.table-condensed > tbody > tr > td,.table-condensed > tfoot > tr > td{padding:5px}.table-bordered{border:1px solid #ddd}.table-bordered > thead > tr > th,.table-bordered > tbody > tr > th,.table-bordered > tfoot > tr > th,.table-bordered > thead > tr > td,.table-bordered > tbody > tr > td,.table-bordered > tfoot > tr > td{border:1px solid #ddd}.table-bordered > thead > tr > th,.table-bordered > thead > tr > td{border-bottom-width:2px}.table-striped > tbody > tr:nth-child(odd) > td,.table-striped > tbody > tr:nth-child(odd) > th{background-color:#eaeaea}.table-hover > tbody > tr:hover > td,.table-hover > tbody > tr:hover > th{background-color:#f5f5f5}</style>';

$html.= '<div style="background:#1f1f1f; padding-top: 30px;">';
$html.= '<a href="'.get_site_url().'" ><img src="'.$logo_url.'" style="width:100%; display:block;height:auto;"/></a>';
$html.= '<div style="width: 100%; height:2px; margin-bottom: 20px;"></div>';

$html.= '<small style="display:block;text-align:center">'.get_bloginfo('description').'</small>';
$html.= '<div style="width: 100%; height:2px; margin-bottom: 20px;"></div>';

$html.= '<h3 style="text-align:center;color:#fdbe3d">'.$doc_heading.'</h3>';
$html.= '</div>';

$html.= '<div style="width: 100%; height:2px; margin-bottom: 20px;"></div>';

$html.= '<div style="padding: 20px; margin: 30px 0px;">';
$html.= '<p><strong style="display:inline-block;width: 120px;">Registrant:</strong> '. $Name .'</p>';
$html.= '<p><strong style="display:inline-block;width: 120px;">Email:</strong> '.$Email.'</p>';

if(isset($Phone) && !empty($Phone)) $html.= '<p><strong style="display:inline-block;width: 120px;">Phone:</strong> '.$Phone . '</p>';

$html.= '<table class="table table-bordered">';
    $html.= '<thead>';
        $html.= '<tr>';
            $html.= '<th>E-Learning Course</th>';
            $html.= '<th>Module</th>';
        $html.="</tr>";
    $html.= '</thead>';
    $html.= '<tbody>';

        if( is_array($Course) )
        {
            foreach ($Course as $key => $course_single) {
                $title = explode('|', $course_single);
                $html.= '<tr>';
                    $html.= '<td>' . $title[0] . '</td>';
                    $html.= '<td>' . $title[1] . '</td>';
                $html.="</tr>";
            }
        };

    $html.= '</tbody>';
$html.= '</table>';

$html.= '<p><strong>Notes:</strong></p>';
$html.= '<div style="word-wrap: break-word;">'.nl2br($Message).'</div>';
$html.= '</div>';

$dompdf->load_html( $html );
$dompdf->render();

$PDFoutput = $dompdf->output();

$PDFName = date('Y-m-d').'-NO'.date('His').'_E-Learning-Registration-Form.pdf';

 ?>