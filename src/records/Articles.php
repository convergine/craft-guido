<?php

namespace convergine\guido\records;

use convergine\guido\GuidoPlugin;
use craft\db\ActiveRecord;
use craft\helpers\UrlHelper;

/**
 * Class Cart record.
 * @property $id
 * @property $title
 * @property $menuTitle
 * @property $position
 * @property $body
 */

class Articles extends ActiveRecord {

	public static function tableName():string {
		return '{{%guido_articles}}';
	}

	public function getUrl() {

		return UrlHelper::cpUrl('guido/' . $this->id);
	}

	public function getBody() {
		return GuidoPlugin::getInstance()->guido->render($this->body);
	}

	public function rules() {
		return [
			[ [ 'title', 'menuTitle', 'position', 'body' ], 'required' ]
		];
	}
}