<?php
/*
Template Name: Products
*/
get_header();   
?>

<div class="products">

  <div class="product-filter">
    <select id="product-filter-dropdown">
      <option value="default">Default</option>
      <option value="popular">Show Only Popular Products</option>
      <option value="featured">Show Only Featured Products</option>
      <option value="categories">Show Only Categories</option>
    </select>
  </div>

  <div id="product-content">
    <!-- Default content will be loaded here -->
    <?php
    // Define arguments for querying featured products
    $featured_args = array(
      'post_type' => 'product',
      'posts_per_page' => 3, // Display only 3 featured products
      'tax_query' => array(
          array(
              'taxonomy' => 'product_visibility',
              'field'    => 'name',
              'terms'    => 'featured',
              'operator' => 'IN',
          ),
      ),
    );

    // Query featured products
    $featured_products = new WP_Query( $featured_args );

    // Check if there are featured products
    if ( $featured_products->have_posts() ) :
      echo '<div class="featured-products">';
      echo '<h2>Featured Products</h2>'; // Add a heading for featured products section
      while ( $featured_products->have_posts() ) : $featured_products->the_post();
        wc_get_template_part( 'content', 'product' ); // Output product content template for featured products
      endwhile;
      echo '</div>';
    else :
      echo '<p>No featured products found</p>'; // Debugging message
    endif;

    // Reset post data
    wp_reset_postdata();
    ?>

    <?php
    // Define arguments for querying all products sorted by popularity and price high to low
    $args = array(
      'post_type' => 'product',
      'posts_per_page' => -1, // Display all products
      'meta_key' => 'total_sales', // WooCommerce meta key for sales
      'orderby' => array(
        'meta_value_num' => 'DESC', // Order by total sales (popularity)
        '_price' => 'DESC', // Order by price (high to low)
      ),
      'meta_query' => array(
          'relation' => 'AND',
          'total_sales_clause' => array(
              'key' => 'total_sales',
              'compare' => 'EXISTS',
          ),
          'price_clause' => array(
              'key' => '_price',
              'compare' => 'EXISTS',
          ),
      ),
    );

    // Query all products
    $products = new WP_Query( $args );

    // Check if there are products
    if ( $products->have_posts() ) :
      echo '<div class="all-products">';
      echo '<h2>All Products</h2>'; // Add a heading for all products section
      while ( $products->have_posts() ) : $products->the_post();
        wc_get_template_part( 'content', 'product' ); // Output product content template for all products
      endwhile;
      echo '</div>';
    else :
      echo '<p>No products found</p>'; // Debugging message
    endif;

    // Reset post data
    wp_reset_postdata();
    ?>

    <?php
    // Query product categories
    $product_categories = get_terms( 'product_cat', array(
      'orderby'    => 'name',
      'order'      => 'ASC',
      'hide_empty' => true,
    ) );

    if ( !empty( $product_categories ) && !is_wp_error( $product_categories ) ) :
      echo '<div class="product-categories">';
      echo '<h2>Product Categories</h2>'; // Add a heading for product categories section
      echo '<ul>';
      foreach ( $product_categories as $category ) {
        echo '<li>' . esc_html( $category->name ) . '</li>';
      }
      echo '</ul>';
      echo '</div>';
    else :
      echo '<p>No categories found</p>'; // Debugging message
    endif;
    ?>
  </div>

</div>

<?php get_footer(); ?>
