#!/bin/bash
while true; do
    path=$(inotifywait -r -e create -q ../videos/)
    filename=`echo $path | cut -d ' ' -f 3`
    echo $filename
    
if [ -n "$filename" ]; then
    sh ./mysql-video-add.sh $filename
fi
done
