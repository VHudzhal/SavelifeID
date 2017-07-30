#!/usr/bin/env bash

CDIR=$(realpath $(dirname "$0"))
PROJECTDIR=$(realpath $(dirname "$0")/../../)
TEMPDIR=$(realpath $(dirname "$0")/../../runtime/temp/)
infile=$CDIR/crontab
outfile=/etc/crontab
tempfile=$TEMPDIR/crontab
fingerprintfile=$TEMPDIR/crontab.md5

if [ ! -f $infile ]
    then
        echo "ERROR: $infile does not exist - aborting"
        exit 1
fi

infilemd5=`md5sum $infile | cut -d " " -f1`
savedmd5=`cat $fingerprintfile`

if [ -z $infilemd5 ]
    then
        echo "The file $infile is empty - aborting"
        exit 1
fi

#compare the saved md5 with the one we have now
if [ "$infilemd5" = "$savedmd5" ]
    then
        # pass silent
        :
    else
        echo "crontab has been changed - update && restart needed"
        echo $infilemd5 > $fingerprintfile

        sed -e "s~%script-path%~$CDIR~g" $infile > $tempfile.tmp
        sed -e "s~%app-path%~$PROJECTDIR~g" $tempfile.tmp > $tempfile
        cp -rf  $tempfile $outfile


        service crond restart
fi
