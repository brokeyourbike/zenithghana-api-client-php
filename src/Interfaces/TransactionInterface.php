<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Interfaces;

use BrokeYourBike\ZenithGhana\Enums\TransferTypeEnum;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
interface TransactionInterface
{
    public function getTransferType(): TransferTypeEnum;
    public function getReference(): string;
    public function getAmount(): float;
    public function getSenderName(): string;
    public function getRecipientName(): string;
    public function getRecipientBankCode(): string;
    public function getRecipientBankAccount(): string;
}
