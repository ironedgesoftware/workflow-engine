<?php
/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine;

use IronEdge\Component\WorkflowEngine\Flow\Node\Flow;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
interface EngineInterface
{


    public function execute(Flow $flow, array $options = []);
}