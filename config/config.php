<?php

return [

	/**
	 * position of the button
	 * allowed values: 'tr', 'tl', 'br', 'bl'
	 */
	'position' => 'tr',

	/**
	 * Show label
	 * allowed values: false, true
	 */
    'showLabel' => true,
	/**
	 * Show Icon
	 * allowed values: false, true
	 */
    'showIcon' => true,
	/**
	 * Requires to be logged in
	 * allowed values: false, true
	 */
	'requiresAuth' => true,
	/**
	 * Auto refresh content
	 * allowed values: false, true
	 */
	'autorefresh' => true,
	/**
	 * Button Label
	 */
	'buttonLabel' => 'Edit Post',

	/**
	 * Edit URL
	 * {id} is substitutet with blog post id
	 */
	'editUrl' => 'rainlab/blog/posts/update/{id}'

];