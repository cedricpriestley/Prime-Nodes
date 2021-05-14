<?php

namespace Drupal\prime_nodes\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "prime_nodes_block",
 *   admin_label = @Translation("Prime Nodes Block"),
 * )
 */
class PrimeNodesBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {

    /* $node_list = primeNodeList(); */ 
    /*  var_dump("node_list"); */
    /* exit; */
    /* return [ */
    /*   '#theme' => 'nodes_landing', */
    /*   '#node_list' => $node_list, */
    /* ]; */

    return [
      '#markup' => $this->t('This is a simple block!'),
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'access content');
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['prime_nodes_block_settings'] = $form_state->getValue('prime_nodes_block_settings');
  }
}
