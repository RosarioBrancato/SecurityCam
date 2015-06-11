HOW TO AUTO

- Install inotify-tools
- Install apache2, mysql and PHP
- Add script initialation in "/etc/rc.local":
	$(cd /var/www/rb-scripts/ ; nohup sh watcher.sh > /dev/null 2>&1 &)
- Correct paths in "watcher" and "mysql-video-add"
- Reboot