<?php

namespace Drupal\prime_nodes\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Validation constraint for DateTime items to ensure the day is a prime number.
 *
 * @Constraint(
 *   id = "PrimeDay",
 *   label = @Translation("Datetime prime day constraint.", context = "Validation"),
 * )
 */
class PrimeNodesDayConstraint extends Constraint {

  /**
   * Message for when the day isn't a prime number.
   *
   * @var string
   */
  public $badDay = "The datetime value must be a prime number.";

  /**
   * Message for when the day isn't a prime number.
   *
   * @var number
   */
}
