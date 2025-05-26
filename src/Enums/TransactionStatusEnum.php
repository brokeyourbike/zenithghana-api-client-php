<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Enums;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
enum TransactionStatusEnum: string
{
    case SUCCESS = '000';
    case ACCOUNT_VERIFICATION_FAILURE = '005';
    case INVALID_TRANSFER_CHANNEL = '006';
    case REQUIRED_FIELDS_VALIDATION_ERRORS = '007';
    case GIP_TRANSFER_FAILED = '009';
    case ACCOUNT_DAILY_LIMIT_REACHED = '010';
    case ACCOUNT_TRANS_LIMIT_REACHED = '011';
    case ACCOUNT_DAILY_LIMIT_REACHED_2 = '012';
    case ACCOUNT_TRANSACTION_LIMIT_REACHED = '013';
    case TRANSFER_FAILED = '015';
    case TRANSACTIONS_NOT_FOUND = '017';
    case GLOBAL_DAILY_LIMIT_REACHED = '018';
    case INSUFFICIENT_FUND = '019';
    case PENDING = '029';
    case AWAITING_GHIPPS_RESPONSE = '920';
}
