//jenkins file for the ci pipeline
//jenkin
pipeline {
    agent any

    stages {
        

        stage('Run PHPUnit Tests') {
            steps {
                sh 'php phpunit.phar tests'
            }
        }
    }
}
