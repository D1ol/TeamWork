<?php


namespace App\Controller\Tasks;


use App\Core\AdvancedAbstractController;
use App\Core\AjaxResponse;
use App\Entity\Tasks\Task;
use App\Entity\Tasks\UseCase\CreateTask;
use App\Entity\Tasks\UseCase\CreateTask\Responder as CreateTaskResponder;
use App\Entity\Tasks\UseCase\EditTask\Responder as EditTaskResponder;
use App\Entity\Tasks\UseCase\EditTask;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListTaskController
 * @package App\Controller\Tasks
 * @Route("/tasks")
 */
class AjaxTaskController extends AdvancedAbstractController implements CreateTaskResponder, EditTaskResponder
{

    /**
     * @Route("/ajax", name="task_ajax", methods={"POST"})
     */
    public function addAction(Request $request, AjaxResponse $ajaxResponse)
    {
        $description = $request->get('description');
        $project = $request->get('project');
        $stop = $request->get('stop');

        if (!$stop) {
            $this->createTask($description, $project, $ajaxResponse);
        } else {
            $this->editTask($description, $project, $ajaxResponse);
        }
        if($this->container->get('session')->has('task'))
        {
            return new JsonResponse(
                $this->container->get('session')->get('task'),200
            );
        }

        $response = $ajaxResponse->generateResponse($this->container->get('session')->getFlashBag());

        return new JsonResponse(
            $response?$response['description']:null, $response?$response['httpStatus']:200
        );
    }

    public function createTask(string $description, string $project, AjaxResponse $ajaxResponse)
    {
        $command = new CreateTask\Command(
            $description,
            $this->getUser(),
            $project
        );

        $command->setResponder($this);

        $this->get('use_case.create_task')->execute($command);
    }

    public function editTask(string $description, string $project, AjaxResponse $ajaxResponse)
    {
        $command = new EditTask\Command(
            $description,
            $this->getUser(),
            $project
        );

        $command->setResponder($this);

        $this->get('use_case.edit_task')->execute($command);
    }

    public function taskCreated(Task $task)
    {
    }

    public function projectDoesNotExist()
    {
        $this->addFlash('error', 'Can not create task without project');
    }

    public function taskEdited(Task $task)
    {
        $this->container->get('session')->set('task',$this->getTaskToArray($task));
    }

    public function taskDoesNotExist()
    {
        $this->addFlash('error', 'Can not find active task');
    }

    public function getTaskToArray(Task $task)
    {
        return [
                'taskID' => $task->getId(),
                'description' => $task->getDescription(),
                'projectName' => $task->getIdProject()->getName(),
                'clientName' => $task->getIdProject()->getIdClient()->getName(),
                'clientColor' => $task->getIdProject()->getIdClient()->getColor(),
                'dateStart' => $task->getDateStart()->format('Y-m-d'),
                'dateEnd' => $task->getDateEnd()->format('Y-m-d'),
                'taskTime' => ($task->getDateStart()->diff($task->getDateEnd()))->format("%H:%I:%S")
            ];
    }
}