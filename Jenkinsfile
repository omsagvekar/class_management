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

        stage('Build Docker Containers') {
            steps {
                bat 'docker-compose down'  // Clean up previous containers
                bat 'docker-compose up --build -d'
            }
        }

        stage('Wait for Database Readiness') {
            steps {
                script {
                    // Wait max 30 seconds for MySQL to be ready
                    bat '''
                        docker exec class_db bash -c \
                        "while ! mysqladmin ping -h localhost --silent; do sleep 2; echo 'Waiting for database...'; done; echo 'Database ready!'"
                    '''
                }
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'docker exec class_web rm -rf vendor'  // Clean existing dependencies
                bat 'docker exec class_web composer install --no-interaction'
            }
        }

        stage('Run PHPUnit Tests') {
            steps {
                bat 'docker exec class_web vendor\\bin\\phpunit --testdox --testsuite "Application Test Suite"'
            }
        }

        stage('Smoke Tests') {
            steps {
                script {
                    // Test 1: Check homepage accessibility
                    bat 'curl -I http://localhost:8081 | find "200 OK"'
                    
                    // Test 2: Verify database structure
                    bat '''
                        docker exec class_db mysql -u user -ppassword new_classroom -e \
                        "SHOW TABLES LIKE 'login_user'" | find "login_user"
                    '''
                }
            }
        }
    }

    post {
        always {
            // Optional: Clean up containers after build
            // bat 'docker-compose down'
        }
    }
}