# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is the **GP Winterthur** WordPress child theme for the Grand Prix Winterthur running event website. It extends the GeneratePress parent theme and uses GenerateBlocks for layout components.

## Deployment

Sync the theme to the remote WordPress installation:
```bash
./sync-theme.sh
```
This uses rsync to deploy `gp-winterthur/` to the remote server at `winterthur-marathon.ch`.

## Architecture

### Theme Structure
All theme files reside in `gp-winterthur/`:
- `functions.php` - Core functionality: customizer settings, menu registration, widget areas, Polylang string registration, block pattern loading
- `style.css` - Primary stylesheet with theme metadata, custom fonts (ABCFavorit), and all component styles
- `footer.php` - Custom footer with gradient, sponsor logos, social media, and menus
- `css/editor-style.css` - Gutenberg block editor styles
- `js/scroll-menu.js` - Custom menu behavior (replaces GeneratePress default menu script)
- `patterns/*.json` - Reusable Gutenberg block patterns

### Key Components
- **Customizer Integration**: Header and footer colors/gradients are configurable via `Appearance > Customize > GP Winterthur Styling`
- **Menu Locations**: Primary menu, Footer Menu, Footer Center Left/Right, Header Mobile Menu
- **Widget Areas**: Footer Left Column, Footer Sponsors
- **Block Patterns**: Located in `patterns/` as JSON files, auto-loaded on init

### Color Palette
- Dark Forest: `#004B50` (primary dark)
- Lime: `#D3FFB4` (accent light)
- Periwinkle: `#A6B1F1` (secondary accent)

### Dependencies
Required plugins: GenerateBlocks, Polylang, SVG Support, Masonry Image Gallery (MGB)

## Creating Block Patterns

1. In the Gutenberg editor, select blocks and create a pattern
2. Export the pattern as JSON via "Manage Patterns"
3. Move the JSON file to `gp-winterthur/patterns/`
4. Delete the pattern from WordPress admin

Patterns are auto-registered with the category prefix `childtheme/`.

## Full-Width Backgrounds

Content is constrained to 1440px max-width, but backgrounds extend to full viewport width using pseudo-elements.

**When adding a new content block class**, you must:
1. Add `position: relative` to the block's CSS
2. Add the class to the `::before` pseudo-element rule in the "FULL-WIDTH BACKGROUNDS" section at the end of `style.css`

**Currently supported blocks:**
`.text-wide`, `.text-columns`, `.callout-action`, `.header-color-transition`, `.header-wide`, `.image-columns`, `.image-wide`, `.gallery-wide`, `..wp-block-embed-vimeo`, `.footer-color-transition`

**Excluded:** `.color-transition` (uses transparency to blend with teaser image, which is already full-width)

**Body background**: `#A6B1F1` (matches footer gradient end color for seamless transitions)
