#!/bin/bash
mysql -u username -p'password' << E0F
use security_cam;
insert into tbl_video values(null, NOW(), NOW(), "$1");
E0F
