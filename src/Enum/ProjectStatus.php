<?php

/*
 * Copyright (C) 2018 Techpike s.r.o.
 * All Rights Reserved.
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

namespace App\Enum;

class ProjectStatus
{
    const STATUS_PLANNED = 1;
    const STATUS_IN_PRODUCTION = 2;
    const STATUS_COMPLETED = 3;

    const LABEL_STATUS_PLANNED = 'Planned';
    const LABEL_STATUS_IN_PRODUCTION = 'In Production';
    const LABEL_STATUS_COMPLETED = 'Completed';

    private static $labels = [
        self::STATUS_PLANNED => self::LABEL_STATUS_PLANNED,
        self::STATUS_IN_PRODUCTION => self::LABEL_STATUS_IN_PRODUCTION,
        self::STATUS_COMPLETED => self::LABEL_STATUS_COMPLETED,
    ];

    public static function getLabel(int $value): string
    {
        return self::$labels[$value];
    }

    public static function getChoices()
    {
        return [
            self::LABEL_STATUS_PLANNED => self::STATUS_PLANNED,
            self::LABEL_STATUS_IN_PRODUCTION => self::STATUS_IN_PRODUCTION,
            self::LABEL_STATUS_COMPLETED => self::STATUS_COMPLETED,
        ];
    }

    public static function getAll()
    {
        return [
            self::STATUS_PLANNED,
            self::STATUS_IN_PRODUCTION,
            self::STATUS_COMPLETED,
        ];
    }
}
