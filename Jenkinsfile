pipeline {
    agent any

    tools {
        git 'DefaultGit'
    }

    stages {
        stage('Clone Repo') {
            steps {
                git branch: 'main', url: 'https://github.com/omsagvekar/class_management.git'
            }
        }

        stage('Build Docker') {
            steps {
                bat 'docker-compose up --build -d'
            }
        }

        stage('Wait for DB') {  // New stage
            steps {
                bat '''
                    docker exec class_db bash -c "while ! mysqladmin ping -h localhost --silent; do sleep 1; done"
                '''
            }
        }

        stage('Composer Clean & Install') {
            steps {
                bat 'docker exec class_web rm -rf vendor'  // Removed composer.lock deletion
                bat 'docker exec class_web composer install'
            }
        }

        stage('Run PHPUnit Tests') {
            steps {
                bat 'docker exec class_web vendor\\bin\\phpunit --testdox'  // Removed explicit tests argument
            }
        }
    }
}