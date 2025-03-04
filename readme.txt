Technical Test Submission: Product of the Day (POTD)

Overview

This submission consists of a custom WordPress theme and a plugin implementing a Product of the Day feature. The solution includes:

A custom WordPress theme with dynamic content and category-based banners.

A WordPress plugin that allows managing products and selecting a daily featured product.

Admin settings page for customizing the block title and setting up email reports.

Click tracking system to measure product engagement.

Frontend and backend integrations to display products and manage them efficiently.

Implemented Features

1. Custom WordPress Theme

File location: /wp-content/themes/orchard_theme/

Key features:

Dynamic menu (header.php), configured through WordPress Admin.

Custom post display with category-based banners (index.php).

Individual product pages (single-product.php).

Styles for a clean and modern look (style.css).

How to test:

Activate the theme via WordPress Admin > Appearance > Themes.

Add menu items via Appearance > Menus.

Visit /all-products/ to see the full product list.

Click on a product to view its details.

2. Product of the Day Plugin

File location: /wp-content/plugins/product-of-the-day/

Key features:

Custom post type (product) for adding products.

Metabox to mark up to 5 products as “Product of the Day.”

Shortcode [product_of_the_day] to display a random daily product.

AJAX click tracking system to log views.

Admin settings page for customization.

How to test:

Activate the plugin via WordPress Admin > Plugins.

Go to Admin > Products to create new products.

Mark products as "Product of the Day" when editing.

Add [product_of_the_day] to any page or widget to display a featured product.

Click “View Product” and check Products > Clicks Column to see engagement.

3. Click Tracking System

Stored in: wp_postmeta under _potd_clicks.

Implemented via AJAX: Tracks clicks on the “View Product” button.

Admin integration: Clicks are displayed in Products > Clicks Column.

How to test:

Open the Product of the Day page with [product_of_the_day].

Click the “View Product” button.

The credentials are hoing to be shared by email.

