<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Flow;

use IronEdge\Component\Graphs\Node\NodeInterface;
use IronEdge\Component\Graphs\Service as GraphsService;
use IronEdge\Component\WorkflowEngine\Exception\ValidationException;
use IronEdge\Component\WorkflowEngine\Flow\Node\AbstractNode;
use IronEdge\Component\WorkflowEngine\Flow\Node\Flow;
use IronEdge\Component\WorkflowEngine\Flow\Node\State;
use IronEdge\Component\WorkflowEngine\Flow\Node\Transition;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class Service
{
    /**
     * Graphs Service.
     *
     * @var GraphsService
     */
    private $_graphsService;



    /**
     * Service constructor.
     *
     * @param GraphsService|null $graphsService - Graphs Service.
     */
    public function __construct(GraphsService $graphsService = null)
    {
        $this->setGraphsService($graphsService);
    }

    /**
     * Returns the Graphs Service instance.
     *
     * @return GraphsService
     */
    public function getGraphsService(): GraphsService
    {
        return $this->_graphsService;
    }

    /**
     * Sets the Graphs Service.
     *
     * @param GraphsService|null $graphsService - graphsService.
     *
     * @return self
     */
    public function setGraphsService(GraphsService $graphsService = null): self
    {
        $this->_graphsService = $graphsService ?
            $graphsService :
            new GraphsService();

        $this->_graphsService->setNodeFactory([$this, 'createNodeInstance']);

        return $this;
    }

    /**
     * Imports a flow.
     *
     * @param string $readerType    - Reader Type.
     * @param array  $readerOptions - Reader options.
     *
     * @return NodeInterface
     */
    public function import(string $readerType, array $readerOptions = []): NodeInterface
    {
        return $this->getGraphsService()->import($readerType, $readerOptions);
    }

    /**
     * Creates a node instance.
     *
     * @param array $data    - Node Data.
     * @param array $options - Node Options.
     *
     * @throws ValidationException
     *
     * @return AbstractNode
     */
    public function createNodeInstance(array $data, array $options = []): AbstractNode
    {
        if (!isset($data['type'])) {
            throw ValidationException::create('Field "type" is mandatory.');
        }

        switch ($data['type']) {
            case Flow::TYPE:
                $node = new Flow($data, $options);

                break;
            case State::TYPE:
                $node = new State($data, $options);

                break;
            case Transition::TYPE:
                $node = new Transition($data, $options);

                break;
            default:
                throw ValidationException::create('Type "'.$data['type'].'" invalid.');
        }

        return $node;
    }
}