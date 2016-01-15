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

use IronEdge\Component\Graphs\Node\Node as BaseNode;
use IronEdge\Component\WorkflowEngine\Flow\Token;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
abstract class AbstractNode extends BaseNode
{
    /**
     * Root Flow owner of this node.
     *
     * @var Flow
     */
    private $_rootFlow;

    /**
     * Tokens set on this node.
     *
     * @var array
     */
    private $_tokens = [];



    /**
     * Getter method for field _rootFlow.
     *
     * @return Flow
     */
    public function getRootFlow(): Flow
    {
        return $this->_rootFlow;
    }

    /**
     * Setter method for field rootFlow.
     *
     * @param Flow $rootFlow - rootFlow.
     *
     * @return self
     */
    public function setRootFlow($rootFlow): self
    {
        $this->_rootFlow = $rootFlow;

        return $this;
    }

    /**
     * Getter method for field _tokens.
     *
     * @return array
     */
    public function getTokens(): array
    {
        return $this->_tokens;
    }

    /**
     * Setter method for field tokens.
     *
     * @param array $tokens - tokens.
     *
     * @return self
     */
    public function setTokens(array $tokens): self
    {
        $this->clearTokens();

        foreach ($tokens as $token) {
            $this->addToken($token);
        }

        return $this;
    }

    /**
     * Adds a token to this node.
     *
     * @param Token $token - Token.
     *
     * @return self
     */
    public function addToken(Token $token): self
    {
        $this->_tokens[$token->getId()] = $token;

        $token->setNode($this);

        return $this;
    }

    /**
     * Clears the tokens found on this node.
     *
     * @return self
     */
    public function clearTokens(): self
    {
        $this->_tokens = [];

        return $this;
    }

}