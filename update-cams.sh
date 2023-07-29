#!/bin/bash
declare -a cams=(
	"ffmpeg -y -rtsp_transport tcp -i rtsp://camuser:campassword@192.168.1.XXX:88/videoMain -frames:v 1 "
)

camLength=${#cams[@]}
for (( i=0; i<${camLength}; i++ ));
do
	echo "Updating Camera #$i..."
	${cams[$i]} web/cam-$i.jpg
done