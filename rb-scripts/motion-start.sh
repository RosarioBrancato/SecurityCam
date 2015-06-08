#!/bin/bash
pid=$(pidof motion-mmal)
if [ -z "$pid" ]; then	
	nohup ~/mmal/motion-mmal -n -c motion-mmalcam.conf 1>/dev/null 2>&1 </dev/null &
fi
