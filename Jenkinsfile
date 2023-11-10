pipeline {
    agent {
        docker { image 'node:16-alpine' }
    }
    stages {
        stage ('Run Docker Compose') {
            steps{
                sh 'sudo docker-compose up -d'
            }
        }
    }
}