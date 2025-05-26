<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Responses;

use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Attributes\MapFrom;
use BrokeYourBike\DataTransferObject\JsonResponse;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class PayoutResponse extends JsonResponse
{
    #[MapFrom('Transaction')]
    public ?Transaction $transaction;

    #[MapFrom('ResponseCode')]
    public string $responseCode;

    #[MapFrom('ResponseMessage')]
    public string $responseMessage;
}

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class Transaction extends DataTransferObject
{
    #[MapFrom('Reference')]
    public string $reference;

    #[MapFrom('StatusCode')]
    public string $statusCode;

    #[MapFrom('ResponseMessage')]
    public string $responseMessage;
}
