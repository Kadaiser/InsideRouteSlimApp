#!/bin/bash  
while true
do
	macAddr=$(btmgmt find | grep 'rssi' | sort -n -r -k 8 | head -1 | cut -d ' ' -f 3)
	echo "${macAddr}" > /var/www/html/scritps/mac
done
