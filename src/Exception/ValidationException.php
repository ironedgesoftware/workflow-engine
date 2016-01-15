<?php

/*
 * This file is part of the workflow-engine package.
 *
 * (c) Gustavo Falco <comfortablynumb84@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IronEdge\Component\WorkflowEngine\Exception;


/*
 * @author Gustavo Falco <comfortablynumb84@gmail.com>
 */
class ValidationException extends BaseException
{
    public static function create($msg)
    {
        return new self($msg);
    }
}