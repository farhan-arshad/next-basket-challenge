# Laravel Microservices Demo
## Highlights
This is a demo for microservices implementation in Laravel. There are two microservices implemented, UserService and NotificationService. THe services are separate laravel apps that are dockerized and communicate through RabbitMQ messaging. The RabbitMQ component is implemented through CloudAMQP, a RabbitMQ cloud service with a free plan.

## Instructions
1. Clone the 'master' branch of the repository as is into your local directory.
2. Run 'docker-compose up -d' to install and run the various docker containers. Since this command will also be running composer install in the background, please check container logs and/or debug output to check whether composer has finished installing the packages
3. Login into db instance and create the database with name 'next-basket-example'.
4. Create a user `laravel-root` with password 'goldilocks007' and grant all rights to 'next-basket-example' db.
5. Login into the user_service and notification_service containers and run 'php artisan queue:work' on each so that both are connected to the CloudAMQP instance. Wait for a minute or two so that all connections are activated before performing next step.
6. Make a POST request to /api/user with the specified payload (first_name, last_name, email).
7. The user data mentioned in the payload should now be saved to database 'users' table.
8. Also, the user_list.csv file should be created under "./NotificationService/storage/app" showing the new user details.
