<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana;

use GuzzleHttp\ClientInterface;
use BrokeYourBike\ZenithGhana\Responses\PayoutResponse;
use BrokeYourBike\ZenithGhana\Interfaces\TransactionInterface;
use BrokeYourBike\ZenithGhana\Interfaces\ConfigInterface;
use BrokeYourBike\HttpEnums\HttpMethodEnum;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;
use BrokeYourBike\HasSourceModel\SourceModelInterface;
use BrokeYourBike\HasSourceModel\HasSourceModelTrait;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class Client implements HttpClientInterface
{
    use HttpClientTrait;
    use HasSourceModelTrait;

    private ConfigInterface $config;

    public function __construct(ConfigInterface $config, ClientInterface $httpClient)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
    }

    public function getConfig(): ConfigInterface
    {
        return $this->config;
    }

    public function payout(TransactionInterface $transaction): PayoutResponse
    {
        $options = [
            \GuzzleHttp\RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            \GuzzleHttp\RequestOptions::AUTH => [
                $this->config->getUsername(),
                $this->config->getPassword(),
            ],
            \GuzzleHttp\RequestOptions::JSON => [
                'transferChannel' => $transaction->getTransferType()->value,
                'fromAccount' => $this->config->getFromAccount(),
                'fromAccountName' => $this->config->getFromAccountName(),
                'sendingPartyName' => $transaction->getSenderName(),
                'destBankSortCode' => $transaction->getRecipientBankCode(),
                'destAccount' => $transaction->getRecipientBankAccount(),
                'destAccountName' => $transaction->getRecipientName(),
                'purposeOfTransfer' => $transaction->getReference(),
                'reference' => $this->config->getPrefix().$transaction->getReference(),
                'amount' => $transaction->getAmount(),
            ],
        ];

        if ($transaction instanceof SourceModelInterface){
            $options[\BrokeYourBike\HasSourceModel\Enums\RequestOptions::SOURCE_MODEL] = $transaction;
        }

        $response = $this->httpClient->request(
            HttpMethodEnum::POST->value,
            rtrim($this->config->getUrl(), '/') . '/v2/ZTransfer/SendMoney',
            $options
        );

        return new PayoutResponse($response);
    }

    public function status(string $reference): PayoutResponse
    {
        $options = [
            \GuzzleHttp\RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            \GuzzleHttp\RequestOptions::AUTH => [
                $this->config->getUsername(),
                $this->config->getPassword(),
            ],
            \GuzzleHttp\RequestOptions::JSON => [
                'reference' => $this->config->getPrefix().$reference,
            ],
        ];

        $response = $this->httpClient->request(
            HttpMethodEnum::POST->value,
            rtrim($this->config->getUrl(), '/') . "/v2/ZTransfer/GetTransactionStatus",
            $options
        );

        return new PayoutResponse($response);
    }
}
