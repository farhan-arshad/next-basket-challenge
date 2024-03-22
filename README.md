# Laravel Microservices Demo
## Highlights
This is a demo for microservices implementation in Laravel. There are two microservices implemented, UserService and NotificationService. THe services are separate laravel apps that are dockerized and communicate through RabbitMQ messaging. The RabbitMQ component is implemented through CloudAMQP, a RabbitMQ cloud service with a free plan.

## Instructions
1. Clone the 'master' branch of the repository as is into your local directory.
2. Run 'docker-compose up -d' to install and run the various docker containers.
3. Make a POST request to /api/user with the specified payload (first_name, last_name, email).
4. The user data mentioned in the paylaod should now be saved to database 'users' table.
5. Also, the user_list.csv file should be created under "./NotificationService/storage/app" showing the new user details.
