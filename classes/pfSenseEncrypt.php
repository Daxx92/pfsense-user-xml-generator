<?php

class pfSenseEncrypt{

	const PASSWORD = 'password';
	const MD5 = 'md5-hash';
	const NT_HASH = 'nt-hash';

	public function encryptPassword( $password ){
		$encrypted = [];

		$this->local_user_set_password( $encrypted, $password );

		return $encrypted;

	}

	/*
		Copyright (C) 2010 Ermal Luçi
		All rights reserved.
		Copyright (C) 2007, 2008 Scott Ullrich <sullrich@gmail.com>
		All rights reserved.
		Copyright (C) 2005-2006 Bill Marquette <bill.marquette@gmail.com>
		All rights reserved.
		Copyright (C) 2006 Paul Taylor <paultaylor@winn-dixie.com>.
		All rights reserved.
		Copyright (C) 2003-2006 Manuel Kasper <mk@neon1.net>.
		All rights reserved.
		Redistribution and use in source and binary forms, with or without
		modification, are permitted provided that the following conditions are met:
		1. Redistributions of source code must retain the above copyright notice,
		   this list of conditions and the following disclaimer.
		2. Redistributions in binary form must reproduce the above copyright
		   notice, this list of conditions and the following disclaimer in the
		   documentation and/or other materials provided with the distribution.
		THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED WARRANTIES,
		INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
		AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
		AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
		OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
		SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
		INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
		CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
		ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
		POSSIBILITY OF SUCH DAMAGE.
		pfSense_BUILDER_BINARIES:	/usr/sbin/pw	/bin/cp
		pfSense_MODULE:	auth


		https://github.com/pfsense/pfsense/blob/master/etc/inc/auth.inc
	*/
	private function local_user_set_password(& $user, $password) {
		$user['password'] = @crypt($password);
		$user['md5-hash'] = md5($password);

		// Converts ascii to unicode.
		$astr = (string) $password;
		$ustr = '';

		for ($i = 0; $i < strlen($astr); $i++) {
			$a = ord($astr{$i}) << 8;
			$ustr .= sprintf("%X", $a);
		}

		// Generate the NT-HASH from the unicode string
		$user['nt-hash'] = bin2hex(hash("md4", $ustr));
	}

}