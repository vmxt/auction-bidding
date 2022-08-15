Dear {{ $user->username }},


Good day!

Concerning your application, please be informed that it has been placed on hold due to the following reason(s).

{{$reason}}

Kindly wait for our email on the next step that needs to be done for you to properly progress your application.

{{ env('APP_URL') }}/sp/login

Thank you and hoping for your kind understanding on this matter.


Regards,
{{ $setting->company_name }}