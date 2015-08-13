<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>-->
<?php

// Path to jquery Lightbox Script

//$pathJquery = plugins_url().'/contest-gal1ery/js/jquery.js';
//$pathPlugin1 = plugins_url().'/contest-gal1ery/js/lightbox-2.6.min.js';
//$pathPlugin2 = plugins_url().'/contest-gal1ery/css/lightbox.css';
//$pathPlugin3 = plugins_url().'/contest-gal1ery/css/star_off_48.png';
//$pathPlugin4 = plugins_url().'/contest-gal1ery/css/star_48.png';
//$pathCss = plugins_url().'/contest-gal1ery/css/style.css';
//$pathJqueryUI = plugins_url().'/contest-gal1ery/js/jquery-ui.js';
//$pathJqueryUIcss = plugins_url().'/contest-gal1ery/js/jquery-ui.css';
//$pathTabCSS = plugins_url().'/contest-gal1ery/admin/options/tabcontent.css';
//$pathTabJS = plugins_url().'/contest-gal1ery/admin/options/tabcontent.js';
//$cssPng = content_url().'/plugins/contest-gal1ery/css/lupe.png';// URL for zoom pic  


//add_action('wp_enqueue_scripts','my_scripts');

 
/*

echo <<<HEREDOC

<link href="$pathPlugin2" rel="stylesheet" />
<link href="$pathCss" rel="stylesheet" />
<link href="$pathPlugin6" rel="stylesheet" />


HEREDOC;
*/
//echo $pathCss;
/*

echo <<<HEREDOC

	<script src='$pathJquery'></script>
	<script src='$pathJqueryUI'></script>
	<script src='$pathJqueryUIcss'></script>
	<link href='$pathTabCSS' rel="stylesheet" type="text/css" />
	<script src='$pathTabJS'></script>

HEREDOC;*/

global $wpdb;

$galeryNR = $_GET['option_id'];
$GalleryID = $_GET['option_id'];


$tablenameOptions = $wpdb->prefix . "contest_gal1ery_options";
$tablename_options_input = $wpdb->prefix . "contest_gal1ery_options_input";


//$optionID = $_POST['option_id'];


$selectSQL1 = $wpdb->get_results( "SELECT * FROM $tablenameOptions WHERE id = '$galeryNR'" );
$selectSQL2 = $wpdb->get_results( "SELECT * FROM $tablename_options_input WHERE id = '$galeryNR'" );
$selectGalleryLookOrder = $wpdb->get_results( "SELECT ThumbLookOrder, HeightLookOrder, RowLookOrder  FROM $tablenameOptions WHERE id = '$galeryNR'" );

// Reihenfolge der Gallerien wird ermittelt

$order = array();

	foreach($selectGalleryLookOrder[0] as $key => $value){

		$order[$value]=$key;

	}

ksort($order);

