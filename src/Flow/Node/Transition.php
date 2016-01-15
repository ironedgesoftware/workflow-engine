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

/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class Transition extends AbstractNode
{
    const TYPE                  = 'transition';



    /**
     * Getter method for field _componentId.
     *
     * @return string
     */
    public function getComponentId(): string
    {
        return $this->getMetadataAttr('componentId');
    }

    /**
     * Setter method for field componentId.
     *
     * @param string $componentId - componentId.
     *
     * @return self
     */
    public function setComponentId(string $componentId): self
    {
        $this->setMetadataAttr('componentId', $componentId);

        return $this;
    }

    /**
     * Method supportsChild.
     *
     * @param NodeInterface $child - Child.
     *
     * @return bool
     */
    public function supportsChild(NodeInterface $child): bool
    {
        parent::supportsChild($child);

        return $child instanceof State || $child instanceof Flow;
    }

    /**
     * Method supportsParent.
     *
     * @param NodeInterface $parent - Parent.
     *
     * @return bool
     */
    public function supportsParent(NodeInterface $parent): bool
    {
        parent::supportsParent($parent);

        return $parent instanceof State || $parent instanceof Flow;
    }
}