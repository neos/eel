<?php
namespace TYPO3\Eel\Tests\Functional\FlowQuery\Fixtures;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "TYPO3.Eel".             *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

class ExampleFinalOperation extends \TYPO3\Eel\FlowQuery\Operations\AbstractOperation
{
    protected static $shortName = 'exampleFinalOperation';
    protected static $final = true;

    protected static $priority = 1;

    public function evaluate(\TYPO3\Eel\FlowQuery\FlowQuery $query, array $arguments)
    {
        return 'Priority 1';
    }
}
