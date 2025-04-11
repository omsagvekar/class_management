pipeline {
    agent any

    tools {
        git 'DefaultGit' // name you gave in Jenkins tool config
    }

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
        sleep time: 10, unit: 'SECONDS'
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
