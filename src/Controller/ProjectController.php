<?php

/*
 * Copyright (C) 2018 Techpike s.r.o.
 * All Rights Reserved.
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     *
     * @param ProjectRepository $projectRepository
     *
     * @return Response
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig',
            ['projects' => $projectRepository->findAllProjectsOrdered()]
        );
    }

    /**
     * @Route("/new", name="project_new", methods={"GET","POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function new(Request $request): Response
    {
        $newProject = new Project();

        $form = $this->createForm(ProjectType::class, $newProject);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newProject);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $newProject,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_view", methods={"GET"}, requirements={"id"="\d+"})
     *
     * @param Project $project
     *
     * @return Response
     */
    public function view(Project $project): Response
    {
        //return $this->render('skill/view.html.twig', ['skill' => $skill]);
    }

//    /**
//     * @Route("/{id}", name="project_delete", methods={"DELETE"})
//     *
//     * @param Request         $request
//     * @param Project           $project
//     * @param ProjectRepository $projectRepository
//     *
//     * @return Response
//     */
////    public function delete(Request $request, Project $project, ProjectRepository $projectRepository): Response
//    {
////        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
////            $entityManager = $this->getDoctrine()->getManager();
////            $skillsToRemove = $skillRepository->findBy(['name' => $skill->getName()]);
////            foreach ($skillsToRemove as $skillToRemove) {
////                $entityManager->remove($skillToRemove);
////            }
////
////            $entityManager->flush();
////        }
////
////        return $this->redirectToRoute('skill_index');
//    }

//    /**
//     * @Route("/autocomplete", name="skill_autocomplete", methods={"GET"})
//     *
//     * @param Request         $request
//     * @param ProjectRepository $projectRepository
//     *
//     * @return JsonResponse
//     */
////    public function autocomplete(Request $request, ProjectRepository $projectRepository): Response
//    {
////        $search = $request->get('search', '');
////
////        $skills = $skillRepository->autocomplete($search);
////
////        return $this->json($skills, 200, [], ['options' => true]);
//    }
//
////    /**
//////     * @Route("/find-by-id", name="skill_find_by_id", methods={"GET"})
//////     *
//////     * @param Request         $request
//////     * @param SkillRepository $skillRepository
//////     *
//////     * @return JsonResponse
//////     */
//////    public function findById(Request $request, SkillRepository $skillRepository): Response
//////    {
////////        $ids = $request->get('ids', '');
////////
////////        $skills = $skillRepository->findBy(['id' => $ids]);
////////
////////        return $this->json($skills, 200, [], ['options' => true]);
//////    }
}
