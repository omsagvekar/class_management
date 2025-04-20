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

        stage('Real Tests') {
            steps {
                // Test 1: Actual login functionality
                bat '''
                    curl -X POST http://localhost:8081/login.php \
                    -d "u=admin&p=admin" \
                    | find "dashboard.php"
                '''
                
                // Test 2: Verify user exists in database
                bat '''
                    docker exec class_db mysql -u user -ppassword new_classroom \
                    -e "SELECT COUNT(*) FROM login_user" | find "1"
                '''
            }
        }
    }

    post {
        always {
            echo 'Pipeline completed'
            // bat 'docker-compose down' 
        }
    }
}