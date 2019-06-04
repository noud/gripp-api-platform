<?php

namespace App\Tests\Service;

use App\Service\CacheService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

final class CacheServiceTest extends KernelTestCase
{
    const KEY = 'test_key';
    const VALUES = ['id' => 1, 'name' => 'eerste item'];

    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        parent::setUp();
        self::bootKernel();
        $this->cacheService = self::$container->get(CacheService::class);
    }

    /**
     * Test Item in Cache.
     */
    public function testInCache(): void
    {
        $this->cacheService->saveToCache(self::KEY, self::VALUES);
        $item = $this->cacheService->getFromCache(self::KEY);

        $this->assertSame($item, self::VALUES);
    }

    /**
     * Test Item deleted from Cache.
     */
    public function testDeleteCache(): void
    {
        $this->cacheService->saveToCache(self::KEY, self::VALUES);
        $this->cacheService->deleteCacheByKey(self::KEY);
        $item = $this->cacheService->getFromCache(self::KEY);

        $this->assertFalse($item);
    }
}
