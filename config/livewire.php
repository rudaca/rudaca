<?php
return [
    'temporary_file_upload' => [
        'disk' => 'public',
		'rules' => 'file|mimes:png,jpg,jpeg,gif,mp4|max:2002400',
    ],
];