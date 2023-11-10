pipeline {
    agent any
    stages {
        stage ('Run Docker Compose') {
            steps{
                bat 'sudo docker-compose up -d'
            }
        }
    }
}