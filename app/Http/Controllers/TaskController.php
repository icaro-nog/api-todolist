<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Models\Task as TaskModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use OpenApi\Annotations as OA;

class TaskController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/task",
     *     summary="Create a new task",
     *     description="Creates a new task and returns the created task data.",
     *     operationId="createTask",
     *     tags={"Task"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "status"},
     *             @OA\Property(property="title", type="string", example="Title"),
     *             @OA\Property(property="description", type="string", nullable=true, example="Description"),
     *             @OA\Property(property="status", type="integer", enum={1,2,3}, example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Task successfully created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="task",
     *                 ref="#/components/schemas/Task"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function createTask(CreateTaskRequest $request){
        $newTask = TaskModel::create($request->validated());
        return response()->json(['task' => $newTask], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="List all tasks",
     *     description="Return a list of tasks.",
     *     operationId="getTasks",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="tasks",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Task")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function getTasks(){
        $tasks = TaskModel::all();

        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/status/{status}",
     *     summary="Get tasks filtered by status",
     *     description="Returns a list of tasks filtered by their status. Valid status values are: 1 (Pending), 2 (In Progress), 3 (Completed).",
     *     operationId="getTasksByStatus",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="status",
     *         in="path",
     *         required=true,
     *         description="Status code to filter tasks by. Allowed values: 1 = Pending, 2 = In Progress, 3 = Completed.",
     *         @OA\Schema(
     *             type="integer",
     *             enum={1,2,3},
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of tasks matching the given status",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="tasks",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Task")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid status value",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Invalid status value")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function getTasksByStatus(int $status){
        if (!in_array($status, [1, 2, 3])) {
            return response()->json(['error' => 'Invalid status value'], 400);
        }

        $tasks = TaskModel::where('status', $status)->get();
        return response()->json(['tasks' => $tasks], 200);
    }

    /**
     * @OA\Put(
     *     path="/api/task/{id}",
     *     summary="Update the status of a task",
     *     description="Updates the status of an existing task by its ID.",
     *     operationId="editTask",
     *     tags={"Task"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be updated",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"status"},
     *             @OA\Property(
     *                 property="status",
     *                 type="integer",
     *                 enum={1,2,3},
     *                 example=2,
     *                 description="1 = Pending, 2 = In Progress, 3 = Completed"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="task", ref="#/components/schemas/Task")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Task not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function editTask(int $id, UpdateTaskStatusRequest $request){
        try{
            $task = TaskModel::findOrFail($id);
            $task->update($request->validated());

            return response()->json(['task' => $task], 200);
        } catch(ModelNotFoundException $e){
            return response()->json(['error' => 'Task not found.'], 404);
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/task/{id}",
     *     summary="Delete a task",
     *     description="Deletes a task by its ID.",
     *     operationId="deleteTask",
     *     tags={"Task"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the task to be deleted",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Task deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Task deleted successfully.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Task not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Task not found.")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function deleteTask(int $id){
        try {
            $task = TaskModel::findOrFail($id);
            $task->delete();

            return response()->json(['message' => 'Task deleted successfully.'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Task not found.'], 404);
        }
    }
}
