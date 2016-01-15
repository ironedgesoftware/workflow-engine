<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Flow\Node;

use IronEdge\Component\Graphs\Node\NodeInterface;
use IronEdge\Component\WorkflowEngine\Exception\ValidationException;
use IronEdge\Component\WorkflowEngine\Flow\Token;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class Flow extends AbstractNode
{
    const TYPE                  = 'flow';


    /**
     * Initial States.
     *
     * @var array
     */
    private $_initialStates = [];


    /**
     * Returns the states found on this flow.
     *
     * @return array
     */
    public function findStates(): array
    {
        return $this->findChildren(['type' => State::TYPE]);
    }

    /**
     * Adds a token to one or more states.
     *
     * @param Token $token  - Token.
     * @param array $states - Array of states.
     *
     * @throws ValidationException
     *
     * @return Flow
     */
    public function addTokenToStates(Token $token, array $states): self
    {
        foreach ($states as $state) {
            if (!($state instanceof State)) {
                throw ValidationException::create('Each element of $states must be an instance of State.');
            }

            $state->addToken($token);
        }

        return $this;
    }

    /**
     * Getter method for field _initialStates.
     *
     * @return array
     */
    public function getInitialStates(): array
    {
        return $this->_initialStates;
    }

    /**
     * Setter method for field initialStates.
     *
     * @param array $initialStates - initialStates.
     *
     * @return self
     */
    public function setInitialStates(array $initialStates): self
    {
        $this->_initialStates = [];

        foreach ($initialStates as $state) {
            $this->addInitialState($state);
        }

        return $this;
    }

    /**
     * Adds an initial state.
     *
     * @param State $state - State.
     *
     * @return self
     */
    public function addInitialState(State $state): self
    {
        $this->_initialStates[$state->getId()] = $state;

        return $this;
    }

    /**
     * Adds a child to this node.
     *
     * @param NodeInterface $child     - Child.
     * @param bool          $setParent - Set Parent?
     *
     * @throws \IronEdge\Component\Graphs\Exception\ChildTypeNotSupportedException
     *
     * @return NodeInterface
     */
    public function addChild(NodeInterface $child, bool $setParent = true): NodeInterface
    {
        $ret = parent::addChild($child, $setParent);

        if ($child instanceof State && $child->isInitial()) {
            $this->addInitialState($child);
        }

        return $ret;
    }


}