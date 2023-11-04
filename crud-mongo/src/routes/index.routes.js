import { Router } from "express";
import {
  renderTask,
  createTask,
  renderTaskEdit,
  editTask,
  deleteTask,
  taskToggleDone,
  validateCreateTask
} from "../controllers/tasks.controllers";
const router = Router();
//ruta del index, a donde apunta el proyecto
router.get("/", renderTask);

//ruta del formulario
router.post("/tasks/add", validateCreateTask ,createTask);

//muestra la vista del edit
router.get("/edit/:id", renderTaskEdit);

//metodo para recibir por post el form del edit.hbs
router.post("/edit/:id", editTask);

//metodo para eliminar tarea
router.get("/delete/:id", deleteTask);

//metodo para cambiar el estado de done a undone
router.get("/toogleDone/:id", taskToggleDone);

export default router;
