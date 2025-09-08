<?php

namespace convergine\guido\services;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\Strikethrough\StrikethroughExtension;
use League\CommonMark\Extension\TaskList\TaskListExtension;
use convergine\guido\records\Articles;
use craft\base\Component;

use Craft;
use League\CommonMark\MarkdownConverter;

class GuidoService extends Component {

	private MarkdownConverter $converter;

	public function init():void
	{
		parent::init();

		$config = [
			'html_input' => 'strip',
			'allow_unsafe_links' => false,
			'table' => [
				// alignment like :--- ---: works out of the box in v2
			],
		];

		$environment = new Environment($config);
		$environment->addExtension(new CommonMarkCoreExtension());
		$environment->addExtension(new TableExtension());
		$environment->addExtension(new AttributesExtension());
		$environment->addExtension(new AutolinkExtension());
		$environment->addExtension(new StrikethroughExtension());
		$environment->addExtension(new TaskListExtension());

		$this->converter = new MarkdownConverter($environment);
	}

	public function render(string $markdown): string
	{
		return $this->converter->convert($markdown)->getContent();
	}

	public function generateExportData():array|null {
		$records = Articles::find()->asArray()->all();

		foreach ($records as $key=>$data){
			foreach (['id', 'dateCreated', 'dateUpdated', 'uid'] as $k) {
				if (is_array($records[$key]) && array_key_exists($k, $records[$key])) {
					unset($records[$key][$k]);
				}
			}
		}
		return $records;
	}

	public function list() {

		return Articles::find()->orderBy('position ASC')->all();
	}

	public function search(string $keywords): array {
		$words = array_filter(array_map('trim', preg_split('/\s+/', $keywords)));
		if (empty($words)) {
			return [];
		}

		$query = Articles::find()->orderBy(['position' => SORT_ASC]);

		$andConditions = [];
		foreach ($words as $word) {
			$andConditions[] = ['or',
				['like', 'title', $word],
				['like', 'menuTitle', $word],
				['like', 'body', $word],
			];
		}

		$query->andWhere(['and', ...$andConditions]);

		$results = $query->all();
		$output = [];

		foreach ($results as $article) {
			/** @var Articles $article */
			$matchedText = '';

			// Get the first keyword match for snippet preview
			foreach ($words as $word) {
				foreach (['title', 'menuTitle', 'body'] as $field) {
					if (stripos($article->$field, $word) !== false) {
						$matchedText = self::getSnippet($article->$field, $words);
						break 2;
					}
				}
			}

			$output[] = [
				'id' => $article->id,
				'title' => $article->title,
				'text' => $matchedText,
				'url' => $article->getUrl(),
			];
		}

		return $output;
	}
	private function getSnippet(string $text, array $keywords, int $snippetLength = 100): string {
		$lowerText = mb_strtolower($text);
		$positions = [];

		foreach ($keywords as $keyword) {
			$pos = mb_strpos($lowerText, mb_strtolower($keyword));
			if ($pos !== false) {
				$positions[] = $pos;
			}
		}

		if (empty($positions)) {
			return '';
		}

		// Use the first match position to generate snippet
		$startPos = min($positions);
		$start = max(0, $startPos - (int)($snippetLength / 2));
		$snippet = mb_substr($text, $start, $snippetLength);

		// Escape HTML for safety
		$snippet = htmlspecialchars($snippet, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

		// Highlight all keywords (case-insensitive)
		foreach ($keywords as $keyword) {
			$pattern = '/' . preg_quote($keyword, '/') . '/iu';
			$snippet = preg_replace($pattern, '**$0**', $snippet);
		}

		return $this->render($snippet);
	}
}
