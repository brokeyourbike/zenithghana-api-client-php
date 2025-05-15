<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Tests;

use Psr\SimpleCache\CacheInterface;
use Psr\Http\Message\ResponseInterface;
use BrokeYourBike\ZenithGhana\Responses\PayoutResponse;
use BrokeYourBike\ZenithGhana\Interfaces\TransactionInterface;
use BrokeYourBike\ZenithGhana\Interfaces\ConfigInterface;
use BrokeYourBike\ZenithGhana\Enums\TransferTypeEnum;
use BrokeYourBike\ZenithGhana\Enums\TransactionStatusEnum;
use BrokeYourBike\ZenithGhana\Client;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class PayoutTest extends TestCase
{
    /** @test */
    public function it_can_prepare_request(): void
    {
        $transaction = $this->getMockBuilder(TransactionInterface::class)->getMock();
        $transaction->method('getTransferType')->willReturn(TransferTypeEnum::BANK);

        /** @var TransactionInterface $transaction */
        $this->assertInstanceOf(TransactionInterface::class, $transaction);

        $mockedConfig = $this->getMockBuilder(ConfigInterface::class)->getMock();
        $mockedConfig->method('getUrl')->willReturn('https://api.example/');

        $mockedResponse = $this->getMockBuilder(ResponseInterface::class)->getMock();
        $mockedResponse->method('getStatusCode')->willReturn(200);
        $mockedResponse->method('getBody')
            ->willReturn('{
                "Transaction": {
                    "TransferChannel": "BANK",
                    "Reference": "TZ12345",
                    "FromAccount": "1234",
                    "TimeStamp": "2001-01-01T12:36:39.556",
                    "DestAccount": "4567",
                    "Amount": 1,
                    "DestBankSortCode": "120100",
                    "GIPResponseCode": "",
                    "GIPSessionId": "",
                    "StatusCode": "015",
                    "ResponseMessage": "System Defect"
                },
                "ResponseCode": "000",
                "ResponseMessage": "Success"
            }');

        /** @var \Mockery\MockInterface $mockedClient */
        $mockedClient = \Mockery::mock(\GuzzleHttp\Client::class);
        $mockedClient->shouldReceive('request')->once()->andReturn($mockedResponse);

        /**
         * @var ConfigInterface $mockedConfig
         * @var \GuzzleHttp\Client $mockedClient
         * */
        $api = new Client($mockedConfig, $mockedClient);

        $requestResult = $api->payout($transaction);
        $this->assertInstanceOf(PayoutResponse::class, $requestResult);
        $this->assertEquals(TransactionStatusEnum::SUCCESS->value, $requestResult->responseCode);
        $this->assertEquals(TransactionStatusEnum::TRANSFER_FAILED->value, $requestResult->transaction->statusCode);
    }
}
