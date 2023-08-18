<?php

namespace Drupal\cart\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\cart\CartManagerInterface;

/**
 * Provides a 'Cart' block.
 *
 * @Block(
 *   id = "cart_block",
 *   admin_label = @Translation("Cart Block"),
 * )
 */
class CartBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The Cart Manager service.
   *
   * @var \Drupal\cart\CartManagerInterface
   */
  protected $cartManager;

  /**
   * Constructs a new CartBlock instance.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The plugin_id for the block.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\cart\CartManagerInterface $cart_manager
   *   The Cart Manager service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, CartManagerInterface $cart_manager) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->cartManager = $cart_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('cart.cart_manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Check if the user has permission to view the cart.
    if (!$this->currentUser->hasPermission('access cart')) {
      return [];
    }

    // Build and return the cart block content.
    return [
      'content' => [
        '#markup' => $this->cartManager->getCartContents(),
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access cart');
  }

}
