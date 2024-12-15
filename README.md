# Grand Prix Winterthur Wordpress Theme

## Installation

1. Download or clone this repository.
2. Upload the theme folder to your WordPress installation under `wp-content/themes/`.
3. Activate the theme via `Appearance > Themes`.

This WordPress theme requires the following WordPress plugins:

- [GenerateBlocks](https://wordpress.org/plugins/generateblocks/)
- [Masonry Image Gallery (MGB)](https://wordpress.org/plugins/mgb-masonry-image-gallery/)
- [Polylang](https://wordpress.org/plugins/polylang/)
- [SVG Support](https://wordpress.org/plugins/svg-support/)

Optional plugins for ease of use:

- [Yoast Duplicate Post](https://wordpress.org/plugins/duplicate-post/)


## User Manual

This manual provides guidance on configuring and customizing the GP Winterthur theme. Follow the instructions below to set up and manage the header, footer, pages, and multilingual support.

### Header Configuration

Header functions can be customized via:

- **Navigation Path:** `Appearance > Customize > GP Winterthur Styling > Header`

Editable elements include:

- Gradient settings
- Menu colors

Updating the Logo and Favicon can be done via:

- **Navigation Path:** `Appearance > Customize > Site Identity`


### Footer Configuration

Footer functions can be customized via:

- **Navigation Path:** `Appearance > Customize > GP Winterthur Styling > Footer`

Specific Customizations:
1. **Menus**  
   Configure via `Appearance > Menus`. Available menu options:
   - Footer Center Left
   - Footer Center Right
   - Footer Menu

2. **Footer Left Column Text**  
   Update using `Appearance > Widgets` in the **Footer Left Column** area.


### Page Editing

Pages are built using the Gutenberg Editor, offering an intuitive block-based design experience.

Key Functionalities:
- Access base blocks via:
  - **Navigation Path:** `Appearance > Patterns > GP Winterthur Blocks`

- Customizable properties for each block:
  - Paddings
  - Colors
  - Typography
  - Borders
  - Margins

- **Button Colors:** Editable directly within the Gutenberg Editor.


### Multilanguage Support (Polylang)

**Theme String Translations**
To translate theme strings (e.g., footer text) that are not directly editable via pages, menus, or widgets:
- **Navigation Path:** `Languages > Translations`

**Page Translations**
To translate a page:
1. Click the **+** icon to create the page in the secondary language.
2. Refer to the accompanying video walkthrough for detailed instructions.

**Menu Translations**
Translate menus via:
- **Navigation Path:** `Appearance > Menus`

---

## Development

### Theme Structure

Below is an overview of the theme's file structure and its purpose.

#### File Structure

##### Root-Level Files
- **`functions.php`**
  - Contains PHP functions to add theme functionality, such as enqueuing scripts/styles, registering features, and adding hooks/filters.

- **`style.css`**
  - The primary stylesheet and metadata file for the theme. This is required for the theme to function in WordPress.

- **`content-page.php`**
  - Template file for displaying individual pages with custom layout and dynamic content.

- **`footer.php`**
  - Defines the footer section, including widgets, copyright text, and closing HTML tags.

- **`screenshot.png`**
  - Preview image of the theme, displayed in the WordPress admin under Appearance > Themes.

##### Directories

- **`inc/`**
  - Contains modular PHP files to organize and structure the theme functionality:
  - **`structure/`**
    - Contains files for structural elements of the theme.
    - **`header.php`**: Defines the layout and functionality of the header, including the navigation menu and logo.

- **`patterns/`**
  - Contains Gutenberg block patterns as JSON files for reusable layouts

- **`css/`**
  - Contains custom stylesheets for the theme:
  - **`editor-style.css`**: Styles for the WordPress block editor, ensuring consistency with the front-end design.

- **`images/`**
  - Holds theme-specific images, such as logos and placeholders.

- **`js/`**
  - Contains JavaScript files for theme functionality:
  - **`scroll-menu.js`**: Implements scroll-based menu features, such as sticky headers or smooth navigation.

- **`fonts/`**
  - Stores custom font files used within the theme.



### Customization

#### Create Patterns

Use the following pattern template when creating a new pattern

```
{
  "__file": "wp_block",
  "title": "GPW Pattern Name",
  "content":"<!-- PATTERN CONTENT  -->",
  "syncStatus": "unsynced"
}
```

Open `python3` and type `import json`, then use the following code to create a python dictionary from this pattern:
```
rawpattern = '''<PASTE RAW PATTERN>'''
pattern = json.loads(rawpattern)
```

Now, copy any Gutenberg Block Pattern code you would like to have as a pattern and print the pattern in a pretty-printed JSON:
```
data = '''<PASTE GUTENBERG BLOCK>'''
pattern["content"] = data
print(json.dumps(pattern, separators=(',', ':'),indent=4))
```

Store the printed output in a new pattern file e.g. `gpw-pattern-name.json` and move it to the pattern directory.

