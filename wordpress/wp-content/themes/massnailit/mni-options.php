<?php


function IS_getProductFromURL() {
    $IS_cartBase = 'https://rd130.infusionsoft.com';
    $IS_category = '/app/storeFront/showCategoryPage?categoryId=';
    $IS_product =  '/app/storeFront/showProductDetail?productId=';

    if(isset($_GET['pid'])) $return =  $IS_cartBase . $IS_product . $_GET['pid']; //online courses
    elseif(isset($_GET['cid'])) $return = $IS_cartBase . $IS_category . $_GET['cid']; //online courses
    else $return = $IS_cartBase . $IS_category . '3';

    $mni_data = [];
    if(isset($_GET['fname'])) $mni_data['fname'] = $_GET['fname'];
    if(isset($_GET['lname'])) $mni_data['lname'] = $_GET['lname'];
    if(isset($_GET['email'])) $mni_data['email'] = $_GET['email'];
    $mni_data['host'] = $_SERVER['SERVER_NAME'];
    $return .= '&mni=' . base64_encode(json_encode($mni_data));

    return $return;
}
add_action('admin_menu', 'mni_settings');
add_action('admin_head', 'mni_styles');

function mni_settings() { 
	add_menu_page('MNI Settings', 'MNI Settings', 'edit_themes', __FILE__, 'mni_settings_submit');
}



function get_max_testimonials() {
	$max_testimonials = 5;
	return $max_testimonials;
}

function display_testimonials() {
	$output_testimonials = "";
	for($i = 1; $i <= get_max_testimonials(); $i++)
	{
        $img_src = esc_html(get_option("testimonial_author_photo_".$i));
        if(empty($img_src)) $img_src = get_bloginfo('stylesheet_directory') . '/css/img/generic-user.png';

		$output_testimonials .= "<div class=\"testimonial\">";
		$output_testimonials .= "<img src='". $img_src . "' alt='".esc_html(get_option("testimonial_author_".$i))."' class='testimonial_photo' /><p>";
		$output_testimonials .= esc_html(get_option("testimonial_desc_".$i));
		$output_testimonials .= "<em>" . esc_html(get_option("testimonial_author_".$i)) . "</em>";
		$output_testimonials .= "</p></div>";

	}	
	echo $output_testimonials;
}

function get_max_promos()
{
	$max_promos = 3;
	return $max_promos;
}

function display_home_promos()
{
	$output_home_promos = "";
	for($i = 1; $i <= get_max_promos(); $i++)
	{
			$output_home_promos .= "<div class=\"large-4 column\">";
			$output_home_promos .= "<h5>". esc_html(get_option("home_promo_title_".$i)) ."</h5>";
			$output_home_promos .= "<p>". esc_html(get_option("home_promo_description_".$i))."</p>";
			$output_home_promos .= "<a href='". esc_url(get_option("home_promo_url_".$i))."' class=\"button red\">Read More</a>";
			$output_home_promos .= "</div>";
	}	
	echo $output_home_promos;
}


function display_tagline() {
    $output_tagline = esc_html(get_option('tagline'));
    echo $output_tagline;
}
function display_subhead_text() {
    $output_subhead = esc_html(get_option('subhead_text'));
    echo $output_subhead;
}
function mni_settings_submit(){ 
    if(isset($_POST['submit-updates']) && $_POST['submit-updates'] == "yes"){

		update_option("tagline", sanitize_text_field(($_POST["tagline"])));
		update_option("subhead_text", sanitize_text_field(($_POST["subhead_text"])));
		update_option("mni_email", sanitize_email(($_POST["mni_email"])));

		for($i = 1; $i <= get_max_promos(); $i++)
		{
			update_promos($i);
		}

		for($i = 1; $i <= get_max_testimonials(); $i++)
		{
			update_testimonials($i);
		}

        echo "<div id=\"message\" class=\"updated fade\"><p><strong>Your settings have been saved!</strong></p></div>";
    }

?>
<div class="wrap">
	<form method="post" target="_self" class="adminoptions">
		<h1>Theme Settings</h1>
		<input type="submit" name="Submit" value="Save Settings" class="button-primary" />
		
		<h2>General</h2>
	    <label class="regular-text">Email Address to Receive Emails</label><input name="mni_email" value="<?php echo esc_html(get_option("mni_email")); ?>" class="textbox_medium" size="40" type="text">
	    <label>Tagline:</label><small>Displayed on the middle header of the website.</small><textarea cols="41" rows="2" class="valid" name="tagline"><?php echo esc_html(get_option('tagline')); ?></textarea>
        <label>Subhead Text:</label><small>Text that displays below the MNI logo.</small><textarea cols="41" rows="2" class="valid" name="subhead_text"><?php echo esc_html(get_option('subhead_text')); ?></textarea>
		<h2>Home Promos</h2>
		<?php
			for($i = 1; $i <= get_max_promos(); $i++)
			{
				add_promos($i);
			}
		?>
		<h2>Testimonials</h2>
		<?php
			for($i = 1; $i <= get_max_testimonials(); $i++)
			{
				add_testimonials($i);
			}
		?>
		<br/><br/>
		<input type="submit" name="Submit" value="Save Settings" class="button-primary"/>
		<input name="submit-updates" type="hidden" value="yes" />
		<br /><br />
	</form>
</div>
<?php 
}



