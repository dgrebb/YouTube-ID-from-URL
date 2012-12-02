<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Memberlist Class
 *
 * @package     ExpressionEngine
 * @category	Plugin
 * @author 		Jane Doe
 * @copyright   Copyright (c) 2010, Jane Doe
 */

$plugin_info = array(
	'pi_name'       	=> 'YouTube ID from URL',
	'pi_version'        => '1.0',
	'pi_author'     	=> 'Dan Grebb',
	'pi_author_url'     => 'http://dgrebb.com/',
	'pi_description'    => 'Returns a YouTube ID from a variety of youtube share link types.',
	'pi_usage' => Youtube_id_from_url::usage()
);

class Youtube_id_from_url {

	public $return_data = "";

    public function __construct($urltag = NULL)
    {
        $this->EE =& get_instance();

        if (empty($urltag))
        {
            $urltag = $this->EE->TMPL->tagdata;
        }

		$youtubeid = $this->sliceurl($urltag);

        $this->return_data = $youtubeid;
    }

	function sliceurl($url) {
	    $pattern = 
	        '%^# Match any youtube URL
	        (?:https?://)?  # Optional scheme. Either http or https
	        (?:www\.)?      # Optional www subdomain
	        (?:             # Group host alternatives
	          youtu\.be/    # Either youtu.be,
	        | youtube\.com  # or youtube.com
	          (?:           # Group path alternatives
	            /embed/     # Either /embed/
	          | /v/         # or /v/
	          | /watch\?v=  # or /watch\?v=
	          )             # End path alternatives.
	        )               # End host alternatives.
	        ([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
	        $%x'
	        ;
	    $result = preg_match($pattern, $url, $matches);
	    if (false !== $result) {
	        return $matches[1];
	    }
	    return false;
	}

	// usage instructions
	public function usage() 
	{
  		ob_start();
	?>

		This plugin is useful for slicing up member-supplied YouTube URLs for iframe embeds.

		If a user submits any of the below in Text Input custom field type, wrap it in this plugin's tags to output just the ID of the YouTube video.

		http://www.youtube.com/watch?v=dQw4w9WgXcQ
		http://youtu.be/dQw4w9WgXcQ
		http://www.youtube.com/embed/dQw4w9WgXcQ

		Usage:

		{exp:youtube_id_from_url}
			{custom_field}
		{/exp:youtube_id_from_url}

		Any of the above URLs would render as "dQw4w9WgXcQ".

	<?php
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
}

/* End of file pi.youtube_id_from_url.php */
/* Location: ./system/expressionengine/third_party/youtube_id_from_url/pi.youtube_id_from_url.php */