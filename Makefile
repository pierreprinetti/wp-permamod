
.PHONY: svn-commit

svn:
	svn co https://plugins.svn.wordpress.org/wp-permamod svn

svn-commit: svn
	cp ./readme.txt ./wp-permamod.php ./LICENSE ./svn/trunk/
	cd svn && \
		svn ci -m '$(shell git show --no-patch --pretty=format:'%s')' --username qrawl
