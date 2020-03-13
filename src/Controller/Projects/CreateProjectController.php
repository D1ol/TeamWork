<?php


namespace App\Controller\Projects;


use App\Core\AdvancedAbstractController;
use App\Entity\Projects\Project;
use App\Entity\Projects\UseCase\CreateProject;
use App\Entity\Projects\UseCase\CreateProject\Responder as CreateProjectResponder;
use App\Form\Projects\AddProjectType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateProjectController
 * @package App\Controller\Projects
 * @Route("/{_locale}", defaults={"_locale" = "en"}, requirements={"_locale" = "en|pl"})
 */
class CreateProjectController extends AdvancedAbstractController implements CreateProjectResponder
{
    /**
     * @Route("/projects/add", name="project_add", methods={"GET"})
     * @Route("/projects/create", name="project_create", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(
            AddProjectType::class,
            [],
            [
                'method' => 'POST',
                'action' => $this->generateUrl('project_create')
            ]
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $command = new CreateProject\Command(
              $data['name'],
              $data['description'],
              $data['client'],
              $data['users']
            );
            $command->setResponder($this);

            $this->get('use_case.create_project')->execute($command);
            if ($this->container->get('session')->getFlashBag()->has('success'))
                return $this->redirectToRoute('projects_index');
        }

        return $this->render('projects/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function projectCreated(Project $project)
    {
        $this->addFlash('success', 'Project: '.$project->getName().' created');
    }
}