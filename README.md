# php7.2-verify-migration-tool
Bot to detect, report errors, deprecated functions to php7.2 migration.

The project is in Twitch.tv at https://www.twitch.tv/themoiza

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

set dir to scan, 1st param
```sh
./scan.php /home/yourproject
```

e: scan only erros
```sh
./scan.php w
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
