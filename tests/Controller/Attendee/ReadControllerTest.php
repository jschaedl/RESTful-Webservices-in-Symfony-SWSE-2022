<?php

declare(strict_types=1);

namespace App\Tests\Controller\Attendee;

use App\Tests\ApiTestCase;

class ReadControllerTest extends ApiTestCase
{
    public function provideHttpAcceptHeaderValues(): \Generator
    {
        yield 'json' => ['application/json'];
        yield 'hal+json' => ['application/hal+json'];
    }

    /**
     * @dataProvider provideHttpAcceptHeaderValues
     */
    public function test_it_should_show_requested_attendee(string $httpAcceptHeaderValue): void
    {
        $this->loadFixtures([
            __DIR__.'/fixtures/read_attendee.yaml',
        ]);

        $this->browser->request('GET', '/attendees/17058af8-1b0f-4afe-910d-669b4bd0fd26', [], [], [
            'HTTP_ACCEPT' => $httpAcceptHeaderValue,
        ]);

        static::assertResponseIsSuccessful();

        $this->assertMatchesJsonSnapshot($this->browser->getResponse()->getContent());
    }
}
