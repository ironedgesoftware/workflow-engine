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

class Instance
{
    /**
     * Flow.
     *
     * @var Flow
     */
    private $_flow;

    /**
     * Tokens found on this instance.
     *
     * @var array
     */
    private $_tokens = [];

    /**
     * This instance was created at this date time.
     *
     * @var \DateTime
     */
    private $_createdAt;

    /**
     * This instance was updated at this date time.
     *
     * @var \DateTime
     */
    private $_updatedAt;


    /**
     * Instance constructor.
     *
     * @param Flow      $flow      - Flow.
     * @param array     $tokens    - Tokens.
     * @param \DateTime $createdAt - Created at.
     * @param \DateTime $updatedAt - Updated at.
     */
    public function __construct(Flow $flow, array $tokens, \DateTime $createdAt = null, \DateTime $updatedAt = null)
    {
        $this->_flow = $flow;
        $this->_tokens = $tokens;

        if ($createdAt === null) {
            $createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
        }

        if ($updatedAt === null) {
            $updatedAt = clone $createdAt;
        }

        $this->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }

    /**
     * Returns the Flow of this instance.
     *
     * @return Flow
     */
    public function getFlow(): Flow
    {
        return $this->_flow;
    }

    /**
     * Returns the date time on which this instance was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->_createdAt;
    }

    /**
     * Sets the date time on which this instance was created.
     *
     * @param \DateTime $createdAt - createdAt.
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->_createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns the date time on which this instance was updated.
     *
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->_updatedAt;
    }

    /**
     * Sets the date time on which this instance was updated.
     *
     * @param \DateTime $updatedAt - updatedAt.
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->_updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Returns the tokens of this instance.
     *
     * @return array
     */
    public function getTokens(): array
    {
        return $this->_tokens;
    }
}