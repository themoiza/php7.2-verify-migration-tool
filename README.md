# php7.2-verify-migration-tool
Bot to detect, report errors, deprecated functions to php7.2 migration.

Add permission to execute in terminal:
```sh
chmod +x scan.php
```
How to execute:
```sh
./scan.php
```

No parameters: scan only erros
```sh
./scan.php
```

e: scan only erros
```sh
./scan.php w
```

w: scan only warnings
```sh
./scan.php w
```

all: scan all
```sh
./scan.php all
```