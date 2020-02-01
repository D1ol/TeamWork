<?php


namespace App\Controller\Tasks;

use App\Entity\Tasks\Task;
use App\Entity\Tasks\UseCase\CreateTask;
use App\Entity\Tasks\UseCase\CreateTask\Responder as CreateTaskResponder;
use App\Core\AdvancedAbstractController;
use App\Form\Tasks\AddTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListTaskController
 * @package App\Controller\Tasks
 * @Route("/tasks")
 */
class ListTaskController extends AdvancedAbstractController
{
    /**
     * @Route("/", name="task_add", methods={"GET"})
     */
    public function addAction(Request $request)
    {
        $task = $this->get('Tasks')->findOneByUserAndDateEndNull($this->getUser()->getId());

        $userTasks = $this->get('read_model.tasks_query')->getAllCompletedTasksByUserID($this->getUser()->getId());
        $form = $this->createForm(
            AddTaskType::class,
            $task ? $this->getTaskFromObjectToArray($task) : null
        );
        $form->handleRequest($request);


        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView(),
            'task' => $task,
            'userTasks' => $userTasks
        ]);

    }

    public function getTaskFromObjectToArray(Task $task)
    {
        return [
            'description' => $task->getDescription(),
            'project' => $task->getIdProject(),
            'dateStart' => $task->getDateStart()
        ];
    }

}