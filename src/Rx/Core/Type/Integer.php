<?php declare(strict_types=1);

namespace Rx\Core\Type;

use Rx\Core\TypeInterface;
use Rx\{
    Rx, 
    Util
};
use Rx\Exception\{
    InvalidParamTypeException, 
    CheckFailedException
};

/**
 * Can't use Int as class name
 */
class Integer extends Num implements TypeInterface
{

    const URI = 'tag:codesimply.com,2008:rx/core/int';
    const TYPE = '//int';

    public function __construct(\stdClass $schema, Rx $rx, ?string $propName = null)
    {

        if (isset($schema->value)) {
            if (is_float($schema->value) && $schema->value != floor($schema->value)) {
                throw new InvalidParamTypeException(sprintf('The `value` for %s %s is not an int.', Util::formatPropName($this->propName), static::TYPE));
            }
        }

        parent::__construct($schema, $rx, $propName);

    }

    public function check($value): bool
    {

        if (is_float($value) && $value != floor($value)) {
            throw new CheckFailedException(sprintf('Value for %s is not of type %s.', Util::formatPropName($this->propName), static::TYPE));
        }

        return parent::check($value);

    }

}