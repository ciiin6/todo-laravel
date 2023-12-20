<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/ciiin6/todo-laravel.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('192.168.18.13')
    ->set('remote_user', 'prod-ud4-deployer')
    ->set('identity_file', '~/.ssh/id_rsa')
    ->set('deploy_path', '/var/www/prod-ud4-a4/html');

// Podem definir diferents tasques que s'executaran durant, abans o després de cada
//desplegament
task('build', function () {
    run('cd {{release_path}} && build');
});

// Executem la migració de la base de dades just abans de dur a terme l'enllaç simbòlic a la nova
//versió. La primera vegada que fem un desplegament no disposarem de l'arxiu .env, per la qual
//cosa la comentarem i la descomentaremos quan tinguem creat l'arxiu .env
before('deploy:symlink', 'artisan:migrate');
// Podem definir tasques addicionals que volem que s'executen quan duguem a terme un deploy de
//l'aplicació i que veurem en punts posteriors

// Hooks

after('deploy:failed', 'deploy:unlock');

task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php8.1-fpm restart');
});
# inclusió en el cicle de desplegament
after('deploy', 'reload:php-fpm');
