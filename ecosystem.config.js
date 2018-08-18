module.exports = {
    /**
     * USAGE:
     *
     * pm2 start ecosystem.config.js
     * pm2 start ecosystem.config.js --only fly
     * pm2 start ecosystem.config.js --only thrift
     * pm2 start ecosystem.config.js --only --env production # uses variables from `env_production`
     *
     * pm2 save
     *
     * pm2 stop fly
     * pm2 start fly
     * pm2 restart fly
     *
     * pm2 ls
     * pm2 show fly
     * pm2 monit
     * pm2 logs
     * pm2 flush #Empty all log file
     *
     *
     *
     * DOCS:
     *
     * Ecosystem File
     * https://pm2.io/doc/en/runtime/guide/ecosystem-file/#ecosystem-file
     *
     * Application configuration section
     * http://pm2.keymetrics.io/docs/usage/application-declaration/
     *
     * API
     * http://pm2.keymetrics.io/docs/usage/pm2-api/
     */
    apps: [

        // First application
        {
            name: 'fly',
            script: 'vendor/scil/laravel-fly/bin/fly',
            interpreter: "/usr/bin/php",
            max_restarts: 5,
            args: "restart",
            error_file : "./storage/logs/fly-err.log",
            out_file: "./storage/logs/fly-out.log",
            env: {
                COMMON_VARIABLE: 'true'
            },
            env_production: {
                NODE_ENV: 'production'
            }
        },

        // Second application
        {
            name: 'thrift',
            script: 'thrift/bin/server.js',
            max_memory_restart: '65M',
            max_restarts: 5,
            error_file : "./storage/logs/thrift-err.log",
            out_file: "./storage/logs/thrift-out.log",
        }
    ],

    /**
     * Deployment section
     * http://pm2.keymetrics.io/docs/usage/deployment/
     */
    deploy: {
        production: {
            user: 'node',
            host: '212.83.163.1',
            ref: 'origin/master',
            repo: 'git@github.com:repo.git',
            path: '/var/www/production',
            'post-deploy': 'npm install && pm2 reload ecosystem.config.js --env production'
        },
        dev: {
            user: 'node',
            host: '212.83.163.1',
            ref: 'origin/master',
            repo: 'git@github.com:repo.git',
            path: '/var/www/development',
            'post-deploy': 'npm install && pm2 reload ecosystem.config.js --env dev',
            env: {
                NODE_ENV: 'dev'
            }
        }
    }
};
