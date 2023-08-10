#!/bin/bash
declare -a cams=(
	"ffmpeg -y -rtsp_transport tcp -i rtsp://camuser:campassword@192.168.1.XXX:88/videoMain -frames:v 1 CAMING"	#FoscamHD
 	"wget -O CAMING --user camuser --password campassword http://192.168.1.XXX:88/snapshot.cgi"	#FoscamSD
)

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
camLength=${#cams[@]}
for (( i=0; i<${camLength}; i++ ));
do
	tempFile=$SCRIPT_DIR/temp-$i.jpg
	outFile=$SCRIPT_DIR/web/cam-$i.jpg
	command=${cams[$i]}
	command=${command/CAMIMG/"$tempFile"}
	$command
 	mv $tempFile $outFile
done
