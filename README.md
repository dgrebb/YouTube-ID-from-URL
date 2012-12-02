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

Special thanks goes to this [Stack Exchange thread](http://stackoverflow.com/questions/6556559/youtube-api-extract-video-id/).