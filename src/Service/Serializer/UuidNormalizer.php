<?php

namespace App\Service\Serializer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Uuid;

class UuidNormalizer implements NormalizerInterface
{
    /**
     * Normalizes an object to its string representation.
     *
     * This method is primarily designed for UUID objects, converting them to their RFC 4122 string representation.
     *
     * @param mixed $object The object to normalize. Expected to have a `toRfc4122` method.
     * @param string|null $format The format of the normalization, not used in the current implementation.
     * @param array<string, mixed|array<string, mixed>> $context Context options for the normalization process, not used in the current implementation.
     *
     * @return string The RFC 4122 string representation of the object.
     */
    public function normalize(mixed $object, string $format = null, array $context = []): string
    {
        return $object->toRfc4122();
    }

    /**
     * Checks if the provided data is supported for normalization.
     *
     * @param mixed $data The data to check for support. This could be any type, but normalization support is specifically checked for Uuid instances.
     * @param string|null $format The format for the potential normalization
     * @param array<string, mixed|array<string, mixed>> $context Context options for the normalization process, not utilized in the current implementation.
     *
     * @return bool True if the data is an instance of Uuid, false otherwise.
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Uuid;
    }
}
