# Grand Prix Winterthur Wordpress Theme

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

### Create Patterns

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

