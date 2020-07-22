<?php

namespace Deployer;

require 'recipe/symfony4.php';

// example.com
host('137.74.113.141')
    ->port(getenv('ssh_port'))
    ->user(getenv('ssh_user'));

// tasks

desc('Test deployer');
task('test:hello', function () {
    writeln('Hello world');
});

desc('Get server hostname');
task('test:hostname', function () {
    $result = run('cat /etc/hostname');
    writeln("$result");
});

