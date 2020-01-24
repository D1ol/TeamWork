<?php


namespace App\Controller\Tasks;

use App\Entity\Tasks\Task;
use App\Entity\Tasks\UseCase\CreateTask;
use App\Entity\Tasks\UseCase\CreateTask\Responder as CreateTaskResponder;
use App\Core\AdvancedAbstractController;
use App\Form\Tasks\AddTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateTaskController extends AdvancedAbstractController
{
    /**
     * @Route("/tasks/add", name="task_add", methods={"GET"})
     * @Route("/tasks/create", name="task_create", methods={"POST"})
     */
    public function addAction(Request $request)
    {
        $task = $this->get('Tasks')->findOneByUserAndDateEndNull($this->getUser()->getId());
        $form = $this->createForm(
            AddTaskType::class,
            $task ? $this->getTaskFromObjectToArray($task) : null,
            [
                'method' => 'POST',
                'action' => $this->generateUrl('task_create')
            ]
        );
        $form->handleRequest($request);


        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function getTaskFromObjectToArray(Task $task)
    {
        return [
            'description' => $task->getDescription(),
            'project' => $task->getIdProject()
        ];
    }

}