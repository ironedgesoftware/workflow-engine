<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Flow\Instance;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
use IronEdge\Component\WorkflowEngine\Flow\Node\Flow;
use IronEdge\Component\WorkflowEngine\Flow\Node\State;
use IronEdge\Component\WorkflowEngine\Flow\Token;
use IronEdge\Component\WorkflowEngine\Flow\Service as FlowService;

class Service
{
    /**
     * Field _flowService.
     *
     * @var FlowService
     */
    private $_flowService;


    /**
     * Service constructor.
     *
     * @param FlowService|null $flowService - Flow Service.
     */
    public function __construct(FlowService $flowService = null)
    {
        if ($flowService === null) {
            $flowService = new FlowService();
        }

        $this->setFlowService($flowService);
    }

    /**
     * Returns the flow service used by this instance service.
     *
     * @return FlowService
     */
    public function getFlowService(): FlowService
    {
        return $this->_flowService;
    }

    /**
     * Sets the flow service used by this instance service.
     *
     * @param FlowService $flowService - flowService.
     *
     * @return self
     */
    public function setFlowService(FlowService $flowService): self
    {
        $this->_flowService = $flowService;

        return $this;
    }

    /**
     * Imports a flow and creates an instance of it.
     *
     * @param string $readerType    - Reader type.
     * @param array  $readerOptions - Reader options.
     * @param array  $options       - Create options.
     *
     * @return Instance
     */
    public function createFromImportedFlow(string $readerType, array $readerOptions = [], array $options = []): Instance
    {
        /** @var Flow $flow */
        $flow = $this->getFlowService()->import($readerType, $readerOptions);

        return $this->create($flow, $options);
    }

    /**
     * Creates an instance of a Flow.
     *
     * @param Flow  $flow    - Flow.
     * @param array $options - Options.
     *
     * @return Instance
     */
    public function create(Flow $flow, array $options = []): Instance
    {
        $options = array_replace_recursive(
            [
                'tokenInitialData'          => [],
                'tokenInitialOptions'       => []
            ],
            $options
        );

        $tokens = [];

        /** @var State $state */
        foreach ($flow->getInitialStates() as $state) {
            $token = $this->createToken($options['tokenInitialData'], $options['tokenInitialOptions']);

            $state->addToken($token);

            $tokens[] = $token;
        }

        return new Instance($flow, $tokens);
    }

    /**
     * Method createToken.
     *
     * @param array $data    - Token data.
     * @param array $options - Token options.
     *
     * @return Token
     */
    public function createToken(array $data = [], array $options = []): Token
    {
        return new Token($data, $options);
    }
}