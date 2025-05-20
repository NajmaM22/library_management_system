pipeline {
    agent any

    stages {
        stage('Install PHPUnit and Run Tests') {
            steps {
                script {
                    docker.image('php:8.2-cli').inside {
                        sh '''
                            # Download PHPUnit
                            curl -Ls https://phar.phpunit.de/phpunit-9.phar -o phpunit.phar
                            chmod +x phpunit.phar

                            # Confirm structure (optional debug)
                            echo "Listing workspace contents:"
                            ls -R

                            # Run tests
                            ./phpunit.phar --testdox test
                        '''
                    }
                }
            }
        }
    }
}
