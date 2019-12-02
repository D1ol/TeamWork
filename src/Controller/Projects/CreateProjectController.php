<?php


namespace App\Controller\Projects;


use App\Core\AdvancedAbstractController;
use App\Entity\Projects\Project;
use App\Entity\Projects\UseCase\CreateProject;
use App\Entity\Projects\UseCase\CreateProject\Responder as CreateProjectResponder;
use App\Form\Projects\AddProjectType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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

            $createProject = $this->get('use_case.create_project');
            $createProject->execute($command);

            return $this->redirectToRoute('project_add');
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