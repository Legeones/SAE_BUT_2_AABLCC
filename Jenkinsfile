pipeline {
    agent any
        stages {
            stage('SonarQube Analysis') {
                    steps {
                        bat 'sonar-scanner.bat'
                    }
            }
        }
}