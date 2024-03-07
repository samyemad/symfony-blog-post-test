<?php

namespace App\Service\Serializer;

interface CustomSerializerInterface
{
    /**
     * Serializes data into the specified format.
     *
     * @param mixed $data The data to serialize.
     * @param string $format The serialization format (e.g., 'json').
     * @param array<string, mixed|array<string, mixed>> $context Context options that control the serialization process.
     *
     * @return string The serialized data.
     */
    public function serialize(mixed $data, string $format = 'json', array $context = []): string;
}
