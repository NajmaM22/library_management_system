pipeline {
    agent any
    options {
        skipDefaultCheckout true
    }

    stages {
        stage('Run PHPUnit Tests in Docker') {
            steps {
                script {
                    docker.image('php:8.2-cli').inside {
                        sh '''
                            curl -L https://phar.phpunit.de/phpunit-9.phar -o phpunit.phar
                            chmod +x phpunit.phar
                            ./phpunit.phar --testdox src/test
                        '''
                    }
                }
            }
        }
    }
}
