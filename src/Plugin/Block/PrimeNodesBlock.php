<?php

namespace Drupal\prime_nodes\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityTypeInterface;

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

    $entity_type = 'node';
    $view_mode = 'teaser';

    $entity_type_manager = \Drupal::entityTypeManager();
    $view_builder = $entity_type_manager->getViewBuilder($entity_type);
    $nids = \Drupal::entityQuery('node')->sort('created' , 'DESC')->range(0, 5)->execute();

    $prime_nids = [];
    foreach($nids as $nid) {
      if (isPrime($nid)) {
        $prime_nids[] = $nid;
      }
    }
    $storage = $entity_type_manager->getStorage($entity_type);
    $prime_nodes = $entity_type_manager->getStorage($entity_type)->loadMultiple($prime_nids);
    $build = $view_builder->view($prime_nodes, $view_mode);

    return $build;
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
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
  }

  **
    * Implements prime_nodes_entity_bundle_field_info_alter().
*/
function prime_nodes_entity_bundle_field_info_alter(&$fields, EntityTypeInterface $entity_type, $bundle) {
  if (!empty($fields['field_date'])) {
    $fields['field_date']->addConstraint('PrimeNodesDayConstraint');
  }
}
