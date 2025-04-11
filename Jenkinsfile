pipeline {
    agent any

    stages {
        stage('Clone Repo') {
            steps {
                git 'https://github.com/omsagvekar/class_management.git'
            }
        }

        stage('Build Docker') {
            steps {
                sh 'docker-compose down'
                sh 'docker-compose up --build -d'
            }
        }

        stage('Run Test') {
            steps {
                echo 'Waiting for container to start...'
                sh 'sleep 10'
                // Use port 8081 (or whatever you configured in docker-compose)
                sh 'curl -s http://localhost:8081 | grep "Class Management"'
            }
        }
    }

    post {
        always {
            echo 'Cleaning up containers...'
            sh 'docker-compose down'
        }
    }
}
