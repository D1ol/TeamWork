<?php


namespace App\Controller\Projects;


use App\Core\AdvancedAbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListOfProjectsController
 * @package App\Controller\Projects
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
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