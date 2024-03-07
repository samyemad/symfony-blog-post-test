<?php

namespace App\Service\Serializer;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class CustomSerializer implements CustomSerializerInterface
{
    private Serializer $serializer;

    public function __construct()
    {
        $this->serializer = $this->configureSerializer();
    }


    /**
     * Serializes data into the specified format.
     *
     * @param mixed $data The data to serialize.
     * @param string $format The serialization format (e.g., 'json').
     * @param array<string, mixed|array<string, mixed>> $context Context options that control the serialization process.
     *
     * @return string The serialized data.
     */
    public function serialize(mixed $data, string $format = 'json', array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    private function configureSerializer(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => fn ($object) => $object->getId(),
        ];

        $objectNormalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null, // name converter
            null, // property accessor
            null, // property type extractor
            null, // property info extractor
            null, // property list extractor
            $defaultContext
        );

        $normalizers = [
            new UuidNormalizer(),
            $objectNormalizer,
            new DateTimeNormalizer(),
        ];

        $encoders = [new JsonEncoder()];

        return new Serializer($normalizers, $encoders);
    }
}
