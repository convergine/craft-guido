<?php

namespace convergine\guido\migrations;

use convergine\guido\records\Articles;
use Craft;
use craft\db\Migration;

/**
 * m251003_061613_add_pages migration.
 */
class m251003_061613_add_pages extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp(): bool
    {
	    $record = new Articles();
	    $record->title = 'Dashboard Overview';
	    $record->menuTitle = 'Dashboard Overview';
	    $record->position = 2;
	    $record->body = 'Once logged in, you’ll see the **Dashboard**—your home base. Its appearance may vary depending on which widgets are enabled, but you’ll typically find:

- **Recent entries** – quick links to the latest content you or your team edited
- **Recent activity** – a log of changes made by different users
- **Shortcuts / Custom widgets** – developer-provided tools (forms, SEO, analytics, etc.)

![Dashboard](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/dash1.png)

---

From the Dashboard, use the **Main Navigation** on the left to move into any part of the system. From here, you can:

## Access content sections
![Content Sections](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/dash2.png)

## Manage assets
![Assets](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/dash3.png)

## Review form submissions (if enabled)
![Form Submissions 1](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/dash4.png)  
![Form Submissions 2](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/dash5.png)

## SEO settings
![SEO Settings](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/seoSettings1.png)';

		    $record->save();


	    $record = new Articles();
	    $record->title = 'Editing Content';
	    $record->menuTitle = 'Editing Content';
	    $record->position = 3;
	    $record->body = '## Core Concepts

- **Entries:** Pages/items of content (e.g., Blog posts, News, Services).
- **Sections:** Groups of entries; types include **Channel**, **Structure**, and **Single**.
- **Fields:** The building blocks of an entry (Text, Rich Text, Matrix, Assets, etc.).
- **Globals:** Site-wide content (e.g., header/footer contact info).
- **Assets:** Files and images stored in organized folders/volumes.
- **Categories/Tags:** Content organization and relationships.
- **Sites/Languages:** Multi-site or multi-language content.

---

## Content is typically divided into:

### 4.1 Singles
Used for one-off pages like **Home** or **About**.

1. From the left sidebar, click **Entries › Singles**  
2. Select the page (e.g., **Home**)  
3. Make your edits  
4. Click **Save**

[![Edit Single Entry](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit1.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit1.png)

> **Tip:** Use the **Preview** button (upper right) to see real-time changes before saving.

---

### 4.2 Channels / Structures
Used for repeating content like **Blog posts** or **Team members**.

1. Click **Entries › Blog** (or relevant section name)

[![Entries List](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit2.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit2.png)

2. Click **New Entry** or edit existing ones  
3. Fill in title, content, images, etc.  
4. Click **Save**

[![Edit Channel/Structure Entry](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit3.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit3.png)

**Editing Existing Content**
- Go to **Entries** and select the section.  
- Find the entry in the list.  
- Click its title, make edits, and **Save**.

---

### 4.3 Page Sections
Page sections are flexible content areas made of blocks (text, image, quote, video, etc.).

1. Click **Add Section**  
2. Choose block type (Text, Image, etc.)

[![Add Section Block](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit4.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit4.png)

3. Fill out the fields

[![Fill Section Fields](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit5.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit5.png)

4. Reorder the page layout by dragging sections.

[![Reorder Sections](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit6.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit6.png)

---

### 4.4 Rich Text Editor
Used to style text:

- **B** = Bold text  
- **I** = Italic text  
- “ ” = Quote block  
- **H1 / H2 / H3** = Choose heading style  
- 🔗 = Insert link  
- • / 1. = Bulleted or numbered list  
- 📷 = Insert image (via **Assets**)

[![Rich Text Editor](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit7.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/edit7.png)';

	    $record->save();



	    $record = new Articles();
	    $record->title = 'Managing Assets (Images, Files)';
	    $record->menuTitle = 'Managing Assets';
	    $record->position = 4;
	    $record->body = '
## Working with Assets (images, PDFs, files)
Assets are all media files used on your site.

---

## Upload Assets through the Craft Dashboard

1. Go to **Assets** in the sidebar.  
2. In the left menu, select the asset folder.

[![Select Asset Folder](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset1.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset1.png)

3. Click **Upload files** to add images, documents, etc.

[![Upload Files Button](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset2.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset2.png)

---

## Drag & Drop

You can drag files from your computer directly into the file grid area.

[![Drag & Drop Area](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset3.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset3.png)

---

## Rename or Delete Files

You can rename or delete files from the Assets view.

[![Rename or Delete Files](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset4.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset4.png)

---

## Upload from an Entry (via Assets Field)

1. Open an **Entry** that has an **Assets** field (e.g., “Featured Image”).  
2. Click **Add an asset → Upload files** (or **Choose from library**).

[![Assets Field - Add an Asset](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset5.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset5.png)  
[![Choose from Library](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset6.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/asset6.png)

---

> ⚠️ **Important:** Always click **Save** before leaving the page.';
	    $record->save();


	    $record = new Articles();
	    $record->title = 'SEO & Metadata (SEOmatic)';
	    $record->menuTitle = 'SEO & Metadata';
	    $record->position = 5;
	    $record->body = 'Most Craft CMS sites use the **SEOmatic** plugin to manage search engine optimization (SEO) settings and how pages look when shared on Google, Facebook, or LinkedIn.

- Your site likely uses **SEOmatic** for SEO.

---

## Where You\'ll Find the Page SEO Tab

When editing an **Entry**, scroll down or look for the **SEO** tab.

---

## Optimization Tab (Google Search Preview)

**Snippet**
  - Shows a live preview of how your page might appear in Google.
  - You can click the **Title** or **Description** to edit them.
  - **Title** = the clickable headline in search results.
  - **Description** = the short text below the title in search results.

**Focus Keywords**
  - Optional: type in the main keyword(s) this page is about.
  - Once added, SEOMatic gives you a score/checklist to show if the keyword is included in the Title, Description, and content.

**Optimization Checklist**
  - Turns green/red depending on how well your page is optimized for the chosen keyword.
  - It\'s a guide—not mandatory.

[![SEOmatic Optimization Tab](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/seo.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/seo.png)

---

## Social Tab (How It Looks on Social Media)

Control how the page looks when shared on social platforms.

Here you can:
- Add a **Social Sharing Title** & **Description** (these can differ from the Google ones).
- Upload a **Social Image** (shown when shared on Facebook, LinkedIn, or Twitter/X).  
  - **Recommended size:** at least **1200×630 px**.

If you don\'t set anything here, SEOMatic uses the default Title/Description and the site-wide default image.

[![SEOmatic Social Tab](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/seo2.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/seo2.png)

---

## Advanced Tab

Usually you don\'t need to touch this. Developers might set things like:
- **Canonical URLs**
- **Robots directives** (index/noindex)
- **Schema** data

> 📌 For editors, leave these as they are unless specifically instructed.

---

**Note:** Fields may auto-fill based on your content.';
	    $record->save();


	    $record = new Articles();
	    $record->title = 'Forms';
	    $record->menuTitle = 'Forms';
	    $record->position = 6;
	    $record->body = 'If your site has forms (like **Contact Us**, **Newsletter Signup**, or **Request a Quote**), these are usually managed through the **Forms** section in the Craft admin panel.

---

## Viewing Submissions

1. Go to **Forms → Submissions** in the left-hand menu.  
2. Choose the form you want to review (e.g., **Contact Form**).  
3. Click on the number below the **Entries** tab.

[![Forms: Submissions List Link](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form1.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form1.png)

You’ll see a list of all entries submitted through the site. Click any submission to see the full details (name, email, message, etc.).

[![Forms: Submissions Table](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form2.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form2.png)  
[![Forms: Submission Detail](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form3.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form3.png)

> 👉 **Useful:** Quickly check new leads or inquiries without opening your email inbox.

---

## Managing Form Settings

[![Forms: Settings Screen](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form4.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form4.png)

**Form Name**  
How the form is labeled in the control panel (e.g., “Contact Form”).

**To Email**  
Where submissions are sent. You can enter multiple emails, separated by commas (example: `info@domain.com, support@domain.com`).

**Active**  
Toggle **ON/OFF**. If **OFF**, the form won’t accept submissions.

**Save Entries**  
If **ON**, submissions are saved in the Craft database (so you can view them in the **Submissions** area).

**Send Email**  
If **ON**, submissions also get emailed to the addresses you listed above.

[![Forms: Email & Save Settings](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form5.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/form5.png)';
	    $record->save();


	    $record = new Articles();
	    $record->title = 'User Roles & Permissions';
	    $record->menuTitle = 'User Roles & Permissions';
	    $record->position = 7;
	    $record->body = 'Craft CMS allows fine-grained, least-privilege access control. Typical profiles:

- **Admin:** Has full access to all settings and content.
- **Editor/Author:** Can create and manage content (scope varies by role).
- **Custom roles:** Tailored to your organization (e.g., “News Editor”, “Translator”).

---

## Create Users & Assign Roles/Groups

1. Go to **Users → New user**.  
   [![Users: New User](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use1.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use1.png)

2. Enter **Full Name** and **Email**; choose **Send activation email** or set a password.  
   [![Users: Details Form](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use2.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use2.png)  
   [![Users: Password/Activation](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use3.png)](https://convergine.nyc3.cdn.digitaloceanspaces.com/guido/default/use3.png)

3. (Optional) Toggle **Admin** only for true administrators.

4. Assign the user to the appropriate **Role(s)** and/or **Group(s)** you created.';
	    $record->save();

	    $record = new Articles();
	    $record->title = 'Helpful Tips';
	    $record->menuTitle = 'Helpful Tips';
	    $record->position = 8;
	    $record->body = '
- **Always Save:** Remember to click the **Save** button before leaving a page — otherwise your changes will be lost.
- **Preview First:** Use the **Preview** option to see how content looks before publishing.
- **Check Formatting:** Keep headings consistent (**H2** for main sections, **H3** for sub-sections) for readability and SEO.
- **Optimize Images:** Upload images in web-friendly sizes (usually under **1 MB**). Use the correct **Asset volume/folder** (e.g., *Blog Images* vs *Documents*).
- **Consistency Matters:** Use the same naming style for titles, tags, and categories to keep the site organized.
- **Forms:** If you adjust forms, test them right after saving to make sure submissions still come through.
- **SEO:** Fill in the **Title** and **Description** fields for important pages — it helps with Google rankings and social sharing.
- **User Accounts:** Don’t share logins. Each editor should use their own account with the right permissions.
- **Logging Out:** Always log out if you’re on a shared or public computer.
- **Ask When Unsure:** If you’re not sure what a field does, check this manual first — and if it’s still unclear, reach out to your support contact.';
	    $record->save();

	    $record = new Articles();
	    $record->title = 'Functionality Extensions';
	    $record->menuTitle = 'Functionality Extensions';
	    $record->position = 9;
	    $record->body = 'Convergine develops and maintains plugins that extend Craft CMS with powerful, editor-friendly functionality. These are built to simplify everyday content workflows and ensure compliance.

---

## Popular Craft CMS Plugins from Convergine

- **Content Buddy** – Streamlined content editing and management  
  <https://plugins.craftcms.com/convergine-contentbuddy>

- **Cookie Buddy** – Cookie consent and GDPR/CCPA compliance manager  
  <https://plugins.craftcms.com/convergine-cookiebuddy>

- **Social Buddy** – Manage and display social media links and feeds  
  <https://plugins.craftcms.com/convergine-socialbuddy>

---

## Other Popular Craft CMS Plugins

Plugins extend Craft CMS by adding extra functionality. Your project may use a mix of custom plugins (built/managed by our team) and popular third-party plugins.

- **SEOmatic** – Complete SEO management for Craft CMS  
  <https://plugins.craftcms.com/seomatic>

- **Freeform** – Flexible form builder by Solspace  
  <https://plugins.craftcms.com/freeform>

- **CKEditor** – Rich text editor for content fields (recommended editor for Craft 5)  
  <https://plugins.craftcms.com/ckeditor?craft5>

- **Super Table** – Create flexible, table-style content fields  
  <https://plugins.craftcms.com/super-table>

- **Feed Me** – Import content from XML, RSS, or JSON feeds into Craft  
  <https://plugins.craftcms.com/feed-me>

---

## Notes on Plugin Management

- Most plugins are installed and configured by your developer.  
- Some plugins add new options in the control panel (e.g., **SEO** tab, **Forms** tab).  
- You can usually adjust plugin settings, but **do not uninstall or update plugins without checking with your developer**—this can affect site stability.';
	    $record->save();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m251003_061613_add_pages cannot be reverted.\n";
        return false;
    }
}
