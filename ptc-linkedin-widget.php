<?php
/*

Plugin Name: PTC Linkedin Widget

Plugin URI: https://wordpress.org/plugins/ptc-linkedin-widget/

Description: Linkedin Profile Widget - Quick, small and easy to display linkedin widget for wordpress.

Version: 1.0

Author: vivanjakes@gmail.com

Author URI: https://wordpress.org/support/profile/personaltrainercertification

*/



class ptcinwgt_linkedinwidget{

 public $options;

 

 public function __construct() {

        $this->options = get_option('ptcinwgt_linkedin_widget_options');

        $this->ptcinwgt_linkedin_widget_register_settings_and_fields();

    }
 

 public static function add_ptcinwgt_linkedin_widget_options_page(){

        add_options_page('PTC LinkedIn Widget', 'PTC LinkedIn Widget', 'administrator', __FILE__, array('ptcinwgt_linkedinwidget','ptcinwgt_linkedin_widget_options'));

    }



 public static function ptcinwgt_linkedin_widget_options(){

?>

<div class="ptcinwgt_artbox">

  <h2 class="ptcinwgt_top_style">Linkedin Profile Widget Setting</h2>

  <form method="post" action="options.php" enctype="multipart/form-data">

    <?php settings_fields('ptcinwgt_linkedin_widget_options'); ?>

    <?php do_settings_sections(__FILE__); ?>

    <p class="submit">

      <input name="submit" type="submit" class="button-success" value="Save Changes"/>

    </p>

  </form>

<script type="text/javascript">

jQuery(document).ready(function() {

/** Toggle form **/	

jQuery('.ptcinwgt_cstshowhide').click(function(){

	 if (jQuery(this).text() == "Show"){

       jQuery(this).text("Hide")

	 }else{

       jQuery(this).text("Show");

	 }

	jQuery(this).closest('.ptcinwgt_customidinfo').find('.ptcinwgt_cstidinfocontent').slideToggle();

});

});

</script>

</div>

<?php

    }

 

 public function ptcinwgt_linkedin_widget_register_settings_and_fields(){



  register_setting('ptcinwgt_linkedin_widget_options', 'ptcinwgt_linkedin_widget_options',array($this,'ptcinwgt_linkedin_widget_validate_settings'));



  add_settings_section('ptcinwgt_linkedin_widget_main_section', 'Settings', array($this,'ptcinwgt_linkedin_widget_main_section_cb'), __FILE__);



 //Start Creating Fields and Options



 //Linkedin Profile ID



 add_settings_field('ptcinwgt_linkedin_id', 'Linkedin ID', array($this,'ptcinwgt_linkedin_id_settings'), __FILE__,'ptcinwgt_linkedin_widget_main_section');



 //alignment option



 add_settings_field('ptcinwgt_alignment', 'Alignment Position', array($this,'ptcinwgt_position_settings'),__FILE__,'ptcinwgt_linkedin_widget_main_section');



 //marginTop



 add_settings_field('ptcinwgt_marginTop', 'Margin Top', array($this,'ptcinwgt_marginTop_settings'), __FILE__,'ptcinwgt_linkedin_widget_main_section');



 //width



 add_settings_field('ptcinwgt_width', 'Width', array($this,'ptcinwgt_width_settings'), __FILE__,'ptcinwgt_linkedin_widget_main_section');



 //height



 add_settings_field('ptcinwgt_height', 'Height', array($this,'ptcinwgt_height_settings'), __FILE__,'ptcinwgt_linkedin_widget_main_section');



        

 //jQuery options



 }



 public function ptcinwgt_linkedin_widget_validate_settings($plugin_options){



     return($plugin_options);



 }



 public function ptcinwgt_linkedin_widget_main_section_cb(){



   //optional



 }



 //ptcinwgt_linkedin_id_settings



