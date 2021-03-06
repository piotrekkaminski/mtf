<?php
/**
 * {license_notice}
 *
 * @copyright   {copyright}
 * @license     {license_link}
 */

namespace Mtf\Constraint;

/**
 * Interface for Constraint classes
 *
 * @api
 */
interface ConstraintInterface
{
    /**
     * Set DI Arguments to Constraint
     *
     * @param array $arguments
     * @return void
     */
    public function configure(array $arguments = []);
}
