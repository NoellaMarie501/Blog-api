<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



##                      Blog API Project

## Project Urls

- **[Swagger Documentation](https://app.swaggerhub.com/apis/NOELLAMARIE501/Blog_Api/1.0.0)**
- **[Postman collection](https://tighten.co)**

##  Overview
The Blog API project is a backend application designed to provide a RESTful API for managing blog posts. It is built using Docker, Docker Compose, and PHP, with Laravel as the framework. This project offers CRUD (Create, Read, Update, Delete) operations for blog posts, allowing users to manage and interact with their content seamlessly.


## Key Features
- User Authentication Operations: Create, read, update, and delete blog posts.
- CRUD Operations: Create, read, update, and delete blog posts.
- Dockerized Environment: Uses Docker and Docker Compose for easy setup and deployment.
- MySQL Database: Stores blog posts and related data.
- Nginx: Acts as a web server to handle HTTP requests.
- PHP Laravel Framework: Provides a robust backend framework with a built-in ORM and routing system.


## Tools and Technologies
- Docker: Containerization platform that allows the application to run consistently across different environments.
- Docker Compose: Tool for defining and running multi-container Docker applications. It manages service configurations and dependencies.
- Laravel: A PHP framework that simplifies backend development by providing an elegant syntax and powerful features for routing, ORM, and more.
- Nginx: High-performance web server and reverse proxy server used to serve the Laravel application.
- MySQL: Relational database management system used to store blog posts and user data.
- Bash: Scripting language used in the Makefile for managing build and deployment tasks.

## Directory Structure
The project follows this directory structure:


            /project-root
            │
            ├── /app                # Application source code and Dockerfile
            ├── /public             # Public directory for web assets
            ├── /src                # Source code for the application
            ├── /logs               # Logs directory (managed by Docker volumes)
            ├── /docker-compose.yml # Docker Compose configuration
            ├── /Makefile           # Makefile for managing Docker commands
            ├── /migrate.sh         # Script for database migrations
            ├── /variables.env      # Environment variables for Docker Compose
            ├── /README.md          # This file
            └── /other-files        # Any other project files


## Setup Instructions
    Prerequisites
    - Docker: Ensure Docker is installed and running. Docker Installation Guide
    - Docker Compose: Ensure Docker Compose is installed. Docker Compose Installation Guide
    - Clone the Repository
    - First, clone the project repository:

    - bash
        Copy code
        git clone <repository-url>
        cd <repository-directory>
    - Configuration
        Environment Variables

    Copy the .env.example file to .env and update the environment variables as needed. This file contains configuration for database connections, mail settings, and more.

    ## Docker Compose

    Ensure the docker-compose.yml file is configured correctly for your environment.
    Update variables.env with necessary environment variables.

    Build and Start Containers
        To build Docker images and start the application containers, run:
        - make dev
            This command will:

            Build the Docker images specified in docker-compose.yml.
            Start the containers in detached mode.
    Run Migrations
        To run database migrations, execute:

        - make migrate
        This command will execute the migrate.sh script to set up the initial database schema.

    Access the Application
        The application will be accessible on http://localhost:8080 (or another port if configured differently).

    Stopping and Restarting
        To stop all running containers, use:
        
        make stop
        To restart the containers after making changes, use:



    Running Tests
    To run the application tests, use:
   
        - make test
    Viewing Logs
        To follow the logs for the app container, use:

        - make logs

    Container Access
        To access the app container as the root user, use:

        - make root
    To access the nginx container as the root user, use:

        make root-nginx
   
- help, help-default: Displays the help menu with available commands.
- build: Builds or rebuilds Docker images.
- deploy-acceptance: Deploys to the acceptance environment.
- deploy-staging: Deploys to the staging environment.
- deploy-production: Deploys to the production environment.
- pull: Pulls the latest MySQL Docker image.
- migrate: Runs database migrations.
- up: Starts Docker containers in detached mode.
- stop: Stops all Docker containers.
- status: Shows the status of Docker containers.
- reset: Stops, cleans, rebuilds, and restarts the containers.
- root: Logs into the app container as the root user.
- root-nginx: Logs into the nginx container as the root user.
- test-dev: Runs tests inside the app container in interactive mode.
- test1: Builds and runs tests inside the app container.
- test: Runs tests using Docker Compose.
- logs: Follows logs for the app container.
- ping-app: Pings the app service from within the nginx container.
- ping-nginx: Pings the nginx service from within the app container.
- clean: Stops containers and removes them.
- cleanall: Prunes all unused Docker data.
- restart: Stops, cleans, rebuilds, and restarts the containers.
- %: A catch-all target that does nothing.
- Troubleshooting
- Logs not showing errors: Ensure the LOG_CHANNEL and LOG_LEVEL are configured correctly in your .env file.
- Docker container issues: Verify that Docker and Docker Compose are correctly installed and running.

## License