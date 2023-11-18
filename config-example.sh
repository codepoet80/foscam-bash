#!/bin/bash
# each line represents the command to fetch an image from a camera
# the string CAMIMG will be replaced with a new filename generated sequentially
declare -a cams=(
	"ffmpeg -y -rtsp_transport tcp -i rtsp://camuser:campassword@192.168.1.XXX:88/videoMain -frames:v 1 CAMING"	#FoscamHD
 	"wget -O CAMING --user camuser --password campassword http://192.168.1.XXX:88/snapshot.cgi"	#FoscamSD
)
