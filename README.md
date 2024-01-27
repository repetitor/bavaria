# bavaria

## git-hooks
```shell
cp git-hooks/post-checkout .git/hooks/post-checkout
chmod +x .git/hooks/post-checkout
```


## remote script https://laravel.build/example-app
```shell
curl -s https://laravel.build/example-app | bash
```

## local script
```shell
chmod +x ./build.sh
./build.sh
```

## copy files from example-app to root of project
```shell
source ./settings.txt
cp -r $tempDir/.* .
cp -r $tempDir/* .
```
