<?php


namespace App\Controller\Projects;


use App\Core\AdvancedAbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListOfProjectsController extends AdvancedAbstractController
{
    /**
     * @Route("/projects", name="projects_index", methods={"GET"})
     */
    public function indexAction()
    {
        return $this->render('projects/index.html.twig', [
            'projects' => $this->get('read_model.projects_query')->getAll()
        ]);
    }

}