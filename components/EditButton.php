<?php

namespace Enovision\FrontendEditButton\Components;

use Cms\Classes\Page;
use Enovision\FrontendEditButton\Models\Settings;
use Config;
use Backend\Facades\BackendAuth;
use Backend\Facades\Backend;

class EditButton extends \Cms\Classes\ComponentBase {

	public $showIcon;
	public $showLabel;
	public $buttonLabel;
	public $editUrl;
	public $pageUrl;
	public $vertical;
	public $horizontal;

	public $isLoggedIn = false;
	private $_user = null;

	public $postPage;

	public function componentDetails() {
		return [
			'name'        => 'enovision.frontendeditbutton::lang.plugin.name',
			'description' => 'enovision.frontendeditbutton::lang.plugin.description'
		];
	}

	public function defineProperties() {

		return [
			'postPage' => [
				'title'       => 'rainlab.blog::lang.settings.posts_post',
				'description' => 'rainlab.blog::lang.settings.posts_post_description',
				'type'        => 'dropdown',
				'default'     => 'blog/post',
				'group'       => 'Links'
			]
		];
	}

	public function getPostPageOptions() {
		return Page::sortBy( 'baseFileName' )->lists( 'baseFileName', 'baseFileName' );
	}

	public function onRun() {
		$this->isLoggedIn = BackendAuth::check();
		$this->_user      = BackendAuth::getUser();
		$enabled = Settings::get( 'plugin_enabled', false );

		if ( $enabled && $this->_user && $this->isLoggedIn ) {
			$this->addJs( '/plugins/enovision/frontendeditbutton/assets/js/script.js' );
			$this->addCss( '/plugins/enovision/frontendeditbutton/assets/css/style.min.css' );
		} else {
			return; // do nothing
		}

		/*
		 * This works with config/config.php
		$this->buttonLabel = Config::get( 'enovision.frontendeditbutton::buttonLabel', 'Edit' );
		$this->showIcon    = Config::get( 'enovision.frontendeditbutton::showicon', true );
		$this->showLabel   = Config::get( 'enovision.frontendeditbutton::showlabel', true );
		$editUrl           = Config::get( 'enovision.frontendeditbutton::editUrl', true );
		*/

		$this->buttonLabel = Settings::get( 'button_label', 'Edit' );
		$this->showIcon    = Settings::get( 'show_icon', true );
		$this->showLabel   = Settings::get( 'show_label', true );
		$editUrl           = Settings::get( 'edit_url', 'rainlab/blog/posts/update/{id}' );


		$this->pageUrl = str_replace( '{id}', $this->page->post->id, $editUrl );
		$this->editUrl = Backend::url( $this->pageUrl );

		if ( $this->showIcon === false && $this->showLabel === false ) {
			$this->showLabel = true;
		}

		$position = Settings::get( 'position', 'tr' );

		$this->vertical   = substr( $position, 0, 1 ) === 't' ? 'top' : 'bottom';
		$this->horizontal = substr( $position, 1, 1 ) === 'l' ? 'left' : 'right';

		$this->buttonLabel = Settings::get( 'button_label', 'Edit Post' );

		$this->postPage = $this->page['postPage'] = $this->property( 'postPage' );
	}
}