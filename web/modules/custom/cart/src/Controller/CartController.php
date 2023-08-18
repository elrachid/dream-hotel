<?php

namespace Drupal\cart\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Provides route responses for the Cart module.
 */
class CartController extends ControllerBase {

  /**
   * Displays the cart page.
   */
  public function cartPage() {
    // Build your cart page content here.
    $content = '<p>This is the cart page content.</p>';

    return new Response($content);
  }

}
