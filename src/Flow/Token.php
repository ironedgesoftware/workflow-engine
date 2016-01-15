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

use IronEdge\Component\CommonUtils\Data\Data;
use IronEdge\Component\WorkflowEngine\Flow\Node\AbstractNode;

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class Token extends Data
{
    /**
     * ID sequence.
     *
     * @var int
     */
    private static $idSequence = 0;

    /**
     * ID.
     *
     * @var string
     */
    private $_id;

    /**
     * Node in which this token is actually living.
     *
     * @var AbstractNode
     */
    private $_node;

    /**
     * When this token was created.
     *
     * @var \DateTime
     */
    private $_createdAt;

    /**
     * When this token was last updated.
     *
     * @var \DateTime
     */
    private $_lastUpdateAt;


    /**
     * Token constructor.
     *
     * @param array $data    - Data.
     * @param array $options - Options.
     */
    public function __construct(array $data, array $options)
    {
        parent::__construct($data, $options);

        $this->_id = self::$idSequence++;
    }

    /**
     * ID field.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }

    /**
     * Setter method for field id.
     *
     * @param string $id - id.
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->_id = $id;

        return $this;
    }

    /**
     * Returns the node on which this token is living.
     *
     * @return AbstractNode
     */
    public function getNode(): AbstractNode
    {
        return $this->_node;
    }

    /**
     * Sets the node on which this token is living.
     *
     * @param AbstractNode $node - node.
     *
     * @return self
     */
    public function setNode(AbstractNode $node): self
    {
        $this->_node = $node;

        return $this;
    }

    /**
     * Returns the date and time on which this node was created.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->_createdAt;
    }

    /**
     * Sets the date and time on which this node was created.
     *
     * @param \DateTime $createdAt - createdAt.
     *
     * @return Token
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->_createdAt = $createdAt;

        return $this;
    }

    /**
     * Returns the date and time on which this node was last updated.
     *
     * @return \DateTime
     */
    public function getLastUpdateAt(): \DateTime
    {
        return $this->_lastUpdateAt;
    }

    /**
     * Sets the date and time on which this node was last updated.
     *
     * @param \DateTime $lastUpdateAt - lastUpdateAt.
     *
     * @return self
     */
    public function setLastUpdateAt(\DateTime $lastUpdateAt): self
    {
        $this->_lastUpdateAt = $lastUpdateAt;

        return $this;
    }
}