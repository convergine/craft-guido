<?php

namespace convergine\guido\controllers;

use convergine\guido\GuidoPlugin;
use convergine\guido\records\Articles;
use craft\errors\MissingComponentException;
use craft\helpers\Json;
use craft\helpers\StringHelper;
use craft\web\Controller;
use craft\web\UploadedFile;
use yii\db\Exception;
use yii\db\StaleObjectException;
use yii\web\BadRequestHttpException;
use yii\web\Response;
use Craft;

class GuidoController extends Controller {

	public function init():void {
		parent::init();
		$scriptUrl = Craft::$app->assetManager->getPublishedUrl(
			'@convergine/guido/assets/js/script.js',
			true
		);

		Craft::$app->view->registerJsFile( $scriptUrl, [
			'depends'  => [ \craft\web\assets\cp\CpAsset::class ],
			'position' => \yii\web\View::POS_END,
		] );

		$styleUrl = Craft::$app->assetManager->getPublishedUrl(
			'@convergine/guido/assets/css/style.css',
			true
		);

		Craft::$app->view->registerCssFile( $styleUrl);
	}

	public function actionList( int|null $id = null,?string $importError = null ) {

		$articles = GuidoPlugin::getInstance()->guido->list();
		$article  = $articles[0]??null;
		if ( $id ) {
			$article = Articles::find()->where( [ 'id' => $id ] )->one();
		}

		return $this->renderTemplate( 'guido/_list', [
			'articles'       => $articles,
			'currentArticle' => $article,
			'importError'=>$importError
		] );


	}

	/**
	 * @throws Exception
	 * @throws BadRequestHttpException
	 */
	public function actionSave() {

		if(!$this->_checkPermissions()){
			return $this->redirectToPostedUrl();
		}

		$id        = $this->request->getBodyParam( 'id', null );
		$title     = $this->request->getBodyParam( 'title' );
		$menuTitle = $this->request->getBodyParam( 'menuTitle' );
		$position  = $this->request->getBodyParam( 'position' );
		$body      = $this->request->getBodyParam( 'body' );

		if ( $id ) {
			$record = Articles::find()->where( [ 'id' => $id ] )->one();
			if ( $record ) {


			}
		} else {
			$record = new Articles();
		}
		$record->title     = $title;
		$record->menuTitle = $menuTitle;
		$record->position  = $position;
		$record->body      = $body;


		try {
			$record->save();
			Craft::$app->getSession()->setNotice( Craft::t( 'guido', 'Your article has been saved.' ) );
		} catch ( Exception $e ) {
			$this->setFailFlash( Craft::t( 'guido', 'Article not saved' ) );
		}

		return $this->redirectToPostedUrl();
	}

	public function actionEdit() {


		$id      = $this->request->getParam( 'id' );
		$article = null;
		$errors  = [];
		if ( $id ) {
			$article = Articles::find()->where( [ 'id' => $id ] )->one();
			if ( ! $article ) {
				$errors[] = 'Article not found';
			}else{
				$title = 'Edit article "'.$article->title.'"';
			}
		}else{
			$title = 'Create new article';
		}

		return $this->renderTemplate( 'guido/_edit_article', [
			'article' => $article,
			'title'=>$title,
			'errors'  => $errors
		] );
	}

	/**
	 * @throws \Throwable
	 * @throws MissingComponentException
	 * @throws StaleObjectException
	 * @throws BadRequestHttpException
	 */
	public function actionDelete() {

		if(!$this->_checkPermissions()){
			return $this->redirectToPostedUrl();
		}

		$id      = $this->request->getParam( 'id' );
		$article = Articles::find()->where( [ 'id' => $id ] )->one();
		try {
			if($article->delete()){
				Craft::$app->getSession()->setNotice( Craft::t( 'guido', 'Your article has been removed.' ) );
			}

		} catch ( StaleObjectException $e ) {
			$this->setFailFlash( Craft::t( 'guido', 'Article not removed' ) );
		} catch ( \Throwable $e ) {
			$this->setFailFlash( Craft::t( 'guido', 'Article not removed' ) );
		}

		return $this->redirect('guido');
	}

	public function actionSettings() {
		return $this->renderTemplate( 'guido/_settings', [

		] );
	}

	public function actionExport() {

		if(!$this->_checkPermissions()){
			return $this->redirectToPostedUrl();
		}

		$data = GuidoPlugin::getInstance()->guido->generateExportData();
		$json = Json::encode($data, JSON_PRETTY_PRINT);

		Craft::$app->getResponse()->sendContentAsFile($json, 'craft_help_articles-' . StringHelper::UUID() . '.json');

		Craft::$app->end();
	}

	public function actionImport() {

		if(!$this->_checkPermissions()){
			return $this->redirectToPostedUrl();
		}

		$imported = 0;
		$request = $this->request;
		$uploadedFile = UploadedFile::getInstanceByName('file');

		if (!$uploadedFile) {
			$this->setFailFlash(Craft::t('guido', 'An error occurred.'));

			Craft::$app->getUrlManager()->setRouteParams([
				'importError' => Craft::t('guido', 'You must upload a file.'),
			]);

			return null;
		}

		$content = file_get_contents($uploadedFile->tempName);
		if($content){
			$content = json_decode($content,true);
			foreach ($content as $c){
				$record = new Articles();
				$record->setAttributes($c,true);
				try {
					if($record->save()){
						$imported++;
					}

				} catch ( Exception $e ) {

				}
			}
		}
		Craft::$app->getSession()->setNotice( Craft::t( 'guido', "Imported {$imported} articles" ) );
		return $this->redirectToPostedUrl();
	}

	public function actionPreview() {
		$html = $this->request->getParam('html');
		return GuidoPlugin::getInstance()->guido->render($html);
	}

	public function actionSearch(?string $importError=null) {

		$keyword = $this->request->getParam('keyword','');

		$articles = GuidoPlugin::getInstance()->guido->list();

		$results = GuidoPlugin::getInstance()->guido->search($keyword);

		return $this->renderTemplate( 'guido/_search', [
			'articles'       => $articles,
			'currentArticle' => null,
			'importError'=>$importError,
			'keyword'=>$keyword,
			'results'=>$results
		] );
	}

	private function _checkPermissions() {
		if(!Craft::$app->getUser()->getIsAdmin()){
			$this->setFailFlash( Craft::t( 'guido', 'You are not permitted to do this action' ) );
			return false;
		}
		return true;
	}
}
