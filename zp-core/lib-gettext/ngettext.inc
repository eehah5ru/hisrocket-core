<?php
// TODO: it should be fixed
// hack for unexisted ngettext function
function ngettext($msgid1,$msgid2,$n) {
	if ($n==0 || $n>1) {
		return $msgid2;
	}
	return $msgid1;
}
?>