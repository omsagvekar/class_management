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

        stage('Composer Clean & Install') {
    steps {
        bat 'docker exec class_web rm -rf vendor composer.lock'
        bat 'docker exec class_web composer install'
    }
}

        stage('Run PHPUnit Tests') {
            steps {
                bat 'docker exec class_web vendor\\bin\\phpunit --testdox tests'
            }
        }
    }
}
