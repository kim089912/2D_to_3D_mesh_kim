set -ex
expect -c 'spawn su - pibs16;expect "암호:";send "654987\r";interact;';

#!/usr/bin/env bash
cd pifuhd
python -m apps.simple_test --input_path 02 --out_path 02
