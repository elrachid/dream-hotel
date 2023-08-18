<?php

namespace Drupal\cart\Entity;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface for defining Cart Item entities.
 */
interface CartItemInterface extends ContentEntityInterface {

  /**
   * Gets the quantity of items in the cart item.
   *
   * @return int
   *   The quantity of items.
   */
  public function getQuantity();

  /**
   * Gets the referenced room entity.
   *
   * @return \Drupal\node\NodeInterface|null
   *   The referenced room entity, or NULL if not set.
   */
  public function getRoomReference();

}
