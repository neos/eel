<?php
namespace TYPO3\Eel\Tests\Unit;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Eel".             *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Eel\InterpretedEvaluator;

/**
 * Interpreted evaluator test
 */
class InterpretedEvaluatorTest extends AbstractEvaluatorTest
{
    /**
     * @return \TYPO3\Eel\Context
     */
    protected function createEvaluator()
    {
        return new InterpretedEvaluator();
    }
}
