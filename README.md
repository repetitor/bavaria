# bavaria

## git-hooks
```shell
cp git-hooks/post-checkout .git/hooks/post-checkout
chmod +x .git/hooks/post-checkout
```

## finish
```shell
./vendor/bin/sail artisan migrate:rollback
./vendor/bin/sail stop
```

## api-documentation {host}/api/documentation
```shell
php artisan l5-swagger:generate
```
