#!/usr/bin/zsh

# Simple check
[[ $1 = "" ]] && echo "You must specify the website domain name" && return

# Creating website subdir
here=$(pwd)
subdir=$here/websites/$1
mkdir -p $subdir

# Adding symlinks to all php files in each folder
for php in $here/*.php; do
	echo "Creating symlink $php => $subdir/$(basename $php)"
	ln -s $php $subdir/$(basename $php);
done
