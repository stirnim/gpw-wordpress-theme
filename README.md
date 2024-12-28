# Grand Prix Winterthur Wordpress Theme

## Installation

1. Download or clone this repository.
2. Upload the theme folder to your WordPress installation under `wp-content/themes/`.
3. Activate the theme via `Appearance > Themes`.

This WordPress theme requires the following WordPress themes:
- [GeneratePress](https://de-ch.wordpress.org/themes/generatepress/)

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

2. **Footer Sponsor Logos**  
   Update using `Appearance > Widgets` in the **Footer Sponsors** area.

3. **Footer Left Column Text**  
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

1. Edit a page and select a number of blocks you would like to store as a pattern
2. Click on the three dots and select "Create Pattern"
3. Click again on the three dots and select "Manage Patterns"
4. Select the created pattern and on then select the action "Export as JSON"
5. Move the JSON file to the pattern directory
6. Remove the pattern in the "Manage Patterns" section

