<p>
Ovo je automatska poruka generirana od stranice <a href='http://opgsarac.hr'>opgsarac.hr</a><br>
NEMOJTE odgovarati na ovu poruku!<br>
Odgovorite na email ponuđen ispod.
</p>
<hr>
<p>
Ime i prezime: <strong>{{ $data['name'] }}</strong><br>
EMAIL: <strong>{{ $data['email'] }}</strong><br>
Naslov: <strong>{{ $data['title'] }}</strong><br>
Poruka:
</p>
<hr>
{!! nl2br(e($data['message'])) !!}
