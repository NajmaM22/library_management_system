pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        stage('Run PHPUnit Tests in Docker') {
            steps {
                script {
                    docker.image('php:8.2-cli').inside {
                        sh 'php phpunit.phar test'
                    }
                }
            }
        }
    }
}
