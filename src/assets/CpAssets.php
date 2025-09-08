<?php

namespace convergine\guido\assets;
use craft\web\AssetBundle;

class CpAssets extends AssetBundle{
	/**
	 * @inheritdoc
	 */
	public function init()
	{
		$this->sourcePath = __DIR__;

		$this->js = [
			'js/script.js'
		];

		$this->css = [
			'css/style.css',
		];

		parent::init();
	}
}
