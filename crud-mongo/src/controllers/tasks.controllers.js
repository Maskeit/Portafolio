import Task from "../models/Task";
import { check } from 'express-validator';
import { validateResult } from './validators/validateHelper';

// Define las reglas de validación para el formulario
export const validateCreateTask = [
    check('title')
        .notEmpty()
        .trim()
        .escape()
        .isLength({ max: 255 }),
    check('description')
        .notEmpty()
        .trim()
        .escape()
        .isLength({ max: 255 }),
    (req,res, next) =>{
        validateResult(req,res,next)
    }
];

export const createTask = async (req, res) => {
    try {
        // Verificar errores de validación
        if (req.validationErrors && req.validationErrors.length > 0) {
            const tasks = await Task.find().lean();
            return res.render('index', { tasks, errors: req.validationErrors });
        }
        const task = Task(req.body);
        await task.save();
        res.redirect('/');
    } catch (error) {
        console.error('Error creating task:', error);
        res.redirect('/');
    }
};



export const renderTask = async(req,res) =>{
    const tasks = await Task.find().lean();
    //console.log(tasks[0]);

    res.render('index',{ tasks : tasks});
}



export const renderTaskEdit = async(req,res) =>{
    const task = await Task.findById(req.params.id).lean();
    res.render('edit',{task:task});
}

export const editTask = async(req, res) =>{

    const {id } = req.params;
    await Task.findByIdAndUpdate(id, req.body );
    res.redirect('/');
}

export const deleteTask = async(req, res)=>{
    const { id} = req.params;
    const eliminarRegistro = await Task.findByIdAndDelete(id);

    res.redirect('/');
}

export const taskToggleDone = async(req, res)=>{
    const { id} = req.params;
    const task = await Task.findById(id);
    task.done = !task.done;
    await task.save();
    res.redirect('/');
}