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
                sleep 20 // Increased wait time
            }
        }

        stage('Real Tests') {
            steps {
                // Test 1: Login with correct credentials
                bat '''
                    curl -L -v -X POST http://localhost:8081/login.php \
                    -d "u=admin&p=Admin" \
                    | find "dashboard.php"
                '''
                
                // Test 2: Verify user count
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
            bat 'docker-compose down' 
        }
    }
}