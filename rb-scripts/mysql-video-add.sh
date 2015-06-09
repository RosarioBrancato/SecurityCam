#!/bin/bash
mysql -u username -p'1234' << E0F
use security_cam;
insert into tbl_video values(null, NOW(), NOW(), "$1");
E0F
