#!/bin/bash

while true; do
	touch /tmp/lfile
	rm -f /tmp/lfile
	ln -s /home/user/level10/token /tmp/lfile
	rm -f /tmp/lfile
done