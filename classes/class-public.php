<?php if ( ! defined( 'ABSPATH' ) ) exit; 

class ES_Public {

	

	public function __construct() {

		

		add_filter( 'the_content', array( $this, 'add_links_after_content' ) );

		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ), 99 );

		add_shortcode( 'wpe_sharing',array($this,'social_sharing'));

	}

	

	public function add_links_after_content( $content )

	{

		$opts = ES_get_options();

		//pree($opts);

		$show_buttons = false;

		

		if( ! empty( $opts['auto_add_post_types'] ) && in_array( get_post_type(), $opts['auto_add_post_types'] ) && is_singular( $opts['auto_add_post_types'] ) ) {

			$show_buttons = true;

		}

			

		$show_buttons = apply_filters( 'ES_display', $show_buttons );

	

		if( ! $show_buttons ) {

			return $content;

		}

		

		return $content . $this->social_sharing($opts);

	}

	

	public function load_assets() 

	{

		$opts = ES_get_options();

		//pree($opts);

		foreach ($opts['load_esset'] as $static){

			if($static == 'load_css'){

				wp_enqueue_style( 'wp-easy-sharing', ES_PLUGIN_URL . 'assets/socialshare.css', array(), ES_VERSION );

			}	

			if($static == 'load_js'){

				wp_enqueue_script( 'wp-easy-sharing', ES_PLUGIN_URL . 'assets/socialshare.js', array(), ES_VERSION, true );				

			}		

		}

	}



	private function remove_html($content)

	{

		return preg_replace(array('/<[^>]*>/','/{[^>]*}/','/&lt;[^>]*&gt;/','/<img[^>]+\>/i'), '', ($content));

	}

	

	private function remove_except_alphanum($content){

		$result = preg_replace("/[^0-9a-zA-Z ]/", "", $content);

		return $result;

	}

	

	public function social_sharing( $atts=array() ) {

		

		global $post;

		

		extract(shortcode_atts(array(

				'default_social_options' => explode(',',WPES_DEFAULT_ICONS),

				'twitter_username' => '',

				'twitter_text' =>  '',

				'facebook_text' =>  '',

				'googleplus_text' => '',

				'linkedin_text' => '',

				'pinterest_text'=> '',
				
				'youtube_text'=> '',
				
				

				'tutorsloop_text'=> '',

				'social_image'=> '', 

				'icon_order'=>WPES_DEFAULT_ORDER,

				'show_icons'=>true,

				'before_button_text'=>'',
				
				'type' => 'sharing'

		),$atts));



		$opts = ES_get_options();

		//pree($opts);exit;

		

		//$show_icons = (isset($opts['show_icons'])?$opts['show_icons']:$show_icons);

		//$icon_order = ($opts['icon_order']==''?$icon_order:$opts['icon_order']);

		//$social_options = $opts['social_options'];

		

		if(!is_array($social_options))
		$social_options = array_filter( array_map( 'trim', $default_social_options ) );

		

		remove_filter('the_title','wptexturize');

		$title = urlencode(html_entity_decode(get_the_title()));

		add_filter('the_title','wptexturize');

		



				



		$post_excerpt = trim(strip_tags($post->post_excerpt));



		$post_content = ($post_excerpt==''?strip_tags($post->post_content):$post_excerpt);

		

		$post_content = $this->remove_except_alphanum($post_content);

		

		$post_content = substr($post_content, 0, 255);

		

		$url = urlencode( get_permalink() );

	

		$loadjs='';

		

		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'medium' );

		$thumb_url = $thumb['0'];

		if($thumb_url == ''){

			if(isset($atts['pinterest_image']) && $atts['pinterest_image'] == ''){

				$thumb_url = ES_PLUGIN_URL.'assets/blank.jpg';								

			}

			else{

				$thumb_url = isset($atts['pinterest_image'])?$atts['pinterest_image']:'';	

			}

		}

		if($social_image == ''){

			$social_image = $thumb_url;

		}

		$social_image = urlencode($social_image);

		

		

		

		//pree($opts);

		

		foreach ($opts['load_esset'] as $static){

		    if($static == 'load_js'){

		       $loadjs='onclick="return ES_plugin_loadpopup_js(this);"';

		    }

		}

		

		$ssbutton_facebook=($facebook_text!=''?'wpes_default_links':'button-facebook');

		$ssbutton_twitter=($twitter_text!=''?'wpes_default_links':'button-twitter');

		$ssbutton_googleplus=($googleplus_text!=''?'wpes_default_links':'button-googleplus');

		$ssbutton_linkedin=($linkedin_text!=''?'wpes_default_links':'button-linkedin');

		$ssbutton_pinterest=($pinterest_text!=''?'wpes_default_links':'button-pinterest');
		
		$ssbutton_youtube=($pinterest_text!=''?'wpes_default_links':'button-youtube');
		
		

		$ssbutton_tutorsloop=($tutorsloop_text!=''?'wpes_default_links':'button-tutorsloop');

		$wpes_sharing='';

		//pree($show_icons);

		if($show_icons){

			$wpes_sharing='wpes-easy-sharing';

			$ssbutton_facebook='wpes-button-facebook';

			$ssbutton_twitter='wpes-button-twitter';

			$ssbutton_googleplus='wpes-button-googleplus';

			$ssbutton_linkedin='wpes-button-linkedin';	

			$ssbutton_pinterest='wpes-button-pinterest';
			
			$ssbutton_youtube='wpes-button-youtube';
			
			

			$ssbutton_tutorsloop='wpes-button-tutorsloop';

		}

		$icon_order=explode(',',$icon_order);

		ob_start();

		?>

		<div class="easy-sharing <?php echo $wpes_sharing;?>">

			<?php if(!empty($before_button_text)):?>

			<span><?php echo $before_button_text; ?></span>

	        <?php endif;?>

	        <?php 

			//pree($show_icons);

			//pree($icon_order);

			//pree($social_options);
			
			//pree($type);
			$default = ($type=='default'?true:false);
			$loadjs = ($default?'':$loadjs);

	        foreach($icon_order as $o) {

	        	switch($o) {

	        		case 'f':

	        			if(in_array('facebook', $social_options)){
							
						$link = (isset($opts['social_me']['facebook'])?$opts['social_me']['facebook']:'');	

	        			?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_facebook;?>" href="<?php echo ($default?$link:'http://www.facebook.com/sharer/sharer.php?u='.$url); ?>" target="_blank" ><?php echo $facebook_text; ?></a><?php

	        			}

	        		break;

	        		case 't':

	        			if(in_array('twitter', $social_options)){
							
						$link = (isset($opts['social_me']['twitter'])?$opts['social_me']['twitter']:'');

	        			?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_twitter;?>" href="<?php echo ($default?$link:'http://twitter.com/intent/tweet/?text='.$title.'&url='.$url.(!empty($twitter_username)?'&via='. $twitter_username:'')); ?>" target="_blank"><?php echo $twitter_text; ?></a><?php

	        			}

	        		break;

	        		case 'g':

	        			if(in_array('googleplus', $social_options)){
							
						$link = (isset($opts['social_me']['googleplus'])?$opts['social_me']['googleplus']:'');

	        			?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_googleplus;?>" href="<?php echo ($default?$link:'https://plus.google.com/share?url='.$url); ?>" target="_blank" ><?php echo $googleplus_text; ?></a><?php

	        			}

	        		break;

					case 'l':

						if(in_array('linkedin', $social_options)){
						
						$link = (isset($opts['social_me']['pinterest'])?$opts['social_me']['pinterest']:'');

							?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_linkedin;?>" href="<?php echo ($default?$link:'http://www.pinterest.com/shareArticle?mini=true&url='.substr($url,0,1024).'&title='.substr($title,0,200));?>" target="_blank" ><?php echo $linkedin_text; ?></a><?php

						}

	        		break;

	        		case 'p':

	        			if(in_array('pinterest', $social_options)){
							
						$link = (isset($opts['social_me']['pinterest'])?$opts['social_me']['pinterest']:'');

	        				?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_pinterest;?>" href="<?php echo ($default?$link:'http://pinterest.com/pin/create/button/?url='.$url.'&media='.$social_image.'&description='.$title);?>" target="_blank" ><?php echo $pinterest_text; ?></a><?php

	        			}

	        		break;

					case 'y':
						//pree($social_options);exit;
	        			if(in_array('youtube', $social_options)){
							
						$link = (isset($opts['social_me']['youtube'])?$opts['social_me']['youtube']:'');

	        				?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_youtube;?>" href="<?php echo ($default?$link:'');?>" target="_blank" ><?php echo $youtube_text; ?></a><?php

	        			}

	        		break;
					
	        		case 'tl':

	        			if(in_array('tutorsloop', $social_options)){
							
						$link = (isset($opts['social_me']['tutorsloop'])?$opts['social_me']['tutorsloop']:'');

	        				?><a <?php echo $loadjs;?> rel="external nofollow" class="<?php echo $ssbutton_tutorsloop;?>" href="<?php echo ($default?$link:'http://www.tutorsloop.net/?share&url='.$url.'&title='.$title.'&description='.$post_content);?>" target="_blank" ><?php echo $tutorsloop_text; ?></a><?php

	        			}

	        		break;					

	        	}

	        } ?>

	    </div>

	    <?php

	  	$output = ob_get_contents();

		ob_end_clean();

		return $output;

	}

}

