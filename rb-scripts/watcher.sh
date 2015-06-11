#!/bin/bash
while true; do
    path=$(inotifywait -r -e create -q /var/www/videos/)
    filename=`echo $path | cut -d ' ' -f 3`
    echo $filename
    
if [ -n "$filename" ]; then
    $(cd /var/www/rb-scripts/ ; sh mysql-video-add.sh $filename)
fi
done