 public function ptcinwgt_linkedin_id_settings() {



        if(empty($this->options['ptcinwgt_linkedin_id'])) $this->options['ptcinwgt_linkedin_id'] = "linkedin";



        echo '<input name="ptcinwgt_linkedin_widget_options[ptcinwgt_linkedin_id]" type="text" value="'.$this->options['ptcinwgt_linkedin_id'].'" />

		<div class="ptcinwgt_idinfo">If Your linkedin public profile url is www.linkedin.com/in/<u>yourname</u> then linkedin ID id : <u>yourname</u>.<br/> But If Your Linkedin Profile url is : https://in.linkedin.com/in/firstname-lastname-xxxxxxxxx Then Change Your Public Profile URL.</div>

		<div class="ptcinwgt_customidinfo"><h4>Customizing Your Public Profile URL : <span class="ptcinwgt_cstshowhide">Show</span></h4>

			<div class="ptcinwgt_cstidinfocontent" style="display:none;">

			<ol>

			<li>Move your cursor over Profile at the top of your homepage and select Edit Profile.</li>

			<li>You\'ll see a URL link under your profile photo like www.linkedin.com/in/yourname. Move your cursor over the link and click the  Settings icon next to it.</li>

			<li>Under the Your public profile URL section on the right, click the Edit icon next to your URL.</li>

			<li>Type the last part of your new custom URL in the text box.</li>

			<li>Click Save.</li>

			</ol>

			</div>

		</div> 

		';



    }

	

 //ptcinwgt_position_settings



 public function ptcinwgt_position_settings(){



        if(empty($this->options['ptcinwgt_alignment'])) $this->options['ptcinwgt_alignment'] = "left";



        $items = array('left','right');



        echo '<select name="ptcinwgt_linkedin_widget_options[ptcinwgt_alignment]">';



        foreach($items as $item){



            $selected = ($this->options['ptcinwgt_alignment'] === $item) ? 'selected = "selected"' : '';



            echo '<option value="'.$item.'" '. $selected.'>'.$item.'</option>';



        }



        echo '</select>';



    }



 //ptcinwgt_marginTop_settings



 public function ptcinwgt_marginTop_settings() {



        if(empty($this->options['ptcinwgt_marginTop'])) $this->options['ptcinwgt_marginTop'] = "100";



        echo '<input name="ptcinwgt_linkedin_widget_options[ptcinwgt_marginTop]" type="text" value="'.$this->options['ptcinwgt_marginTop'].'" />';



    }



 //ptcinwgt_width_settings



 public function ptcinwgt_width_settings() {



        if(empty($this->options['ptcinwgt_width'])) $this->options['ptcinwgt_width'] = "365";



        echo '<input name="ptcinwgt_linkedin_widget_options[ptcinwgt_width]" type="text" value="'.$this->options['ptcinwgt_width'].'" />';



    }



 //ptcinwgt_height_settings



 public function ptcinwgt_height_settings() {



        if(empty($this->options['ptcinwgt_height'])) $this->options['ptcinwgt_height'] = "160";



        echo '<input name="ptcinwgt_linkedin_widget_options[ptcinwgt_height]" type="text" value="'.$this->options['ptcinwgt_height'].'" />';



    }



 // put jQuery settings before here



}



add_action('admin_menu', 'ptcinwgt_linkedin_widget_trigger_options_function');



function ptcinwgt_linkedin_widget_trigger_options_function(){



    ptcinwgt_linkedinwidget::add_ptcinwgt_linkedin_widget_options_page();



}



add_action('admin_init','ptcinwgt_linkedin_widget_trigger_create_object');



function ptcinwgt_linkedin_widget_trigger_create_object(){



    new ptcinwgt_linkedinwidget();



}



add_action('wp_footer','ptcinwgt_linkedin_widget_add_content_in_footer');



