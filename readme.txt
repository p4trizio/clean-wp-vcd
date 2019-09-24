This script cleans up Wordpress installations from VCD malware.
Features:
 - finds all WPs installations directories in a recursive way
 - foreach WP site
    - deletes malware files in wp-includes
    - removes infected code from themes files functions.php
    - substitute wp-includes/post.php with a copy from official Wordpress repository on Github

How to use:
1. find the cause of the malware and remove it (usually is a nulled theme or plugin downloaded form unsafe sources)
   run
   $ grep -r -H "class.plugin-modules"
   $ grep -r -H "class.theme-modules"
   probably you will get the offending plugin or theme
2. Backup you websites, seriously, DO IT.
3. Place the clean.php file in front of you WPs installations.
eg.
- wpsite1
- wpsite2
- etc
- clean.php

4. Run the clean.php from ssh console (or from browser if you can)
   $ php clean.php

5. Read the report and check the file system
6. Delete clean.php
7. Run
   $ grep -r -H "wp-vcd"
   $ grep -r -H "wp-tmp"
   $ grep -r -H "wp-feed"
   There should not be any results for that search string(except in bash hystory)

How to try it:
1. Copy WP install simulations from example_filesystem and put it in the root of this project
2. Run clean.php and see the results