// Reihenfolge der Gallerien wird ermittelt --- ENDE

	
		foreach($selectSQL1 as $value){

		$selectedCheckComments = ($value->AllowComments==1) ? 'checked' : '';
		$selectedCheckRating = ($value->AllowRating==1) ? 'checked' : '';
		$selectedCheckIp = ($value->IpBlock==1) ? 'checked' : '';
		$selectedCheckFb = ($value->FbLike==1) ? 'checked' : '';
		$FullSize = ($value->FullSize==1) ? 'checked' : '';
		$ScaleOnly = ($value->ScaleOnly==1) ? 'checked' : '';
		$ScaleAndCut = ($value->ScaleAndCut==1) ? 'checked' : '';
		$selectedCheckPicUpload = ($value->PicUpload==1) ? 'checked' : '';
		$selectedCheckSendEmail = ($value->SendEmail==1) ? 'checked' : '';
		$selectedSendName = ($value->SendName==1) ? 'checked' : '';
		$selectedCheckSendComment = ($value->SendComment==1) ? 'checked' : '';
		$AllowGalleryScript = ($value->AllowGalleryScript==1) ? 'checked' : '';
		$HeightLook = ($value->HeightLook==1) ? 'checked' : '';
		$RowLook = ($value->RowLook==1) ? 'checked' : '';
		$ThumbsInRow = ($value->ThumbsInRow==1) ? 'checked' : '';
		$LastRow = ($value->LastRow==1) ? 'checked' : '';
		$AllowSort = ($value->AllowSort==1) ? 'checked' : '';		
		$PicsInRow = $value->PicsInRow;
		$PicsPerSite = $value->PicsPerSite;
	
		
		$ThumbLook = ($value->ThumbLook==1) ? 'checked' : '';
		
		$WidthThumb = $value->WidthThumb;
		$HeightThumb = $value->HeightThumb;
		$DistancePics = $value->DistancePics; 
		$DistancePicsV = $value->DistancePicsV; 
		
		$WidthGallery = $value->WidthGallery;
		$HeightGallery = $value->HeightGallery;
		$HeightLookHeight = $value->HeightLookHeight;
		$Inform = $value->Inform;
		$MaxResJPG = $value ->MaxResJPG;
		$MaxResPNG = $value ->MaxResPNG;
		$MaxResGIF = $value ->MaxResGIF;
		$MaxResJPGon = ($value->MaxResJPGon==1) ? 'checked' : '';
		$MaxResPNGon = ($value->MaxResPNGon==1) ? 'checked' : '';
		$MaxResGIFon = ($value->MaxResGIFon==1) ? 'checked' : '';
		$MaxResJPGonDisabled = ($value->MaxResJPGon==1) ? '' : 'disabled style="background: #e0e0e0;width:190px;"';
		$MaxResPNGonDisabled = ($value->MaxResPNGon==1) ? '' : 'disabled style="background: #e0e0e0;width:190px;"';
		$MaxResGIFonDisabled = ($value->MaxResGIFon==1) ? '' : 'disabled style="background: #e0e0e0;width:190px;"';
		
		}
		
		//print_r($selectSQL2); 
		
		foreach($selectSQL2 as $value2){
			
		$Forward = ($value2->Forward==1) ? 'checked' : '';
		$forward_url_disabled = ($value2->Forward==1) ? '' : 'disabled style="background: #e0e0e0;width:500px;"';
		$Forward_URL = $value2->Forward_URL;
		$Forward_URL = html_entity_decode(stripslashes($Forward_URL));
		$Confirmation_Text = $value2->Confirmation_Text;
		$Confirmation_Text = html_entity_decode(stripslashes($Confirmation_Text));
		$Confirmation_Text_Disabled = ($value2->Forward==0) ? '' : 'disabled style="background: #e0e0e0;width:500px;"';
		
		}
		

	// Disable enable RowLook and ThumbLook Fields
	
	$RowLookFields = ($value->RowLook==0) ? 'disabled' : '' ;	
	$RowLookFieldsStyle = ($value->RowLook==0) ? 'style="background-color:#e0e0e0;"' : '' ;	
	$HeightLookFields = ($value->HeightLook==0) ? 'disabled' : '' ;	
	$HeightLookFieldsStyle = ($value->HeightLook==0) ? 'style="background-color:#e0e0e0;"' : 'style="z-index:1;"' ;	
	$ThumbLookFields = ($value->ThumbLook==0) ? 'disabled' : '' ;	
	//$ThumbLookFieldsChecked = ($value->RowLook==0) ? 'checked' : '' ;	
	$ThumbLookFieldsStyle = ($value->ThumbLook==0) ? 'style="background-color:#e0e0e0;"' : 'style="z-index:100;"' ;	
	
	// Disable enable RowLook Fields  --------- END
	
	// Inform set or not
	
	$checkInform = ($Inform==1) ? 'checked' : '' ;

	$id = $galeryNR;
	
	// Reset all IPs
	
	

	
require_once(dirname(__FILE__) . "/../nav-menu.php");

	
	echo "<br/>";

	echo "<form action='?page=contest-gal1ery/index.php&edit_options=true&option_id=$galeryNR' method='post'>";
	
	//echo '<input type="hidden" name="editOptions" value="true" >';
	echo '<input type="hidden" name="option_id" value="'.$galeryNR.'" >';
	

	$i=0;

		$MaxRes = unserialize($MaxRes);
		

	
		

		
echo <<<HEREDOC

		
    <div style="width: 937px;">
        <ul class="tabs" data-persist="true">
            <li><a href="#view1"><b>Multiple pics options</b></a></li>
            <li><a href="#view2">Single pic options</a></li>
            <li><a href="#view3">Gallery options</a></li>
            <li><a href="#view4">Upload Options</a></li>
        </ul>
        <div class="tabcontents">
            <div id="view1">
