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

        stage('Start Containers') {
            steps {
                bat 'docker-compose up --build -d'
                sleep 15 // Wait for containers to initialize
            }
        }

        stage('Basic Tests') {
            steps {
                // Test 1: Check homepage loads
                bat 'curl -I http://localhost:8081 | find "200 OK"'
                
                // Test 2: Verify database connection
                bat 'docker exec class_db mysql -u user -ppassword new_classroom -e "SHOW TABLES" | find "login_user"'
            }
        }
    }

    post {
        always {
            echo 'Pipeline completed'
            // bat 'docker-compose down' // Cleanup
        }
    }
}