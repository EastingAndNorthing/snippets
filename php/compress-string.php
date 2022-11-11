$input = 'a very very very very very very very very very long string';

$compressed = urlencode(base64_encode(gzcompress($input)));

$original = gzuncompress(base64_decode(urldecode($compressed)));
