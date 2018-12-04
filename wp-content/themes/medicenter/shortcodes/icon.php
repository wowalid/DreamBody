<?php
function theme_mc_icon($atts)
{
	extract(shortcode_atts(array(
		"type" => "social_body",
		"icon_social" => "blogger",
		"icon_feature" => "address",
		"icon_color" => "blue_light",
		"url" => "",
		"url_target" => 'new_window',
		"title" => '',
		"class" => '',
		"top_margin" => "none"
	), $atts));
	return '<' . ($url!="" ? 'a' : 'span') . ($url!="" ? ' href="' . esc_attr($url) . '"' . ($url_target=="new_window" ? ' target="_blank"' : '') : '') . ($type=="social_body" || $type=="social_footer" ? ' style="background-image:url(' . get_template_directory_uri() . '/images/' . $type . '/' . $icon_color . '/' . $icon_social . '.png);"' : '') . ' class="' . ($type=="social_body" || $type=="social_footer" ? 'social_icon' : 'features_image' . ($type=="icons_small" ? ' features_image_small' : '')) . ($class!="" ? ' ' . $class : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '"' . ($title!="" ? ' title="' . $title . '"' : '') . '>' . ($type=="icons_large" || $type=="icons_small" ? '<img src="' . get_template_directory_uri() . '/images/' . $type . '/' . $icon_color . '/' . $icon_feature . '.png">' : '') . '</' . ($url!="" ? 'a' : 'span') . '>';
}
add_shortcode("mc_icon", "theme_mc_icon");
//visual composer
$icons = array(
	"blogger",
	"deviantart",
	"dribbble",
	"envato",
	"facebook",
	"flickr",
	"form",
	"forrst",
	"googleplus",
	"instagram",
	"linkedin",
	"mail",
	"myspace",
	"phone",
	"picasa",
	"pinterest",
	"rss",
	"skype",
	"soundcloud",
	"stumbleupon",
	"tumblr",
	"twitter",
	"vimeo",
	"xing",
	"youtube"
);
$icons_features = array(
	'address',
	'adjust',
	'administration',
	'app',
	'award',
	'balance',
	'battery',
	'bed',
	'bin',
	'binders',
	'binoculars',
	'bookmark',
	'box',
	'briefcase',
	'building',
	'calendar',
	'cart',
	'chart',
	'chat',
	'clock',
	'cloud_upload',
	'config',
	'credit_card',
	'cross',
	'database',
	'diary',
	'document',
	'download',
	'dropper',
	'fail',
	'fax',
	'first_aid',
	'folder',
	'form',
	'gallery',
	'glasses',
	'graph',
	'healthcare',
	'heart',
	'home',
	'hourglass',
	'hyperlink',
	'id',
	'image',
	'info',
	'keyboard',
	'lab',
	'laptop',
	'leaf',
	'list',
	'lock',
	'luggage',
	'mail',
	'mic',
	'minus',
	'mobile',
	'money',
	'movie',
	'network',
	'oscilloscope',
	'paintbrush',
	'people',
	'phone',
	'piano',
	'pill',
	'pin',
	'plus',
	'printer',
	'projector',
	'question_mark',
	'quote',
	'restaurant',
	'rss',
	'screen',
	'shield',
	'signpost',
	'speaker',
	'success',
	'syringe',
	'tablet',
	'tags',
	'target',
	'tick',
	'upload',
	'video',
	'wall',
	'wallet',
	'warning',
	'weight',
	'wheelchair'
);

wpb_map( array(
	"name" => __("Icon", 'medicenter'),
	"base" => "mc_icon",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-icon",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'medicenter'),
			"param_name" => "type",
			"value" => array(__("Social body", 'medicenter') => "social_body",  __("Social footer", 'medicenter') => "social_footer", __("Feature large", 'medicenter') => "icons_large", __("Feature small", 'medicenter') => "icons_small")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'medicenter'),
			"param_name" => "icon_social",
			"value" => $icons,
			"dependency" => Array('element' => "type", 'value' => array('social_body', 'social_footer'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'medicenter'),
			"param_name" => "icon_feature",
			"value" => $icons_features,
			"dependency" => Array('element' => "type", 'value' => array('icons_large', 'icons_small'))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon color", 'medicenter'),
			"param_name" => "icon_color",
			"value" => array(
				__("light blue", 'medicenter') => 'blue_light', 
				__("dark blue", 'medicenter') => 'blue_dark',
				__("blue", 'medicenter') => 'blue',
				__("black", 'medicenter') => 'black',
				__("gray", 'medicenter') => 'gray',
				__("dark gray", 'medicenter') => 'gray_dark',
				__("light gray", 'medicenter') => 'gray_light',
				__("green", 'medicenter') => 'green',
				__("dark green", 'medicenter') => 'green_dark',
				__("light green", 'medicenter') => 'green_light',
				__("orange", 'medicenter') => 'orange',
				__("dark orange", 'medicenter') => 'orange_dark',
				__("light orange", 'medicenter') => 'orange_light',
				__("red", 'medicenter') => 'red',
				__("dark red", 'medicenter') => 'red_dark',
				__("light red", 'medicenter') => 'red_light',
				__("turquoise", 'medicenter') => 'turquoise',
				__("dark turquoise", 'medicenter') => 'turquoise_dark',
				__("light turquoise", 'medicenter') => 'turquoise_light',
				__("violet", 'medicenter') => 'violet',
				__("dark violet", 'medicenter') => 'violet_dark',
				__("light violet", 'medicenter') => 'violet_light',
				__("white", 'medicenter') => 'white',
				__("yellow", 'medicenter') => 'yellow'
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Url", 'medicenter'),
			"param_name" => "url",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Url target", 'medicenter'),
			"param_name" => "url_target",
			"value" => array(
				__("new window", 'medicenter') => 'new_window', 
				__("same window", 'medicenter') => 'same_window'
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'medicenter'),
			"param_name" => "title",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'medicenter'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none", __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section")
		)
	)
));
?>