// Add Dashboard Head CSS to custom settings page
function mni_styles() { 
	echo "<style type=\"text/css\"> 
	.adminoptions label { display: block; font-weight:bold;margin-bottom:5px;margin-top:10px;color:#666;} 
	.adminoptions .field { padding:5px 0; } 
	.adminoptions small { display:block;font-size:1em } 
	.adminoptions .textbox-small { width:100px; }
	.adminoptions .textbox-med-small { width:175px; } 
	.adminoptions .textbox-medium { width:250px; } 
	.adminoptions .textbox-large { width:350px; } 
	.adminoptions .textarea-small { width:350px; height:50px; } 
	.adminoptions .textarea-medium { width:450px; height:50px; } 
	.adminoptions .textarea-large { width:500px; height:100px; } 
	.adminoptions .inset { padding-left:20px; margin:15px 0;  border-left:2px dotted #ccc; } 
	</style>";
}


function add_promos($id)
{
	echo "<h3><strong>Promo Item ".$id."</strong></h3>";
	echo "<label>Title</label><input class='textbox-medium' type='text' name='home_promo_title_".$id."' value='". sanitize_text_field(get_option("home_promo_title_".$id)) ."' /><br />";
	echo "<label>Description</label><small></small><textarea cols='2' rows='2' class='textarea-medium' name='home_promo_description_".$id."'>". sanitize_text_field(get_option("home_promo_description_".$id)) ."</textarea><br />";
	echo "<label>URL (Link for read more)</label><input class='textbox-large' type='text' name='home_promo_url_".$id."' value='". esc_url(get_option("home_promo_url_".$id)) ."' /><br />";
	
}


function update_promos($id)
{
	update_option("home_promo_title_".$id, sanitize_text_field($_POST["home_promo_title_".$id]));
	update_option("home_promo_description_".$id, sanitize_text_field($_POST["home_promo_description_".$id]));
	update_option("home_promo_url_".$id, esc_url($_POST["home_promo_url_".$id]));
}

function add_testimonials($id)
{
	echo "<h3><strong>Testimonial ".$id."</strong></h3>";
	echo "<label>Testimonial Description</label><small><textarea cols='2' rows='2' class='textbox-medium' type='text' name='testimonial_desc_".$id."'/>".sanitize_text_field(get_option("testimonial_desc_".$id)) ."</textarea><br />";
	echo "<label>Author</label><input cols='2' rows='2' class='textbox-medium' name='testimonial_author_".$id."' value='". sanitize_text_field(get_option("testimonial_author_".$id)) ."''><br />";	
	echo "<label>Author Photo URL</label><small>Copy and Paste image URL.</small><input cols='2' rows='2' class='textbox-medium' name='testimonial_author_photo_".$id."' value='". esc_url(get_option("testimonial_author_photo_".$id)) ."''><br />";

	
}

function update_testimonials($id)
{
		update_option("testimonial_desc_".$id, sanitize_text_field($_POST["testimonial_desc_".$id]));
		update_option("testimonial_author_".$id, sanitize_text_field($_POST["testimonial_author_".$id]));
		update_option("testimonial_author_photo_".$id, esc_url($_POST["testimonial_author_photo_".$id]));

}

function mail_form()
{
	if(!empty($_POST['send_mail']) && empty($_POST['e-mail']))
	{
		$to = get_option('mni_email');
		$subject = "Contact Form Submission";
		
		$message = "Message from your website:\n\n";
		$message .= "From: " . sanitize_text_field($_POST["mniName"]) . "\n";
		$message .= "Email: " . sanitize_email($_POST["mniEmail"]) . "\n";
		$message .= "Phone: " . sanitize_text_field($_POST["mniPhone"]) . "\n";
		$message .= "Message: " . sanitize_text_field(($_POST["mniMessage"])) . "\n\n";
		$message .= "IP Address: " . $_SERVER["REMOTE_ADDR"] . "\n\n";
		$message .= "Sent from: " . $_SERVER['HTTP_HOST'] . "\n\n";
		
		$from = $_POST["mniEmail"];
		$headers = "From: ".sanitize_email($_POST["mniEmail"]);
		
		if(mail($to,$subject,$message,$headers))
		{
			$sent = true;
		}else{
			$sent = false;
		}
	}

	
?>
	
	<?php if($sent == true) { ?>
		<h3>Thank You!</h3>
		<p><strong>Your message has been sent.</strong></p>
	<?php }else{ ?>
		<h3>Contact Form</h3>
	<?php } ?>
	<p id="message" class="hidden"></p>
    <form method="post" target="_self" action="" onsubmit="javascript:return validate(this);" class="standardForm">
        <div class="field"><label>Your Name</label><input type="text" name="mniName" class="textbox" /></div>
        <div class="field"><label>Your Email</label><input type="text" name="mniEmail" class="textbox" /></div>
        <div class="field"><label>Your Phone</label><input type="text" name="mniPhone" class="textbox" /></div>
        <div class="field"><label>Message</label><textarea cols="5" rows="5" class="textarea" name="mniMessage" tabindex="4">Enter your message...</textarea></div>
        <div class="field"><input type="submit" value="SEND MESSAGE" class="submit button" name="send_mail" /></div>
        <input type="hidden" name="e-mail" />
    </form>
<?php
}
?>