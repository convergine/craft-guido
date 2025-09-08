<?php

namespace convergine\guido\migrations;

use convergine\guido\records\Articles;
use craft\db\Migration;
use yii\db\Exception;

/**
 * Install migration.
 */
class Install extends Migration {
	/**
	 * @inheritdoc
	 * @throws Exception
	 */
	public function safeUp(): bool {
		if ( ! $this->db->tableExists( Articles::tableName() ) ) {
			$this->createTable( Articles::tableName(), [
				'id'          => $this->primaryKey(),
				'title'       => $this->string( 255 ),
				'menuTitle'   => $this->string( 255 ),
				'body'        => $this->text(),
				'position'    => $this->integer(),
				'dateCreated' => $this->dateTime()->notNull(),
				'dateUpdated' => $this->dateTime()->notNull(),
				'uid'         => $this->uid(),
			] );

			$record = new Articles();
			$record->title = 'Getting Started with Helper';
			$record->menuTitle = 'Getting Started';
			$record->position = 1;
			$record->body = '👋 Getting Started with Helper hello

Thank you for installing the **Helper** plugin for CraftCMS.

This section is here to guide you in setting up and maintaining your internal knowledge base.

---

## ✏️ Managing Articles
- Use the **ADD** button at the bottom of the left pane to **add a new article**.  
- Each article has:
  - **Title** – full article heading  
  - **Menu Title** – label shown in the left navigation  
  - **Position** – numeric sort order in the menu  
  - **Description** – written in **Markdown**  

- In the right pane, when viewing an article:
  - Use the **EDIT** button (top right) to edit it  
  - Use the **X icon** button to delete it (irreversible, confirm first)

---

## 📤 Import / Export
- Admins can **export all articles** into a single `.json` file.  
- Articles can be **imported** from the same format to migrate between environments or clients.

---

## 📝 Markdown Examples
**Bold** → `**Bold**`  
*Italic* → `*Italic*`  
~~Strikethrough~~ → `~~Strikethrough~~`

### Lists
- Point A  
- Point B  
  - Nested point  

### Code Block
```html
echo "<p>Hello from Helper!</p>";"';
			try {
				$record->save();
			} catch ( Exception $e ) {

			}
		}

		return true;
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown(): bool {
		return true;
	}
}