HEREDOC;
echo "<div id='cg_options_sortable' style='width:442px;text-align:center;'>";

	foreach($order as $key => $value){
	
	$i++;
	
	if($value=="ThumbLookOrder"){ 
	
	
	
			echo "<div>";
			echo '<input type="hidden" name="order[]" value="t" >';
			echo "<table style='background-color:white;text-align:left;margin-left:170px;' width='545px;'>";	
			echo "<tr><td style='padding-left:20px;width:340px;'>";
			//echo '<input type="text" hidden name="id" value="' . $id . '" method="post" >';
			echo '<p><b>Multiple pics thumbs view</b></p>';
			echo "</td>";	
			echo "<td style='padding-left:20px;text-align:right;padding-right:20px;' class='sortableDiv'>";
			echo '<p class="order"><u>'.$i.'. Order</u></p>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:340px;'>";
			echo '<p>Activate thumb view:</p>';
			echo "</td>"; 
			echo "<td style='padding-left:20px;'>";
			echo '<input type="checkbox" name="ThumbLook" id="ThumbLook" ' . $ThumbLook  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:340px;'>";
			echo '<p>Width thumbs:</p>';
			echo "</td>";
			echo "<td style='padding-left:20px;padding-right:20px;'>";
			echo '<input type="text" name="WidthThumb" id="WidthThumb" maxlength="4" value="'.$WidthThumb.'" ' . $ThumbLookFields  . '  ' . $ThumbLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;'>";
			echo '<p>Height thumbs:</p>';
			echo "</td>";
			echo "<td style='padding-left:20px;'>";
			echo '<input type="text" name="HeightThumb" id="HeightThumb" maxlength="4" value="'.$HeightThumb.'" ' . $ThumbLookFields  . '  ' . $ThumbLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";		
			echo "<td style='padding-left:20px;'>";
			echo '<p>Distance between thumbs horizontal:</p>';
			echo "</td>"; 
			echo "<td style='padding-left:20px;padding-right:20px;'>";
			echo '<input type="text" name="DistancePics" id="DistancePics" maxlength="4" value="'.$DistancePics.'" maxlength="4"  ' . $ThumbLookFields  . ' ' . $ThumbLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;' >";
			echo '<p>Distance between thumbs vertical:</p>';
			echo "</td>"; 
			echo "<td style='padding-left:20px;'>";
			echo '<input type="text" name="DistancePicsV" id="DistancePicsV" maxlength="4"  value="'.$DistancePicsV.'" maxlength="4" ' . $ThumbLookFields  . ' ' . $ThumbLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			
			echo "</table>";
			echo "<br>";
			echo "<hr style='margin-left:170px;' width='545px;'>";
			echo "<br>";
			echo "</div>";
		
		}
		
		if($value=="HeightLookOrder"){ 

			echo "<div>";
			echo '<input type="hidden" name="order[]" value="h" >';
			echo "<table style='background-color:white;text-align:left;margin-left:170px;' width='545px;'>";
			echo "<tr><td style='padding-left:20px;width:305px;'>";
			echo '<p><b>Multiple pics height view:</b></p>';
			echo "</td>";
			echo "<td style='text-align:right;padding-right:20px;' class='sortableDiv'>";
			echo '<p class="order"><u>'.$i.'. Order</u></p>';
			echo "</td>";		
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:305px;'>";
			echo '<p>Activate height view:</p>';
			echo "</td>"; 
			echo "<td>";
			echo '<input type="checkbox" id="HeightLook" name="HeightLook" ' . $HeightLook  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:305px;'>";
			echo '<p>Height of pics in a row</p>';
			echo "</td>"; 
			echo "<td>";
			echo '<input type="text" maxlength="3" name="HeightLookHeight" id="HeightLookHeight" value="'.$HeightLookHeight.'" maxlength="3" ' . $HeightLookFields  . ' ' . $HeightLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "<br>";
			echo "<hr style='margin-left:170px;' width='545px;'>";
			echo "<br>";
			echo "</div>";
		
		}
		
		if($value=="RowLookOrder"){ 

			echo "<div>";
			echo '<input type="hidden" name="order[]" value="r" >';
			echo "<table style='background-color:white;text-align:left;margin-left:170px;' width='545px;'>";
			echo "<tr><td style='padding-left:20px;width:300px;'>";
			echo '<p><b>Multiple pics row view:</b></p>';
			echo "</td>";	
			echo "<td style='text-align:right;padding-right:20px;' class='sortableDiv'>";
			echo '<p class="order"><u>'.$i.'. Order</u></p>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:300px;'>";
			echo '<p>Activate row view:</p>';
			echo "</td>"; 
			echo "<td>";
			echo '<input type="checkbox" id="RowLook" name="RowLook" ' . $RowLook  . '><br/>';
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td style='padding-left:20px;width:300px;'>";
			echo '<p>Number of pics in a row</p>';
			echo "</td>"; 
			echo "<td>";
			echo '<input type="text" name="PicsInRow" maxlength="2" id="PicsInRow" value="'.$PicsInRow.'" maxlength="2" ' . $RowLookFields  . ' ' . $RowLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";
			/*echo "<tr>";
			echo "<td style='padding-left:20px;width:300px;'>";
			echo '<p>Scale pics to full size of last row:</p>';
			echo "</td>";
			echo "<td>";
			echo '<input type="checkbox" name="LastRow" id="LastRow" ' . $LastRow  . ' ' . $RowLookFields  . ' ' . $RowLookFieldsStyle  . '><br/>';
			echo "</td>";
			echo "</tr>";*/
			echo "</table>";
						echo "<br>";
			echo "<hr style='margin-left:170px;' width='545px;'>";
			echo "<br>";
			echo "</div>";
		
		}
				
		}
		
		echo "</div>";
		echo "</div>";

