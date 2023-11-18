#!/bin/bash
if [ ! -f ./config.sh ]; then
	echo "Config file not found! Unable to proceed..."
	echo "Copy config-example.sh to config.sh, and set the URLs to your cameras within it"
	exit
else
	echo "Updating cams..."
	source config.sh
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
fi
