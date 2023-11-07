import { validationResult } from "express-validator";

export const validateResult = (req, res, next) => {
    try {
        validationResult(req).throw();
        next(); // Llamamos a next() solo si la validación es exitosa
    } catch (err) {
        req.validationErrors = err.array(); // Almacenamos los errores en req.validationErrors
        next(); // Continuamos con el siguiente middleware
    }
};
