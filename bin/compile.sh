#!/usr/bin/env bash

set -e

DIRECTORY=$(cd `dirname $0` && pwd)
RESOURCES=$DIRECTORY/../resources/svg

SOURCE=$1
echo $SOURCE
echo "Reading icons..."
for ICON_DIR in $SOURCE/icons/*; do
    # Category Directory Path
    # echo $ICON_DIR
    # exit

    # Icon Name
    ICON_NAME=${ICON_DIR##*/}
    # echo $ICON_NAME

    CP_COMMAND='cp '$ICON_DIR' '$RESOURCES/$ICON_NAME
    $CP_COMMAND
    # exit

done

echo "All done!"
