pipeline {
    agent any

    tools {
        git 'DefaultGit'
    }

    stages {
        stage('Clone Repository') {
            steps {
                git branch: 'main', url: 'https://github.com/omsagvekar/class_management.git'
            }
        }

        stage('Build Containers') {
            steps {
                bat 'docker-compose down'
                bat 'docker-compose build --no-cache'
                bat 'docker-compose up -d'
            }
        }

        stage('Wait for Database') {
            steps {
                bat '''
                    docker exec class_db bash -c \
                    "until mysqladmin ping -hlocalhost -uuser -ppassword --silent; do sleep 2; echo 'Waiting for DB...'; done"
                '''
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'docker exec class_web composer install --no-interaction --ignore-platform-reqs'
            }
        }

        stage('Run Tests') {
            steps {
                bat 'docker exec class_web ./vendor/bin/phpunit --testdox tests/'
            }
        }
    }

    post {
        always {
            echo 'Cleaning up containers'
            bat 'docker-compose down'
        }
    }
}