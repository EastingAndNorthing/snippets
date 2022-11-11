#!/bin/bash
# Update hosts file for folders in a directory

# echo $1

read -r -p "${1:-Add these sites to /etc/hosts? [y/N]} " response
case "$response" in
    [yY][eE][sS]|[yY])
		find -mindepth 1 -maxdepth 1 -type d -printf '%P\n' | while read line; do
			echo "$line.dev"
			grep -q -F "127.0.0.1 $line.dev" /etc/hosts || echo "127.0.0.1 $line.dev" >> /etc/hosts
		done
        true;;
    *)
		echo "exit"
        false;;
esac

