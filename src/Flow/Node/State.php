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
class State extends AbstractNode
{
    const TYPE                  = 'state';


    /**
     * Is this node an initial state?
     *
     * @return boolean
     */
    public function isInitial(): bool
    {
        return $this->getMetadataAttr('isInitial');
    }

    /**
     * Is this node an initial state?
     *
     * @param boolean $isInitialState - isInitialState.
     *
     * @return self
     */
    public function setIsInitialState(bool $isInitial): self
    {
        $this->setMetadataAttr('isInitial', $isInitial);

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

        return $child instanceof Transition;
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

        return $parent instanceof Transition || $parent instanceof Flow;
    }

    /**
     * Returns default metadata.
     *
     * @return array
     */
    public function getDefaultMetadata(): array
    {
        return array_replace_recursive(
            parent::getDefaultMetadata(),
            [
                'isInitial'         => false
            ]
        );
    }


}