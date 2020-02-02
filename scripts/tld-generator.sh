#!/usr/bin/env sh

# Utils
#
# This Repository contains some useful Stuff for my Projects
#
# Copyright (c) 2020 Fabian Fröhlich <mail@f-froehlich.de> https://f-froehlich.de
#
#
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU Affero General Public License as
# published by the Free Software Foundation, either version 3 of the
# License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU Affero General Public License for more details.
#
# You should have received a copy of the GNU Affero General Public License
# along with this program.  If not, see <https://www.gnu.org/licenses/>.
#
# For all license terms see README.md and LICENSE Files in root directory of this Project.

curl https://data.iana.org/TLD/tlds-alpha-by-domain.txt -s | \
    awk {'if ($1 != "#") printf ("%s\n", $1)'} | \
    sed -e 's/\(.*\)/\L\1/' > .tld.lst

TLD_EXP=$(cat .tld.lst | xargs | sed 's/$/)\$/' | sed 's/^/(/' | sed 's/\s/|/g');
if [ -f "Tests/Fixtures/validTLD.txt" ]; then
    OLD_TLD_EXP=$(cat Tests/Fixtures/validTLD.txt | xargs | sed 's/$/)\\\$/' | sed 's/^/(/' | sed 's/\s/|/g');
    sed -i -e "s/$OLD_TLD_EXP/REPLACE_TLD_BY_INSTALL/" src/Enum/DomainRegExp.php
    sed -i -e "s/$OLD_TLD_EXP/REPLACE_TLD_BY_INSTALL/" Tests/Unit/DomainRegExpTest.php;
fi

sed -i -e "s/REPLACE_TLD_BY_INSTALL/$TLD_EXP/" src/Enum/DomainRegExp.php
sed -i -e "s/REPLACE_TLD_BY_INSTALL/$TLD_EXP/" Tests/Unit/DomainRegExpTest.php

EXIT_CODE=0
diff -q --from-file .tld.lst Tests/Fixtures/validTLD.txt;
if [ "$?" -gt 0 ]; then
  echo "TLD List does not match. It was updated by INNA."
  echo "You have to commit the new file and pattern before proceed!"
  echo "New Files generated"

  EXIT_CODE=1
fi

cp .tld.lst Tests/Fixtures/validTLD.txt
cat .tld.lst | sed 's/^/\./' > Tests/Fixtures/validDottedTLD.txt

rm -rf .tld.lst

exit $EXIT_CODE