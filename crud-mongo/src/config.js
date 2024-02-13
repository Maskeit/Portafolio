import { config } from "dotenv";
config();

export const mongodb_uri = 
    process.env.MONGOBD_URI || 'mongodb://localhost:27017/crud-mongo';

export const PORT = process.env.PORT || 3000;
