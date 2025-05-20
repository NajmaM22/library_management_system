pipeline {
    agent any
    options {
        skipDefaultCheckout true
    }

    stages {
        stage('Checkout Source') {
            steps {
                checkout scm
            }
        }

        stage('Run PHPUnit Tests in Docker') {
            steps {
                script {
                    docker.image('php:8.2-cli').inside {
                        sh '''
                            # Download PHPUnit
                            curl -L https://phar.phpunit.de/phpunit-9.phar -o phpunit.phar
                            chmod +x phpunit.phar
                            
                            # Optional: list files for confirmation
                            echo "Listing contents:"
                            ls -la
                            echo "Listing test directory:"
                            ls -la test

                            # Run all tests in test folder
                            ./phpunit.phar --testdox test
                        '''
                    }
                }
            }
        }
    }
}
