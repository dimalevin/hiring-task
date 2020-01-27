<?php

/*
 * Copyright (C) 2018 Techpike s.r.o.
 * All Rights Reserved.
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Project;
use App\Enum\ProjectStatus;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Transformer\StatusSelectToProjectStatusTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * @var StatusSelectToProjectStatusTransformer
     */
    private $statusSelectToProjectStatusTransformer;

    public function __construct(StatusSelectToProjectStatusTransformer $statusSelectToProjectStatusTransformer)
    {
        $this->statusSelectToProjectStatusTransformer = $statusSelectToProjectStatusTransformer;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('status', ChoiceType::class, [
                'choices' => ProjectStatus::getChoices(),
                'label' => 'Status', ])
            ->add('employees', EntityType::class, [
            'class' => Employee::class,
            'choice_label' => function (Employee $emp) {
                return $emp->getFullName();
            },
                'attr' => ['data-select' => 'true'],
            'multiple' => true

        ]);

        $builder->get('name')->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'validateNameBeforeDataTransforms']);

        //$builder->get('status')->addEventListener(FormEvents::SUBMIT, [$this, 'validateUniqueSkillTypes']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }

    /**
     * Prevent project name not being chosen on submit.
     *
     * @param FormEvent $event
     */
    public function validateNameBeforeDataTransforms(FormEvent $event)
    {
        if (empty($event->getData())) {
            $event->getForm()->addError(new FormError('Please fill a project name'));
        }
    }

    /**
     * @param FormEvent $event
     */
    public function validateUniqueSkillTypes(FormEvent $event)
    {
//        $form = $event->getForm();
//
//        $skillUseCount = [];
//
//        foreach ($form as $skillSelectForm) {
//            /** @var FormInterface $skillSelectForm */
//            /** @var SkillFormModel $skillSelectModel */
//            $skillSelectModel = $skillSelectForm->getData();
//            $skillName = $skillSelectModel->getName();
//            if (array_key_exists($skillName, $skillUseCount)) {
//                ++$skillUseCount[$skillName];
//            } else {
//                $skillUseCount[$skillName] = 1;
//            }
//        }
//
//        foreach ($form as $skillSelectForm) {
//            /** @var FormInterface $skillSelectForm */
//            /** @var SkillFormModel $skillSelectModel */
//            $skillSelectModel = $skillSelectForm->getData();
//            if ($skillUseCount[$skillSelectModel->getName()] > 1) {
//                $skillSelectForm->get('name')->addError(new FormError('Employee cannot have multiple skills with same name.'));
//            }
//        }
    }
}
