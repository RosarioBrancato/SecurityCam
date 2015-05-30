#!/bin/bash
ps -ef | grep motion-mmal | awk '{print $2}' | xargs kill