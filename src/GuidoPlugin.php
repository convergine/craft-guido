<?php
namespace convergine\guido;

use convergine\guido\services\GuidoService;
use Craft;
use craft\base\Plugin;
use craft\events\RegisterCpNavItemsEvent;
use craft\web\twig\variables\Cp;
use craft\events\RegisterUrlRulesEvent;
use craft\web\UrlManager;
use yii\base\Event;

/**
 * @property GuidoService $guido
 */
class GuidoPlugin extends Plugin {
	public static string $plugin;
	public ?string $name = 'Guido';
	public static GuidoService $guido;

	public function init() : void {
		$this->hasCpSection = true;
		$this->hasCpSettings = false;
		parent::init();

		$this->setRoutes();
		$this->setEvents();
	}

	public static function config(): array {
		return [
			'components' => [
				'guido'       => GuidoService::class
			],
		];
	}

	protected function setRoutes() : void {
		Event::on(
			UrlManager::class,
			UrlManager::EVENT_REGISTER_CP_URL_RULES,
			function (RegisterUrlRulesEvent $event) {
				$event->rules['guido'] = 'guido/guido/list';
				$event->rules['guido/<id:\d+>'] = 'guido/guido/list';
				$event->rules['guido/edit'] = 'guido/guido/edit';
				$event->rules['guido/settings'] = 'guido/guido/settings';
				$event->rules['guido/preview'] = 'guido/guido/preview';
				$event->rules['guido/search'] = 'guido/guido/search';

			}
		);
	}

	private function setEvents() : void {
		Event::on(
			Cp::class,
			Cp::EVENT_REGISTER_CP_NAV_ITEMS,
			function (RegisterCpNavItemsEvent $event) {

				// Find your plugin nav item and remove it
				foreach ($event->navItems as $index => $item) {
					if ($item['url'] === 'guido') {
						$pluginNavItem = $item;
						unset($event->navItems[$index]);
						break;
					}
				}

				// Re-index the array
				$event->navItems = array_values($event->navItems);

				// Add it at the end
				if (isset($pluginNavItem)) {
					$event->navItems[] = $pluginNavItem;
				}
			}
		);
	}
	public function getCpNavItem(): ?array {
		$nav = parent::getCpNavItem();

		$nav['label'] = 'Guido';
		$nav['url']   = 'guido';

		return $nav;
	}
}
