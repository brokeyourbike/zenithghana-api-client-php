<?php

// Copyright (C) 2025 Ivan Stasiuk <ivan@stasi.uk>.
// Use of this source code is governed by a BSD-style
// license that can be found in the LICENSE file.

namespace BrokeYourBike\ZenithGhana\Enums;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
enum TransferTypeEnum: string
{
    case BANK = 'BANK';
    case MOBILEMONEY = 'MOBILEMONEY';
}
