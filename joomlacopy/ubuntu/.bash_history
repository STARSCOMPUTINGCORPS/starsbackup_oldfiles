history
history -l
history --help
history
sudo apt-get update && sudo apt-get -y upgrade
sudo reboot
cd .ssh/
ll
cat matt@matthewcampbell.org
cat matt@matthewcampbell.org >> authorized_keys 
sudo apt-get install -y git-core
eval "$(ssh-agent)"
cd
ssh-add ~/.ssh/matt@matthewcampbell.org
ssh-keyscan -H github.com >> ~/.ssh/known_hosts
git clone https://gist.github.com/3d1a02a25e9b0029438a.git
ll
cd 3d1a02a25e9b0029438a/
bash install.sh 
cd /var/www/
exit
cd /var/www/
ll
emacs public/templates/beez5/index.php 
git status
git diff
git status
mv ~/favicon.png public/
ll public/
time
datetime
date
mc ~/favicon.ico public/
mv ~/favicon.ico public/
git status
cd /var/www/
ll
git clone git@github.com:matthew-campbell/stars-community.git .
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git clone git@github.com:matthew-campbell/stars-community.git .
git status
git pull
git config --global color.ui true
git status
ll
host
host -a
ll
sudo chgrp -R www-data /var/www
tail /var/log/apache2/error.log
emacs /var/log/apache2/error.log
uname -a
cd 
mkdir splunk
ll
cd splunk/
ll
dpkg --help
dpkg -i splunkforwarder-6.0-182037-linux-2.6-amd64.deb 
sudo dpkg -i splunkforwarder-6.0-182037-linux-2.6-amd64.deb 
echo $SPLUNK_HOME
ll
which splunkforwarder
which splunk
splunk start
ll /opt
cd
ll
cat .bashrc 
ll
cat .profile 
rehash --help
rehash
ll
emacs .profile 
source .profile
echo $SPLUNK_HOME 
$SPLUNK_HOME/bin/splunk start
sudo $SPLUNK_HOME/bin/splunk start
sudo chown ubuntu $SPLUNK_HOME 
$SPLUNK_HOME/bin/splunk start
$SPLUNK_HOME/bin/splunk stop
sudo $SPLUNK_HOME/bin/splunk stop
$SPLUNK_HOME/bin/splunk start
sudo $SPLUNK_HOME/bin/splunk start
cd splunk/
$SPLUNK_HOME/bin/splunk install app <path>/stormforwarder_<project_id>.spl -auth admin:changeme
$SPLUNK_HOME/bin/splunk install app stormforwarder_f75d2d26426211e38fc2123139018851.spl -auth admin:changeme
sudo $SPLUNK_HOME/bin/splunk install app stormforwarder_f75d2d26426211e38fc2123139018851.spl -auth admin:changeme
$SPLUNK_HOME/bin/splunk login -auth admin:changeme
sudo $SPLUNK_HOME/bin/splunk login -auth admin:changeme
$SPLUNK_HOME/bin/splunk add monitor /var/log/apache2/error.log
sudo $SPLUNK_HOME/bin/splunk add monitor /var/log/apache2/error.log
sudo $SPLUNK_HOME/bin/splunk restart
cd
ll
pwd
ll
ll .emacs.d/
ll .emacs.d/auto-save-list/
pwd
git clone https://github.com/segmentio/analytics-php
ll
sudo chgrp -R  www-data analytics-php/
ll
ll analytics-php/
cd /var/www/
grep header_outer.jpg
find header_outer.jpg
find * header_outer.jpg
find * -name 'header_outer.jpg'
find * -name 'head.php'
emacs public/libraries/joomla/document/html/renderer/head.php
grep --help
grep -H * '<link href="/templates/beez5/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />'
grep -RH '<link href="/templates/beez5/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />' *
grep -RH 'rel="shortcut icon"' *
grep -RH 'rel="shortcut icon"' .
rm public/templates/beez5/.#index.php 
grep -RH 'rel="shortcut icon"' .
grep -RH 'rel="shortcut icon"' public/
grep -RH 'shortcut icon' public/
grep -RH add addFavicon public/
grep -RH addFavicon public/
emacs public/libraries/joomla/document/html/html.php
grep -RH '<meta name="robots"' public/
grep -RH '<title>' public/
grep -Rl '<title>' public/
emacs public/administrator/components/com_admin/models/help.php
grep -Rl 'favicon.ico' public/
emacs public/templates/beez5/templateDetails.xml
git diff
git status
rm public/templates/beez5/#index.php#
git status
git add public/templates/beez5/#index.php#
git status
git rm public/templates/beez5/#index.php#
git status
git commit -m"deleted backup file"
git config --global user.name "Matthew Campbell"
git config --global user.email "matt@matthewcampbell.org"
git commit --amend --reset-author
git log -n5
git status
ll
git add public/templates/beez5/templateDetails.xml
git commit -m"Update favicon filename to eliminate not found error"
git status
git add public/favicon.png
git commit -m"Update favicon filename to eliminate not found error... and add a favicon file"
git log --oneline
git status
git diff
git add public/templates/beez5/index.php
git commit -m"Add Server Name to analytics so development server data can be filtered out"
git push
git status
hostname
git branch -l
git branch profile-bug
git branch -l
git checkout profile-bug 
emacs /var/www/public/components/com_community/views/profile/view.html.php
git status
git add public/components/com_community/views/profile/view.html.php
git commit -m"Fixed profile bug caused by null(empty) groups field"
git status
git stash
git status
git add -A
git stash
git push -u
git branch -l
git push -uA
git push --all -u
git checkout aws-deployment 
git checkout -b 404-errors
git stash pop
emacspublic/templates/beez5/templateDetails.xml
emacs public/templates/beez5/templateDetails.xml
grep -Rl . header_outer.jpg
grep -Rl header_outer.jpg .
emacs /public/templates/beez5/css/beez5.css
emacs public/templates/beez5/css/beez5.css
git status
git commit -m"Add default favicon"
git add -A
git status
git commit -m"Remove link to non-existant file in css"
git push -all -u
git push --all -u
git checkout aws-deployment 
git branch -l
git merge profile-bug 
git merge 404-errors 
git push
$SPLUNK_HOME/bin/splunk login -auth admin:changeme
$SPLUNK_HOME/bin/splunk start
sudo $SPLUNK_HOME/bin/splunk start
cd /var/www/
git status
git add -A
git commit -m "Move Mixpanel code to a seperate file"
git status
git push -A
git push --all -u
history
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git push --all -u
git pull
git push
git status
git checkout aws-deployment 
git pull
git checkout mixpanel 
git pull
git branch -l
cd /var/www/
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git diff
git add -A
git commit -m"Track group information"
git push
git status
git diff
git add -A
git commit -m"Correct User Type tracking"
git push
git checkout aws-deployment 
git merge mixpanel 
git push
exit
cd /var/www/
emacs php_includes/mixpanel.php 
sudo apt-get update
sudo apt-get upgrade -y
cd /var/www/
ll
ssh-add ~/.ssh/matt@matthewcampbell.org
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git status
git branch -l
git branch -D 404-errors 
git branch -D profile-bug 
git branch -l
git checkout -b mixpanel
ll
curl -sS https://getcomposer.org/installer | php
ll
touch composer.json
emacs composer.json 
ll
git status
git add -A
git status
git commit -m"Install Mixpanel with Composer"
composer install
php composer.phar install
emacs composer.json
php composer.phar install
sudo service apache2 start
ll
mkdir includes
ll
mv includes/ php_includes
ll
git status
git add comp*
git status
git add -u
git status
ll vendor/
git add -A
git commit -m"Install Mixpanel with Composer"
git status
ll
touch php_includes/mixpanel.php
ll
git status
emacs /public/templates/beez5/index.php
sudo emacs /public/templates/beez5/index.php
ll
sudo emacs public/templates/beez5/index.php
emacs public/templates/beez5/index.php
eval "$(ssh-client)"
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git status
ll
ll vendor/
cat vendor/autoload.php 
ll vendor/mixpanel/
ll vendor/mixpanel/mixpanel-php/
$SPLUNK_HOME/bin/splunk start 
git branch -l
emacs public/templates/beez5/index.php 
git diff
git status
git commit -m "Access Mixpanel directly"
git add -A
git commit -m "Access Mixpanel directly"
git push
cd /var/www/
ll
eval "$(ss-agent)"
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git status
git pull
emacs php_includes/mixpanel.php
git reset HEAD --hard
ll
mkdir bin
echo "sudo apt-get update && sudo apt-get upgrade -y" > bin/update_and_upgrade.sh
bash bin/update_and_upgrade.sh 
eval "$(ssh-agent)"
echo 'eval "$(ssh-agent)"' > bin/start_ssh_agent.sh
ssh-add ~/.ssh/matt@matthewcampbell.org
cd /var/www/
git status
grep -h "$profile" .
grep -h . "$profile" 
grep --help
grep -l "$profile" .*
grep -l '$profile' .*
grep -l 'profile' .*
grep -rl '$profile' .*
exit
cd /var/www/
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
cd
ll
emacs .profile/
emacs .profile
sudo apt-get update
sudo apt-get upgrade -y
exit
cd /var/www/
ll
cd
git clone git@github.com:matthew-campbell/stars-reports.git
ll
cd stars-reports/
ll
cd html/
ll
cp Models/* /var/www/stars-reports/
cp --help
mkdir /var/www/stars-reports
cp Models/* /var/www/stars-reports/
mkdir /var/www/stars-reports/models
cp Models/* /var/www/stars-reports/models/
ll
cp mysql.php /var/www/stars-reports/ 
cp QueryMap.php /var/www/stars-reports/ 
cp DoiMysql.php /var/www/stars-reports/ 
cp index.php /var/www/stars-reports/ 
cd /var/www/
ll
emacs php_includes/mixpanel.php
git status
git add -A
git status
git commit -m"Inlcude School in Mixpanel"
git push
cd /var/www/
cd stars-reports/
ll
rm Alumnus.php __Email.php EntityModel.php Group.php index.php Student.php User.php 
ll
rm Faculty.php 
ll
emacs index.php 
mv index.php Path.php
ll
mv models/ Models
ll
host
hostname
domainname
uname -a
curl http://169.254.169.254/latest/meta-data/public-hostname
ll
cd ..
ll
touch CONFIG.php
emacs CONFIG.php 
emacs stars-reports/Path.php 
ll
mv CONFIG.php stars-reports/
rm stars-reports/Path.php
ll
git status
ll
emacs .gitignore 
git status
ll

git status
ll stars-reports/
cd
emacs .profile
sudo apt-get update
sudo apt-get upgrade -y
cd /var/www/
ll
git status
eval "$(ssh-agent)"
ssh-add ~/.ssh/matt@matthewcampbell.org
git pull
emacs /var/www/public/libraries/joomla/environment/uri.php
git add -A
git status
git commit -m"Fix error caused by wget (HTTP 1.0)"
git push
emacs /var/www/public/components/com_community/helpers/time.php
emacs public/configuration.php 
git add -A
git status
git commit -m"$offset should be an integer"
git push
emacs /var/www/public/libraries/joomla/environment/uri.php
git diff
emacs public/configuration.php 
git add -A
git status
git commit -m"Fix missing HTTP HEADER issue"
git push
emacs /var/www/public/plugins/community/autogroup/autogroup.php
git diff
git reset HEAD
emacs /var/www/public/plugins/community/autogroup/autogroup.php
emacs /var/www/public/components/com_users/views/login/tmpl/default_login.php
git add -A
git status
git diff
git diff HEAD
git status
git commit -m"More errors from the Apache logs"
git push
emacs /var/www/public/libraries/joomla/utilities/string.php
sudo apt-get update
sudo apt-get upgrade
emacs /var/www/public/components/com_community/templates/default/events.viewevent.php
cd /var/www/
emacs public/configuration.php 
git status
git add -m"Revert timezone, methods use $offset expecting a string in the profile for non-admin users, even though an int is expected elsewhere"
git add -A
git commit -m"Revert timezone, methods use $offset expecting a string in the profile for non-admin users, even though an int is expected elsewhere"
git push
sudo apt-get update
sudo apt-get upgrade -y
sudo reboot
sudo apt-get update
sudo apt-get upgrade -y
exit
sudo apt-get update
sudo apt-get upgrade -y
cd /var/www
ls
ls -la
git status
git show remote
remote show origin
git remote show origin
git branch -l
git status
git pull
git log
exit
