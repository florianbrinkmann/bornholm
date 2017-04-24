#!/usr/bin/env bash
'which ssh-agent || ( apt-get update -y && apt-get install openssh-client -y )'
mkdir -p ~/.ssh
eval $(ssh-agent -s)
'[[ -f /.dockerenv ]] && echo -e "Host *\n\tStrictHostKeyChecking no\n\n" > ~/.ssh/config'
ssh-add <(echo "$STAGING_PRIVATE_KEY")
ssh -p22 $STAGING_SERVER "mkdir -p $STAGING_PATH_STABLE"
ssh -p22 $STAGING_SERVER "mkdir -p $STAGING_PATH_TRUNK"
rsync -rav -e ssh --exclude='.git/' --exclude=scripts/ --exclude='.travis.yml' --delete-excluded ./ $STAGING_SERVER:$STAGING_PATH_TRUNK
rsync -rav -e ssh --exclude='.git/' --exclude=scripts/ --exclude='.travis.yml' --delete-excluded ./ $STAGING_SERVER:$STAGING_PATH_STABLE
