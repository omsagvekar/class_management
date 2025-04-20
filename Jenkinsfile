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

        stage('Build Containers') {
            steps {
                bat 'docker-compose down'
                bat 'docker-compose build --no-cache'
                bat 'docker-compose up -d'
            }
        }

        stage('Wait for Services') {
            steps {
                script {
                    timeout(time: 2, unit: 'MINUTES') {
                        bat '''
                            echo "Waiting for database..."
                            docker exec class_db bash -c \
                            "until mysqladmin ping -hlocalhost -uuser -ppassword --silent; do sleep 2; done"
                            
                            echo "Waiting for web server..."
                            docker exec class_web bash -c \
                            "until curl --output /dev/null --silent --head --fail http://localhost; do sleep 2; done"
                        '''
                    }
                }
            }
        }

        stage('Install Dependencies') {
            steps {
                bat 'docker exec class_web composer install --no-interaction --ignore-platform-reqs'
            }
        }

        stage('Run Tests') {
            steps {
                bat 'docker exec class_web ./vendor/bin/phpunit --testdox tests/'
            }
        }
    }

    post {
        always {
            echo 'Cleaning up containers'
            bat 'docker-compose down'
        }
    }
}