<?php

namespace OpenTracing\Exceptions;

use InvalidArgumentException;

/**
 * Thrown when passing an invalid argument for a reference
 */
final class InvalidReferenceArgument extends InvalidArgumentException
{
    /**
     * @return InvalidReferenceArgument
     */
    public static function forEmptyType()
    {
        return new self('Reference type can not be an empty string');
    }

    /**
     * @param mixed $context
     * @return InvalidReferenceArgument
     */
    public static function forInvalidContext($context)
    {
        return new self(sprintf(
            'Reference expects \OpenTracing\Span or \OpenTracing\SpanContext as context, got %s',
            is_object($context) ? get_class($context) : gettype($context)
        ));
    }
}
