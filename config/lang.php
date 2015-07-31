<?php

return [
	'general' => [
		'page-title' => 'pfSense csv to xml',
	],
	'link-text' => [
		'file-config' => 'Create XML from a .csv file',
		'file-upload' => 'Upload new file'
	],
	'messages' => [
		'missing' => 'All fields are mandatory',
		'upload' => [
			'success' => 'File uploaded!',
			'failure' => 'File upload failed, please try again'
		]
	],
	'pages' => [
		'index' => [
			'h1' => 'Upload csv file',
			'note' => 'File must have the following fields in the exact order:',
			'fields' => [
				'Username',
				'Password',
				'Description'
			],
			'form' => [
				'file' => '.csv File',
				'submit' => 'Upload file',
			]
		],
		'options' => [
			'h1' => 'Output settings',
			'file' => '.csv file',
			'uid' => 'starting id',
			'format' => 'Output format',
			'form' => [
				'default' => 'Select one',
				'html-output' => 'View as HTML',
				'source-output' => 'View from source',
				'submit' => 'Get XML'
			]
		]
	]
];