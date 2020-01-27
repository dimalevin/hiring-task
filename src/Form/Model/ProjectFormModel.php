<?php

/*
 * Copyright (C) 2018 Techpike s.r.o.
 * All Rights Reserved.
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

namespace App\Form\Model;

class ProjectFormModel
{
    /**
     * @var int|null
     */
    private $status;

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int |null $status
     */
    public function setStatus(int $status = null): void
    {
        $this->status = $status;
    }
}
