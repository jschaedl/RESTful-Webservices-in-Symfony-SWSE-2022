<?php

declare(strict_types=1);

namespace App\Tests\Controller\Workshop;

use App\Tests\ApiTestCase;

class ReadControllerTest extends ApiTestCase
{
    public function test_it_should_show_requested_workshop(): void
    {
        $this->loadFixtures([
            __DIR__.'/fixtures/read_workshop.yaml',
        ]);

        $this->browser->request('GET', '/workshops/8acf8f2b-95c1-46e1-85a4-ea6ff88081ce');

        static::assertResponseIsSuccessful();

        $this->assertMatchesJsonSnapshot($this->browser->getResponse()->getContent());
    }
}
