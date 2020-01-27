<?php

/*
 * Copyright (C) 2018 Techpike s.r.o.
 * All Rights Reserved.
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

namespace App\Transformer;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Form\Model\ProjectFormModel;
use Symfony\Component\Form\DataTransformerInterface;

class StatusSelectToProjectStatusTransformer implements DataTransformerInterface
{
    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    /**
     * {@inheritdoc}
     *
     * @param Project|null $value
     */
    public function transform($value)
    {
        $projectFormModel = new ProjectFormModel();

        if ($value) {
            $projectFormModel->setName($value->getName());
            $projectFormModel->setStatus($value->getStatus());
        }

        return $projectFormModel;
    }

    /**
     * {@inheritdoc}
     *
     * @param ProjectFormModel|null $value
     */
    public function reverseTransform($value)
    {
        return $this->projectRepository->findOneBy(['name' => $value->getName(), 'status' => $value->getStatus()]);
    }
}
