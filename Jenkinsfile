//jenkins file for the ci pipeline
//jenkin
pipeline {
    agent any

    stages {
        stage('Clone repository') {
            steps {
                git credentialsId: 'github-ssh', url: 'git@github.com:NajmaM22/library_management_system.git'
            }
        }

        stage('Run PHPUnit Tests') {
            steps {
                sh 'php phpunit.phar tests'
            }
        }
    }
}
