pipeline {
    agent any

    stages {
        stage('Clone Repo') {
            steps {
                git branch: 'main', url: 'https://github.com/omsagvekar/class_management.git'
            }
        }

        stage('Build Docker') {
            steps {
                bat 'docker-compose down'
                bat 'docker-compose up --build -d'
            }
        }

        stage('Run Test') {
            steps {
                echo 'Waiting for container to start...'
                bat 'timeout /t 10'
                bat 'curl http://localhost:8081'
            }
        }
    }

    post {
        always {
            echo 'Cleaning up containers...'
            bat 'docker-compose down'
        }
    }
}
