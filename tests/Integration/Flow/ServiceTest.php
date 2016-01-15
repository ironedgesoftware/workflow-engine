<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Test\Integration\Flow;

use IronEdge\Component\WorkflowEngine\Flow\Node\Transition;
use IronEdge\Component\WorkflowEngine\Flow\Node\Flow;
use IronEdge\Component\WorkflowEngine\Flow\Node\State;
use IronEdge\Component\WorkflowEngine\Flow\Service;
use IronEdge\Component\WorkflowEngine\Test\Integration\AbstractTestCase;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class ServiceTest extends AbstractTestCase
{
    public function test_import_importsAFlow()
    {
        $service = $this->createInstance();
        $flow = $service->import(
            'array',
            [
                'data'              => [
                    'id'                => 'flow1',
                    'type'              => Flow::TYPE,
                    'name'              => 'My Flow',
                    'children'          => [
                        [
                            'id'            => 'place1',
                            'type'          => State::TYPE,
                            'name'          => 'My Place 1',
                            'parentId'      => 'transition1',
                            'children'      => [
                                [
                                    'id'            => 'transition1',
                                    'type'          => Transition::TYPE,
                                    'name'          => 'My Transition 1',
                                    'childrenIds'   => [
                                        'place1'
                                    ]
                                ],
                                [
                                    'id'            => 'transition2',
                                    'type'          => Transition::TYPE,
                                    'name'          => 'My Transition 2',
                                    'children'      => [
                                        [
                                            'id'            => 'place2',
                                            'type'          => State::TYPE,
                                            'name'          => 'My Place 2',
                                            'parentsIds'    => [
                                                'transition1'
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

        $this->assertTrue($flow instanceof Flow);
        $this->assertCount(1, $flow->getChildren());

        $place = $flow->getChild('place1');

        $this->assertEquals('place1', $place->getId());
        $this->assertCount(2, $place->getChildren());

        $transition = $place->getChild('transition1');
        $transition2 = $place->getChild('transition2');

        $this->assertEquals('transition1', $transition->getId());
        $this->assertCount(1, $transition->getChildren());
        $this->assertEquals('transition2', $transition2->getId());
        $this->assertCount(1, $transition2->getChildren());

        $place = $transition->getChild('place1');
        $place2 = $transition2->getChild('place2');

        $this->assertEquals('place1', $place->getId());
        $this->assertCount(2, $place->getChildren());

        $this->assertEquals('place2', $place2->getId());
        $this->assertCount(0, $place2->getChildren());
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