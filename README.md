# php7.2-verify-migration-tool
Bot to detect, report errors, deprecated functions to php7.2 migration.

Add permission to execute in terminal:
```sh
chmod +x scan.php
```
How to execute:
```sh
./scan.php /home/yourproject e
```

No parameters: scan only erros
```sh
./scan.php
```

set dir to scan, 1st param
```sh
./scan.php /home/yourproject
```

e: scan only erros
```sh
./scan.php e
```

w: scan only warnings
```sh
./scan.php w
```

q: quiet, show nothing on console
```sh
./scan.php q
```

all: scan all
```sh
./scan.php all
```
