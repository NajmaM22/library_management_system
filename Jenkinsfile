pipeline {
    agent any
    // Just delete the entire `options` block

    stages {
        stage('Run PHPUnit Tests in Docker') {
            steps {
                script {
                    docker.image('php:8.2-cli').inside {
                        sh '''
                            # Download PHPUnit
                            curl -L https://phar.phpunit.de/phpunit-9.phar -o phpunit.phar
                            chmod +x phpunit.phar
                            
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
