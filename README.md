# Task Manager App

This is a task management application where users can 
- Create task (info to save: task name, priority, timestamps)
- Edit task
- Delete task
- Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. #1 priority goes at top, #2 next down and so on.
- View Project and tasks under the project 

## Installation
1. Set up your mySQL database and replace values in ```.env.example``` with your DB credentials
2. Install the composer dependencies and devDependencies ```composer install ``` and start Laravels dev  server. ``` php artisan serve```
3. Set up migration for database ```php artisan migrate``` and seed sample data from Laravel seeder ```php artisan db:seed```
4. Install NPM dependencies ```npm install``` and start server with ```npm run dev``` . This also compiles your assets in resources to public folder
4. Navigate to ```http://127.0.0.1:8000/projects``` on web browser

