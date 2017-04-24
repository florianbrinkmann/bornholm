#!/usr/bin/env bash
'which ssh-agent || ( apt-get update -y && apt-get install openssh-client -y )'
mkdir -p ~/.ssh
eval $(ssh-agent -s)
'[[ -f /.dockerenv ]] && echo -e "Host *\n\tStrictHostKeyChecking no\n\n" > ~/.ssh/config'
ssh-add <(echo "$STAGING_PRIVATE_KEY")
ssh -p22 $PRODUCTION_SERVER "mkdir -p $PRODUCTION_SERVER_THEMES_PATH/_tmp-bornholm"
ssh -p22 $PRODUCTION_SERVER "mkdir -p $PRODUCTION_SERVER_THEMES_PATH/bornholm"
rsync -rav -e ssh --exclude='.git/' --exclude=scripts/ --exclude='.travis.yml' --delete-excluded ./ $PRODUCTION_SERVER:$PRODUCTION_SERVER_THEMES_PATH/_tmp-bornholm
ssh -p22 $PRODUCTION_SERVER "mv $PRODUCTION_SERVER_THEMES_PATH/bornholm $PRODUCTION_SERVER_THEMES_PATH/_old-bornholm && mv $PRODUCTION_SERVER_THEMES_PATH/_tmp-bornholm $PRODUCTION_SERVER_THEMES_PATH/bornholm"
ssh -p22 $PRODUCTION_SERVER "rm -rf $PRODUCTION_SERVER_THEMES_PATH/_old-bornholm"
