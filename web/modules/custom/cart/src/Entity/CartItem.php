<?php

namespace Drupal\cart\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the Cart Item entity.
 *
 * @ContentEntityType(
 *   id = "cart_item",
 *   label = @Translation("Cart Item"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\cart\Entity\Controller\CartItemListViewBuilder",
 *     "form" = {
 *       "default" = "Drupal\cart\Form\CartItemForm",
 *       "add" = "Drupal\cart\Form\CartItemForm",
 *       "edit" = "Drupal\cart\Form\CartItemForm",
 *       "delete" = "Drupal\cart\Form\CartItemDeleteForm",
 *     },
 *     "access" = "Drupal\cart\Entity\CartItemAccessControlHandler",
 *   },
 *   base_table = "cart_item",
 *   admin_permission = "administer cart item entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "bundle" = "bundle",
 *     "label" = "label",
 *     "uid" = "uid",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/cart-item/{cart_item}",
 *     "add-form" = "/cart-item/add",
 *     "edit-form" = "/cart-item/{cart_item}/edit",
 *     "delete-form" = "/cart-item/{cart_item}/delete",
 *     "collection" = "/cart-item/list",
 *   }
 * )
 */
class CartItem extends ContentEntityBase implements CartItemInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;
  use EntityOwnerTrait;

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Quantity field.
    $fields['quantity'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Quantity'))
      ->setDescription(t('The quantity of items in the cart.'))
      ->setDefaultValue(1)
      ->setRequired(TRUE);

    // Room reference field.
    $fields['room_reference'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Room Reference'))
      ->setDescription(t('Reference to the room being added to the cart.'))
      ->setSetting('target_type', 'node')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getQuantity() {
    return $this->get('quantity')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getRoomReference() {
    return $this->get('room_reference')->entity;
  }

}
