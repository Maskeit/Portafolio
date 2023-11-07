import { config } from "dotenv";
config();

export const mongodb_uri = 
    process.env.MONGOBD_URI || 'mongodb://localhost/test';

export const PORT = process.env.PORT || 3000;