echo <<<HEREDOC

           
            <div id="view2">
HEREDOC;

echo "<table style='background-color:white;margin-left:170px;' width='545px;'>";
		echo "<tr><td style='padding-left:20px;width:240px;' colspan='2'>";
		echo '<p><b>Single pic view options</b></p>'; 
		echo "</td>";		
		echo "</tr>";
		echo "<tr>";
		
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Scale Only:</p>';
		echo "</td>";
		
		echo "<td>";
		echo '<input type="checkbox" name="ScaleWidthGalery" ' . $ScaleOnly . ' id="ScaleWidthGalery"><br/>';
		echo "</td>";
		
		

		echo "</tr>";
		echo "<tr>";
		
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Skale and cut:</p>';
		echo "</td>";		
		echo "<td>";
		echo '<input type="checkbox" name="ScaleSizesGalery" ' . $ScaleAndCut . ' id="ScaleSizesGalery"><br/>';
		echo "</td>";

		echo "</tr>";
		
		echo "<tr>";
		echo "<td style='padding-left:20px;width:240px;'>";
		echo '<p>Pic width:</p>'; 
		echo "</td>"; 
		echo "<td style='padding-right:20px;'>";
		echo '<input type="text" name="WidthGallery" value="'.$WidthGallery.'" id="ScaleSizesGalery1" maxlength="4"><br/>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;padding-left:20px;width:240px;padding-right:20px' >";
		echo '<p>Pic height:</p>';
		echo "</td>"; 
		echo "<td>";
		echo '<input type="text" name="HeightGallery" value="'.$HeightGallery.'" id="ScaleSizesGalery2" maxlength="4" ><br/>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		
		echo "<td style='padding-left:20px;width:240px;'>";
		echo '<p>Enable full size link:</p>';
		echo "</td>";
		
		echo "<td>";
		echo '<input type="checkbox" name="FullSize" ' . $FullSize . ' id="FullSize"><br/>';
		echo "</td>";

		echo "</tr>";
		
		echo "</table>";
echo <<<HEREDOC
            </div>
            <div id="view3">
HEREDOC;
		echo "<table style='background-color:white;margin-left:170px;' width='545px;'>";
		echo "<tr><td style='padding-left:20px;width:300px;' colspan='2'>";
		echo '<p><b>Gallery view options</b></p>';
		echo "</td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Number of pictures per screen:</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="text" name="PicsPerSite" id="PicsPerSite" value="'.$PicsPerSite.'" " maxlength="3"><br/>';
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Allow sort:</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="checkbox" name="AllowSort" ' . $AllowSort . '><br/>';
		echo "</td>";
		echo "</tr>";
		
		echo "<tr style='padding-left:20px;'>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Allow rate:</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="checkbox" name="AllowRating" ' . $selectedCheckRating . '><br/>'; 
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Allow only one rate per picture (IP-Block:)</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="checkbox" name="IpBlock"  ' . $selectedCheckIp . '> &nbsp;&nbsp;&nbsp; <a href="?page=contest-gal1ery/index.php&edit_options=true&option_id='.$galeryNR.'&reset_ips=true">Reset IPs</a> <br/>';
		echo "</td>";
		echo "</tr>";
		
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Allow comments:</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="checkbox" name="AllowComments" ' . $selectedCheckComments . '><br/>';
		echo "</td>";
		echo "</tr>";	
		
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Allow Fb-Like:</p>';
		echo "</td>"; 
		echo "<td style='padding-left:20px;'>";
		echo '<input type="checkbox" name="FbLike" ' . $selectedCheckFb  . '><br/>';
		echo "</td>";
		echo "</tr>";
		
		echo "</table>";
		
echo <<<HEREDOC
 </div>
			   <div id="view4">
