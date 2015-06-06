#!/bin/bash
while true; do
    path=$(inotifywait -r -q videos/)
    filename=`echo $path | cut -d ' ' -f 3`
    echo $filename
    
    sh ./mysql-video-add.sh $filename
done