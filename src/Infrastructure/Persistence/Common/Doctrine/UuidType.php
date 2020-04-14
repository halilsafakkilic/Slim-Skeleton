<?php

namespace App\Infrastructure\Persistence\Common\Doctrine;

use App\Infrastructure\Core\Uuid\IUuid;
use App\Infrastructure\Core\Uuid\Uuid;
use Doctrine\DBAL\Types\ConversionException;
use InvalidArgumentException;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * This class is based on Ramsey\Uuid\Doctrine\ UuidType.
 *
 * @package App\Infrastructure\Persistence\Common\Doctrine
 */
class UuidType extends Type
{
    const NAME = 'uuid';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return $platform->getGuidTypeDeclarationSQL($fieldDeclaration);
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return string|IUuid|null
     * @throws ConversionException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof IUuid) {
            $value = $value->toString();
        }

        try {
            $uuid = Uuid::fromString($value);
        } catch (InvalidArgumentException $e) {
            throw ConversionException::conversionFailed($value, static::NAME);
        }

        return $uuid;
    }

    /**
     * @param mixed            $value
     * @param AbstractPlatform $platform
     *
     * @return string|null
     * @throws ConversionException
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null || $value === '') {
            return null;
        }

        if (
            $value instanceof IUuid
            || (
                (is_string($value)
                    || method_exists($value, '__toString'))
                && Uuid::isValid((string) $value)
            )
        ) {
            return (string) $value;
        }

        throw ConversionException::conversionFailed($value, static::NAME);
    }

    public function getName()
    {
        return static::NAME;
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}