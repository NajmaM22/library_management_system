//jenkins file for the ci pipeline
//jenkin
pipeline {
    agent {
        docker {
            image 'php:8.2-cli'   // or any tag you want
        }
    }

    stages {
        stage('Run PHPUnit Tests') {
            steps {
                sh 'php phpunit.phar tests'
            }
        }
    }
}
