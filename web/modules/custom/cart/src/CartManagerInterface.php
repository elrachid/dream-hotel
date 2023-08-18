<?php

namespace Drupal\cart;

/**
 * Interface for managing cart-related operations.
 */
interface CartManagerInterface {

  /**
   * Get the contents of the cart.
   *
   * @return string
   *   The cart contents.
   */
  public function getCartContents();

}
