<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Tests;

use BrokeYourBike\ZenithGhana\Interfaces\ConfigInterface;
use BrokeYourBike\ZenithGhana\Client;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;
use BrokeYourBike\HasSourceModel\HasSourceModelTrait;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class ClientTest extends TestCase
{
    /** @test */
    public function it_implemets_http_client_interface(): void
    {
        /** @var ConfigInterface */
        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();

        /** @var \GuzzleHttp\ClientInterface */
        $mockedHttpClient = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)->getMock();

        $client = new Client($mockedConfig, $mockedHttpClient);

        $this->assertInstanceOf(HttpClientInterface::class, $client);
        $this->assertSame($mockedConfig, $client->getConfig());
    }

    /** @test */
    public function it_uses_http_client_trait(): void
    {
        $usedTraits = class_uses(Client::class);

        $this->assertArrayHasKey(HttpClientTrait::class, $usedTraits);
    }

    /** @test */
    public function it_uses_has_source_model_trait(): void
    {
        $usedTraits = class_uses(Client::class);

        $this->assertArrayHasKey(HasSourceModelTrait::class, $usedTraits);
    }

    /** @test */
    public function it_can_resolve_url(): void
    {
        $this->assertSame('https://example.com/api/v2/ZTransfer/GetTransactionStatus', rtrim('https://example.com/api'). '/v2/ZTransfer/GetTransactionStatus');
        $this->assertSame('https://example.com/api/v2/ZTransfer/GetTransactionStatus', rtrim('https://example.com/api/') . 'v2/ZTransfer/GetTransactionStatus');
    }
}
