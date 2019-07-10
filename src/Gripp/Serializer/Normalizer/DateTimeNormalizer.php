<?php

/*
 * This file is part of the Gripp package.
 *
 * (c) Noud de Brouwer <noud4@home.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Gripp\Serializer\Normalizer;

use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizes an object implementing the {@see \DateTimeInterface} to a date array.
 * Denormalizes a date array to an instance of {@see \DateTime} or {@see \DateTimeImmutable}.
 *
 * @author Noud de Brouwer <noud4@home.nl>
 */
class DateTimeNormalizer implements NormalizerInterface, DenormalizerInterface, CacheableSupportsMethodInterface
{
    const FORMAT_KEY = 'date';
    const TIMEZONE_TYPE = 'timezone_type';
    const TIMEZONE_KEY = 'timezone';
    
    private $defaultContext;
    
    private static $supportedTypes = [
        \DateTimeInterface::class => true,
        \DateTimeImmutable::class => true,
        \DateTime::class => true,
    ];
    
    /**
     * @param array $defaultContext
     */
    public function __construct($defaultContext = [], \DateTimeZone $timezone = null)
    {
        $this->defaultContext = [
            self::FORMAT_KEY => 'Y-m-d H:i:s.u',
            self::TIMEZONE_KEY => null,
        ];
        
        if (!\is_array($defaultContext)) {
            @trigger_error('Passing configuration options directly to the constructor is deprecated since Symfony 4.2, use the default context instead.', E_USER_DEPRECATED);
            $defaultContext = [self::FORMAT_KEY => (string) $defaultContext];
            $defaultContext[self::TIMEZONE_KEY] = $timezone;
        }
        
        $this->defaultContext = array_merge($this->defaultContext, $defaultContext);
    }
    
    /**
     * {@inheritdoc}
     *
     * @throws InvalidArgumentException
     */
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$object instanceof \DateTimeInterface) {
            throw new InvalidArgumentException('The object must implement the "\DateTimeInterface".');
        }
        
        $dateTimeFormat = $context[self::FORMAT_KEY] ?? $this->defaultContext[self::FORMAT_KEY];
        $timezone = $this->getTimezone($context);
        
        if (null !== $timezone) {
            $object = [
                self::FORMAT_KEY => $dateTimeFormat,
                self::TIMEZONE_TYPE => 3,   // @TODO name it
                self::TIMEZONE_KEY => $timezone,
            ];
        }
        
        return $object;
    }
    
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \DateTimeInterface;
    }
    
    /**
     * {@inheritdoc}
     *
     * @throws NotNormalizableValueException
     */
    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $dateTimeFormat = $context[self::FORMAT_KEY] ?? null;
        $dateTimeFormat = 'Y-m-d H:i:s.u';  // @TODO fix this
        $timezone = new \DateTimeZone($data[self::TIMEZONE_KEY]);
        
        if ('' === $data || null === $data) {
            throw new NotNormalizableValueException('The data is either an empty string or null, you should pass a string that can be parsed with the passed format or a valid DateTime string.');
        }

        $data = $data[self::FORMAT_KEY];
        if (null !== $dateTimeFormat) {
            $object = \DateTime::class === $class ? \DateTime::createFromFormat($dateTimeFormat, $data, $timezone) : \DateTimeImmutable::createFromFormat($dateTimeFormat, $data, $timezone);
            
            if (false !== $object) {
                return $object;
            }
            
            $dateTimeErrors = \DateTime::class === $class ? \DateTime::getLastErrors() : \DateTimeImmutable::getLastErrors();

            throw new NotNormalizableValueException(sprintf(
                'Parsing datetime string "%s" using format "%s" resulted in %d errors:'."\n".'%s',
                $data,
                $dateTimeFormat,
                $dateTimeErrors['error_count'],
                implode("\n", $this->formatDateTimeErrors($dateTimeErrors['errors']))
                ));
        }
        
        try {
            return \DateTime::class === $class ? new \DateTime($data, $timezone) : new \DateTimeImmutable($data, $timezone);
        } catch (\Exception $e) {
            throw new NotNormalizableValueException($e->getMessage(), $e->getCode(), $e);
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return isset(self::$supportedTypes[$type]);
    }
    
    /**
     * {@inheritdoc}
     */
    public function hasCacheableSupportsMethod(): bool
    {
        return __CLASS__ === \get_class($this);
    }
    
    /**
     * Formats datetime errors.
     *
     * @return string[]
     */
    private function formatDateTimeErrors(array $errors)
    {
        $formattedErrors = [];
        
        foreach ($errors as $pos => $message) {
            $formattedErrors[] = sprintf('at position %d: %s', $pos, $message);
        }
        
        return $formattedErrors;
    }
    
    private function getTimezone(array $context)
    {
        $dateTimeZone = $context[self::TIMEZONE_KEY] ?? $this->defaultContext[self::TIMEZONE_KEY];
        
        if (null === $dateTimeZone) {
            return null;
        }
        
        return $dateTimeZone instanceof \DateTimeZone ? $dateTimeZone : new \DateTimeZone($dateTimeZone);
    }
}
