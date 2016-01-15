<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Test\Integration\Flow\Instance;

use IronEdge\Component\WorkflowEngine\Flow\Instance\Instance;
use IronEdge\Component\WorkflowEngine\Flow\Instance\Service;
use IronEdge\Component\WorkflowEngine\Flow\Node\Transition;
use IronEdge\Component\WorkflowEngine\Flow\Node\Flow;
use IronEdge\Component\WorkflowEngine\Flow\Node\State;
use IronEdge\Component\WorkflowEngine\Flow\Token;
use IronEdge\Component\WorkflowEngine\Test\Integration\AbstractTestCase;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class ServiceTest extends AbstractTestCase
{
    public function test_createFromImportedFlow_importsAFlowAndCreatesAnInstance()
    {
        $service = $this->createInstance();
        $instance = $service->createFromImportedFlow(
            'array',
            [
                'data'              => [
                    'id'                => 'flow1',
                    'type'              => Flow::TYPE,
                    'name'              => 'My Flow',
                    'children'          => [
                        [
                            'id'            => 'state1',
                            'type'          => State::TYPE,
                            'name'          => 'My State 1',
                            'metadata'      => [
                                'isInitial'     => true
                            ],
                            'parentId'      => 'component1',
                            'children'      => [
                                [
                                    'id'            => 'component1',
                                    'type'          => Transition::TYPE,
                                    'name'          => 'My Component 1',
                                    'childrenIds'   => [
                                        'state1'
                                    ]
                                ],
                                [
                                    'id'            => 'component2',
                                    'type'          => Transition::TYPE,
                                    'name'          => 'My Component 2',
                                    'children'      => [
                                        [
                                            'id'            => 'state2',
                                            'type'          => State::TYPE,
                                            'name'          => 'My State 2',
                                            'parentsIds'    => [
                                                'component1'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );

        $this->assertTrue($instance instanceof Instance);
        $this->assertCount(1, $instance->getTokens());

        /** @var Token $token */
        $token = $instance->getTokens()[0];

        $this->assertEquals($instance->getFlow()->getNode('state1'), $token->getNode());
    }


    // Helper Methods

    /**
     * Method createInstance.
     *
     * @return Service
     */
    public function createInstance()
    {
        return new Service();
    }
}