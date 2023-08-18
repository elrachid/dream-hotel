<?php

namespace Drupal\cart\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the Cart Item edit forms.
 *
 * @ingroup custom_cart
 */
class CartItemForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\cart\Entity\CartItem */
    $form = parent::buildForm($form, $form_state);

    // Add custom form elements here if needed.

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $entity->save();

    // Display a message upon successful submission.
    $this->messenger()->addMessage($this->t('The cart item has been saved.'));

    $form_state->setRedirect('entity.cart_item.canonical', ['cart_item' => $entity->id()]);
  }

}
