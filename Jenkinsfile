 
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
                sh 'sleep 10' // wait for container to start
                sh 'curl -s http://localhost:8080 | grep "Class Management"'
            }
        }
    }
}
