//jenkins file for the ci pipeline
//jenkins
pipeline {
    agent any

    stages {
        stage('Clone repository') {
            steps {
                git 'https://github.com/NajmaM22/library_management_system.git'
            }
        }

        stage('Run PHPUnit Tests') {
            steps {
                sh 'php phpunit.phar tests'
            }
        }
    }
}
