<?php if ( ! defined( 'ABSPATH' ) ) exit; 

	function sanitize_wpes_data( $input ) {

		if(is_array($input)){
		
			$new_input = array();
	
			foreach ( $input as $key => $val ) {
				$new_input[ $key ] = (is_array($val)?sanitize_wpes_data($val):sanitize_text_field( $val ));
			}
			
		}else{
			$new_input = sanitize_text_field($input);
		}
		
		return $new_input;
	}

	if(!function_exists('pre')){

		function pre($data){

			if(isset($_GET['debug'])){

				pree($data);

			}

		}	 

	} 

	if(!function_exists('pree')){

	function pree($data){

				echo '<pre>';

				print_r($data);

				echo '</pre>';	

		

		}	 

	} 



	

	

	function ES_get_options()

	{	

		static $options;

	

		if( ! $options ) {

			$defaults = array(

				'twitter_username' => "",

				'auto_add_post_types' => array( 'post' ),

				'social_options'=>explode(',',WPES_DEFAULT_ICONS),

				'load_esset'=>array('load_css','load_js'),

				'facebook_text'=>"",

				'twitter_text'=>"",

				'googleplus_text'=>"",

				'linkedin_text'=>"",

				'pinterest_text'=>"",

				'tutorsloop_text'=>"",

				'before_button_text'=>'',

			);

	

			$db_option = get_option( 'wpe_sharing', array());

			//pree($db_option);

			if(!isset($db_option['load_esset'])){

				$db_option['load_esset']=array();

			}

			if(!isset($db_option['social_options'])){

				$db_option['social_options']=array();

			}

			if(!isset($db_option['auto_add_post_types'])){

				$db_option['auto_add_post_types']=array();

			}

		

			if( ! $db_option ) {
				//pree($defaults);exit;
				update_option( 'wpe_sharing', $defaults );

			}else{
				if(!empty($_POST) && isset($_POST['wpe_sharing'])){
					//pree($_POST);exit;
					update_option( 'wpe_sharing', sanitize_wpes_data($_POST['wpe_sharing']) );
					$db_option = get_option( 'wpe_sharing', array());
				}
			}

			

			

			

			$options = wp_parse_args( $db_option, $defaults );

			

			$options['icon_order']=get_option('wes_wpe_sharing');

			//pree($options);

		}

		return $options;

	}

	add_action('admin_footer','include_icon_order_script');

	function include_icon_order_script(){

		wp_enqueue_script( 'jquery-ui-sortable' );

	?>

		<script type="text/javascript">

			jQuery(document).ready(function($){

				$('.dndicon').sortable({

					stop:function(event,ui){

						var new_order='';

						$('.dndicon > div').each(function(e,i){

							new_order += $(i).attr('id')+',';

						});

						new_order = new_order.slice(0,new_order.length-1);

						var ajax_data={'action':'wes_update_icon_order','new_order':new_order};

						$.post(ajaxurl,ajax_data,function(response){});

					}	

				});

			});

		</script>

	<?php 	

	}

	

	add_action('wp_ajax_wes_update_icon_order','include_icon_order_action');

	

	function include_icon_order_action(){

		//pree($_POST); exit;
		
		update_option('wes_wpe_sharing', sanitize_wpes_data(rtrim($_POST['new_order'],',')));

		die;

	}

	



	function wpe_plugin_links($links) { 

		global $wpe_premium_link, $wpe_pro;

		

		$settings_link = '<a href="options-general.php?page=wp-easy-sharing">'.__('Settings', 'wpe-sharing').'</a>';

		

		if($wpe_pro){

			array_unshift($links, $settings_link); 

		}else{			 

			$wpe_premium_link = '<a href="'.$wpe_premium_link.'" title="'.__('Go Premium', 'wpe-sharing').'" target=_blank>'.__('Go Premium', 'wpe-sharing').'</a>'; 

			array_unshift($links, $settings_link, $wpe_premium_link); 		

		}

		

		

		return $links; 

	}

		