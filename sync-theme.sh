#!/bin/bash

# This command will synchronize the local gp-winterthur/ directory to the remote
# wordpress instance of test.gp-winterthur.ch
# -a: This option enables the archive mode, which allows copying files recursively
#     and it also preserves symbolic links, file permissions, user & group ownerships,
#     and timestamps.
# --delete: This option deletes files that are not in the source directory from the
#     destination directory. This ensures that the destination only contains files
#     that match the source.
rsync -a --delete gp-winterthur/ winterthur-marathon.ch:www/test.gp-winterthur.ch/wordpress/wp-content/themes/gp-winterthur/
