#! /bin/bash
localdir=src
ext=https://hvzmweb.googlecode.com/svn/trunk/_css/2011
svn propset svn:externals "$localdir $ext" .
svn ci -m "adding 'svn:externals $localdir $ext'"
svn up