function ptcinwgt_linkedin_widget_add_content_in_footer(){



 $ptcinwgt_options = get_option('ptcinwgt_linkedin_widget_options');

 extract($ptcinwgt_options);



 $total_height=$height-110;

 $total_width=$width+40;

 

 $print_linkedin = '';

 $print_linkedin .= '<script type="IN/MemberProfile" data-id="http://www.linkedin.com/in/'.$ptcinwgt_linkedin_id.'" data-format="inline" data-related="false"></script>';

?>

<script type="text/javascript">

jQuery(document).ready(function() {

/** Toggle form **/	

jQuery('#ptcinwgt_linkediniconlinkleft').click(function(){

	jQuery(this).parent().toggleClass('showdiv');

});

});

</script>

<script src="//platform.linkedin.com/in.js" type="text/javascript"></script>



<?php if($ptcinwgt_alignment=='left'){?>

<style type="text/css">

div.ptcinwgt_linkedin_widget1{

	left: -<?php echo trim($ptcinwgt_width+10);?>px; 

	top: <?php echo $ptcinwgt_marginTop;?>px; 

	z-index: 10000; 

	height:<?php echo trim($ptcinwgt_height+30);?>px;	

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.ptcinwgt_linkedin_widget1.showdiv{

	left:0;

	}	

div.ptcinwgt_linkedin_widget2{

	text-align: left;

	width:<?php echo trim($ptcinwgt_width);?>px;

	height:<?php echo trim($ptcinwgt_height);?>px;

	}

div.ptcinwgt_linkedin_widget1 .ptcinwgt_linkediniconlinkleft {		

	right: -32px;

    text-align: right;

}

</style>

<div id="ptcinwgt_linkedin_widget_display">

  <div id="ptcinwgt_linkedin_widget1" class="ptcinwgt_linkedin_widget1"><a id="ptcinwgt_linkediniconlinkleft" class="ptcinwgt_linkediniconlinkleft" href="javascript:;"><img class="outer" src="<?php echo plugins_url( 'assets/linkedin-icon.png', __FILE__ );?>" alt=""></a>

    <div id="ptcinwgt_linkedin_widget2" class="ptcinwgt_linkedin_widget2"><?php echo $print_linkedin; ?></div>
    <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: left; direction: ltr;padding:3px 0px 0px; position:absolute;bottom:0px;left:0px;"><a href="https://www.nationalcprassociation.com/" target="_blank" style="color: #808080;">Click here</a></div>

    </div>

</div>



<?php } else { ?>

<style type="text/css">

div.ptcinwgt_linkedin_widget1{

	right: -<?php echo trim($ptcinwgt_width+10);?>px;

	top: <?php echo $ptcinwgt_marginTop;?>px;

	z-index: 10000; 

	height:<?php echo trim($ptcinwgt_height+30);?>px;

	-webkit-transition: all .5s ease-in-out;

	-moz-transition: all .5s ease-in-out;

	-o-transition: all .5s ease-in-out;

	transition: all .5s ease-in-out;

	}

div.ptcinwgt_linkedin_widget1.showdiv{

	right:0;

	}	

div.ptcinwgt_linkedin_widget2{

	text-align: left;

	width:<?php echo trim($ptcinwgt_width);?>px;

	height:<?php echo trim($ptcinwgt_height);?>px;

	}

div.ptcinwgt_linkedin_widget1 .ptcinwgt_linkediniconlinkleft {		

	left: -32px;

    text-align: left;

}		

</style>

<div id="ptcinwgt_linkedin_widget_display">

  <div id="ptcinwgt_linkedin_widget1" class="ptcinwgt_linkedin_widget1"><a id="ptcinwgt_linkediniconlinkleft" class="ptcinwgt_linkediniconlinkleft" href="javascript:;"><img class="outer" src="<?php echo plugins_url( 'assets/linkedin-icon.png', __FILE__ );?>" alt=""></a>

    <div id="ptcinwgt_linkedin_widget2" class="ptcinwgt_linkedin_widget2"><?php echo $print_linkedin; ?></div>
    <div style="font-size: 9px; color: #808080; font-weight: normal; font-family: tahoma,verdana,arial,sans-serif; line-height: 1.28; text-align: right; direction: ltr;padding:3px 0px 0px; position:absolute;bottom:0px;right:0px;"><a href="https://www.nationalcprassociation.com/" target="_blank" style="color: #808080;">Click here</a></div>

    </div>

</div>



<?php } 



}



add_action( 'wp_enqueue_scripts', 'register_ptcinwgt_linkedin_widget_styles' );

add_action( 'admin_enqueue_scripts', 'register_ptcinwgt_linkedin_widget_styles' );

function register_ptcinwgt_linkedin_widget_styles() {

    wp_register_style( 'register_ptcinwgt_linkedin_widget_styles', plugins_url( 'assets/main.css' , __FILE__ ) );

    wp_enqueue_style( 'register_ptcinwgt_linkedin_widget_styles' );

    wp_enqueue_script('jquery');

 }



 $ptcinwgt_linkedin_widget_default_values = array(



     'ptcinwgt_linkedin_id' => 'linkedin',



     'ptcinwgt_alignment' => 'left',



     'ptcinwgt_marginTop' => '200',



     'ptcinwgt_width' => '365',



     'ptcinwgt_height' => '160',



 );

 add_option('ptcinwgt_linkedin_widget_options', $ptcinwgt_linkedin_widget_default_values);