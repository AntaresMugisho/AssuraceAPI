@setup
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $dir = env("APP_DEPLOYMENT_PATH");
    if (!$branch){
        $branch = "main"; 
    }
@endsetup

@servers(["web" => "o2art"])

@story("deploy", ["on" => "web", "confirm" => false])
    down
    update-code
    install-dependencies
    up
    {{-- sitemap --}}
@endstory

@task("down")
    cd {{ $dir }}
    php artisan down
@endtask

@task("update-code")
    cd {{ $dir }}
    git checkout {{ $branch }}
    git stash
    git pull origin {{ $branch }}
@endtask

@task("install-dependencies")
    cd {{ $dir }}
    npm install --build
    npm run build

    composer install --no-dev
    
    php artisan migrate --force
    php artisan storage:link
    php artisan cache:clear
    php artisan config:cache
@endtask

@task("up")
    cd {{ $dir }}
    php artisan up
@endtask

@task("sitemap")
    cd {{ $dir }}
    php artisan sitemap:generate
@endtask