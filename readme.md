# WordPress Trainee Boilerplate Theme

This project is built using the [Underscore Boilerplate](https://underscores.me/) starter theme by [Automattic](https://automattic.com/).

## Requirements

- **PHP** >= 8.2  
- **Node.js** >= 22  
- **Yarn**

## Project Setup

1. Navigate to the WordPress Trainee Boilerplate theme directory.
2. Install Node dependencies:

   ```bash
   yarn
   ```

  If yarn doesnot work use below command

   ```bash
   yarn install --production=false
   ```

3. Build assets:

   ```bash
   yarn build
   ```

   For development with hot reload:

   ```bash
   yarn dev
   ```

## ACF Blocks

- This theme uses `acf-block.php` file to register custom ACF blocks.
- All block definitions reside in:  
  `blocks/` folder.
- Block's PHP file resides in the `blocks` folder.
- Block's SCSS file resides in the `resources/styles/modules` folder.
- Block's JS file resides in the `resources/scripts/modules` folder.

## ACF Integration

- This theme requires the [Advanced Custom Fields Pro](https://www.advancedcustomfields.com/pro/) plugin to be installed and activated.
- The theme uses the `acf-json` folder to sync the ACF fields.
- The theme uses the `acf-block.php` file to register the ACF blocks.

## Build Output

- Compiled assets are stored in:  
  `public/assets/`

## Customization

The theme can be customized through:

- **Style Customization** `resources/styles` – SCSS and CSS files for styling

- **Script Customization** `resources/scripts` – JavaScript files

- **PHP Functionality** `functions.php` – Extends the Core WordPress Theme functionality

## Documentation

- Underscores Boilerplate: [https://underscores.me/](https://underscores.me/)
- Vite: [https://vitejs.dev/guide/](https://vitejs.dev/guide/)

### Usefull Commands ###
* `` yarn `` - to install NPM dependencies
* `` yarn dev `` - for developer instance
* `` yarn build `` - for build process

---

> Built with ❤️ using [Underscores Boilerplate](https://underscores.me/)