HEREDOC;
		echo "<table style='background-color:white;' width='900px;'>";	
		echo "<tr><td style='padding-left:20px;width:300px;'>";
		//echo '<input type="text" hidden name="id" value="' . $id . '" method="post" >';
		echo '<p><b>Upload Options</b></p>';
		echo "</td>";		
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Restrict resolution<br> for uploaded JPG pics</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo "<input id='allowRESjpg' type='checkbox' name='MaxResJPGon' $MaxResJPGon >";
		echo '<div id="questionJPG" style="display:inline;"><p style="font-size:18px;display:inline;">&nbsp;<a><b>?</b></a></p></div>';
		echo "<div id='answerJPG' style='position:absolute;margin-left:35px;width:460px;background-color:white;border:1px solid;padding:5px;display:none;'>";
		echo "This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics.";
		echo " If your webhosting packet is not so powerfull then you should use this restriction.</div>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Resolution in million pixel:</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo '<input id="maxJPGres" type="text" name="MaxResJPG" value="'.$MaxResJPG.'" maxlength="20" id="ScaleSizesThumb2" '.$MaxResJPGonDisabled.'  style="width:190px;" ><br/>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Restrict resolution<br> for uploaded PNG pics</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo "<input id='allowRESpng' type='checkbox' name='MaxResPNGon' $MaxResPNGon >";
		echo '<div id="questionPNG" style="display:inline;"><p style="font-size:18px;display:inline;">&nbsp;<a><b>?</b></a></p></div>';
		echo "<div id='answerPNG' style='position:absolute;margin-left:35px;width:460px;background-color:white;border:1px solid;padding:5px;display:none;'>";
		echo "This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics.";
		echo " If your webhosting packet is not so powerfull then you should use this restriction.</div>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Resolution in million pixel:</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo '<input id="maxPNGres" type="text" name="MaxResPNG" value="'.$MaxResPNG.'" maxlength="20" id="ScaleSizesThumb2" '.$MaxResPNGonDisabled.' style="width:190px;"><br/>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Restrict resolution<br> for uploaded GIF pics</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo "<input id='allowRESgif' type='checkbox' name='MaxResGIFon' $MaxResGIFon >";
		echo '<div id="questionGIF" style="display:inline;"><p style="font-size:18px;display:inline;">&nbsp;<a><b>?</b></a></p></div>';
		echo "<div id='answerGIF' style='position:absolute;margin-left:35px;width:460px;background-color:white;border:1px solid;padding:5px;display:none;'>";
		echo "This allows you to restrict the resolution of the pictures which will be uploaded in frontend. It depends on your web hosting provider how big resolution ca be be for uploaded pics.";
		echo " If your webhosting packet is not so powerfull then you should use this restriction.</div>";
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Resolution in million pixel:</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo '<input id="maxGIFres" type="text" name="MaxResGIF" value="'.$MaxResGIF.'" maxlength="20" id="ScaleSizesThumb2" '.$MaxResGIFonDisabled.' style="width:190px;"><br/>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<tr><td style='padding-left:20px;width:300px;padding-right:65px;' colspan='2'>";
		echo '<br><hr><br>';
		echo "</td>";
		echo "</tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Forward after upload</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;'>";
		echo "<input id='forward' type='checkbox' name='forward' $Forward >";
		echo "</td>";
		echo "</tr>";
				echo "<tr><td style='padding-left:20px;width:300px;padding-right:65px;' colspan='2'>";
		echo '<br>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:300px;'>";
		echo '<p>Forward to URL:</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;width:570px;'>";
		echo '<textarea id="forward_url" type="text" name="forward_url" maxlength="999" '.$forward_url_disabled.'  style="width:500px;" >'.$Forward_URL.'</textarea><br/>';
		echo "</td>";
		echo "</tr>";
						echo "<tr><td style='padding-left:20px;width:300px;padding-right:65px;' colspan='2'>";
		echo '<br>';
		echo "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='padding-left:20px;width:570px;'>";
		echo '<p>Confirmaiton Text after Upload:</p>';
		echo "</td>";
		echo "<td style='padding-left:20px;570px;'>";
		echo '<textarea id="confirmation_text" type="text" name="confirmation_text" maxlength="65000" '.$Confirmation_Text_Disabled.'  style="width:500px;" >'.$Confirmation_Text.'</textarea><br/>';
		echo "</td>";
		echo "</tr>";
		echo "</table>";
 echo <<<HEREDOC
 </div>


 </div>
   


            </div>
HEREDOC;

		echo '<p style="padding-left:857px;"><input name="changeSize" type="submit" value="Save" style="text-align:center;width:80px;" /></p>';
		
		echo "</form>";

?>