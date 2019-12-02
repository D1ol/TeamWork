<?php


namespace App\Controller\Tasks;

use App\Entity\Tasks\Task;
use App\Entity\Tasks\UseCase\CreateTask;
use App\Entity\Tasks\UseCase\CreateTask\Responder as CreateTaskResponder;
use App\Core\AdvancedAbstractController;
use App\Form\Tasks\AddTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTaskController extends AdvancedAbstractController implements CreateTaskResponder
{
    /**
     * @Route("/tasks/add", name="task_add", methods={"GET"})
     * @Route("/tasks/create", name="task_create", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(
            AddTaskType::class,
            [],
            [
                'method' => 'POST',
                'action' => $this->generateUrl('task_create')
            ]
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $command = new CreateTask\Command(
                $data['description'],
                $this->getUser(),
                $data['project']

            );
            $command->setResponder($this);

            $createTask= $this->get('use_case.create_task');
            $createTask->execute($command);

            return $this->redirectToRoute('task_add');
        }

        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function taskCreated(Task $task)
    {
        $this->addFlash('success', 'Task with id: '.$task->getId().' created');
    }
}