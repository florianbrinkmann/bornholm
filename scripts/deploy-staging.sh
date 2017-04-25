#!/usr/bin/env bash
ssh -p22 $STAGING_SERVER_USER@$STAGING_SERVER "mkdir -p $STAGING_PATH_STABLE"
ssh -p22 $STAGING_SERVER_USER@$STAGING_SERVER "mkdir -p $STAGING_PATH_TRUNK"
rsync -rav -e ssh --exclude='.git/' --exclude=scripts/ --exclude='.travis.yml' --delete-excluded ./ $STAGING_SERVER_USER@$STAGING_SERVER:$STAGING_PATH_TRUNK
rsync -rav -e ssh --exclude='.git/' --exclude=scripts/ --exclude='.travis.yml' --delete-excluded ./ $STAGING_SERVER_USER@$STAGING_SERVER:$STAGING_PATH_STABLE
